<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\ShopRepositoryInterface as ShopRepositoryInterface;
use App\Repositories\Contracts\CategoryRepositoryInterface as CategoryRepositoryInterface;
use Auth;

class ShopController extends Controller
{
    private $shopRepository;
    private $categoryRepository;

    public function __construct(
        ShopRepositoryInterface $shopRepository, 
        CategoryRepositoryInterface $categoryRepository
    )
    {
       $this->shopRepository = $shopRepository;
       $this->categoryRepository = $categoryRepository;
    }

    public function create()
    {
        $categories = $this->categoryRepository->getParents();

        return view('user.shop.create-shop', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->only('name', 'address', 'description', 'category_id');
        $data['status'] = config('view.number.zero');
        $data['user_id'] = Auth::user()->id;

        return $this->shopRepository->create($data);
    }
}
