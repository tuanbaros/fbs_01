<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Contracts\ProductRepositoryInterface as ProductInterface;
use App\Repositories\Contracts\RateRepositoryInterface as RateInterface;
use App\Repositories\Contracts\FollowRepositoryInterface as FollowInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Exception;
use Auth;

class ProductController extends Controller
{
    private $productRepository;
    private $rateRepository;
    private $followRepository;

    public function __construct(
        ProductInterface $productInterface,
        RateInterface $rateInterface,
        FollowInterface $followInterface)
    {
        $this->productRepository = $productInterface;
        $this->rateRepository = $rateInterface;
        $this->followRepository = $followInterface;
    }

    public function show($id)
    {
        $data['product'] = $this->productRepository->find($id);
        if ($data['product']) {
            $data['similarProducts'] = $this->productRepository
                ->getSimilarProduct($data['product'], config('view.similar-product'))->get();
            if (Auth::user()) {
                $data['followed'] = count($this->followRepository->findWhere([
                    'user_id' => Auth::id(),
                    'shop_id' => $data['product']->shop->id
                ]));
            }
        }

        return view('products.show', $data);
    }

    public function addRate(Request $request, $id)
    {
        $data = $request->only('number', 'content');
        $arrayId = ['product_id' => $id, 'user_id' => Auth::id()];
        $count = count($this->rateRepository->findWhere($arrayId));
        $data = array_collapse([$data, $arrayId]);
        $product = $this->productRepository->find($id);
        if (count($product) == 0) {

            return response()->json('not-product');
        }
        if ($count > 0) {

            return response()->json('rated');
        }
        if (Auth::user() && $this->rateRepository->validate($data, 'create')) {
            DB::beginTransaction();
            try {
                $this->rateRepository->create($data);
                $rates = $product->rates;
                $number = round(($rates->sum('number')) / count($rates), 1);
                $message = $this->productRepository->update(['point_rate' => $number], $id);
                DB::commit();

                return response()->json($message);
            } catch (Exception $e) {
                DB::rollback();
            }
        }

        return response()->json('error');
    }
}
