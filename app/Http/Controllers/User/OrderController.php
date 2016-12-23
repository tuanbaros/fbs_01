<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\ReceiverRepositoryInterface as ReceiverInterface;
use App\Repositories\Contracts\OrderRepositoryInterface as OrderInterface;
use App\Repositories\Contracts\ProductRepositoryInterface as ProductInterface;
use Config;
use Auth;
use Cart;
use DB;
use App\Models\Product;

class OrderController extends Controller
{
    private $reveiverRepository;
    private $orderRepository;
    private $productRepository;

    public function __construct(
        ReceiverInterface $reveiverInterface, 
        OrderInterface $orderInterface, 
        ProductInterface $productInterface
    )
    {
       $this->reveiverRepository = $reveiverInterface;
       $this->orderRepository = $orderInterface;
       $this->productRepository = $productInterface;
    }

    public function index()
    {
        $cart = Cart::instance(Auth::user()->id)->content();

        DB::beginTransaction();
        try {
            foreach ($cart as $key => $item) {
                $product = $this->productRepository->find($item->id);
                if ($product && $product->quantity < $item->qty) {
                    Cart::instance(Auth::user()->id)->update($item->rowId, [
                            'qty' => $product->quantity, 
                            'options' => [
                            'quantity' => $product->quantity
                        ] 
                    ]);
                }
            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
        }

        return view('user.order.index', compact('cart'));
    }

    public function store(Request $request)
    {
        $data = $request->only('name', 'address', 'phone', 'email', 'stripeToken');
        if (!$this->reveiverRepository->validate($data, 'create')) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        \Stripe\Stripe::setApiKey(Config::get('stripe.secret_key'));
        DB::beginTransaction();
        try {
            $customerID = $this->orderRepository->createStripeCustomer($data);
            $receiverId = $this->orderRepository->saveReceiver($data);
            $orderId = $this->orderRepository->saveOrder($receiverId);
            $this->orderRepository->saveOrderDetail($orderId);
            $total = Cart::instance(Auth::user()->id)->subtotal(0, 0, '');
            $amount = (int) round($total / 22000);
            $this->orderRepository->createStripeCharge($amount, $customerID);
            Cart::instance(Auth::user()->id)->destroy();
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->route('user.order.index')->withErrors($e->getMessage())->withInput();
        }
        
        return redirect()->route('user.bill.index');
    }
}
