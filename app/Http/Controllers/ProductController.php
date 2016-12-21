<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Contracts\ProductRepositoryInterface as ProductInterface;
use App\Repositories\Contracts\RateRepositoryInterface as RateInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Exception;
use Auth;

class ProductController extends Controller
{
    private $productRepository;
    private $rateRepository;

    public function __construct(
        ProductInterface $productInterface,
        RateInterface $rateInterface)
    {
        $this->productRepository = $productInterface;
        $this->rateRepository = $rateInterface;
    }

    public function show($id)
    {
        $data['product'] = $this->productRepository->find($id);
        if ($data['product']) {
            $data['similarProducts'] = $this->productRepository
                ->getSimilarProduct($data['product'], config('view.similar-product'))->get();
        }

        return view('products.show', $data);
    }

    public function addRate(Request $request, $id)
    {
        $data = $request->only('number', 'content');
        $array_id = ['product_id' => $id, 'user_id' => Auth::id()];
        $count = count($this->rateRepository->findWhere($array_id));
        $data = array_collapse([$data, $array_id]);
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
