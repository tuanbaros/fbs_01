<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Contracts\ProductRepositoryInterface as ProductInterface;

class ProductController extends Controller
{
    private $productRepository;

    public function __construct(ProductInterface $productInterface)
    {
        $this->productRepository = $productInterface;
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
}
