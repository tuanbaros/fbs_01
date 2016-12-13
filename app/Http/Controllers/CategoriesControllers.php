<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Contracts\CategoryRepositoryInterface as CategoryInterface;

class CategoriesControllers extends Controller
{
    private $categoryRepository;

    public function __construct(CategoryInterface $categoryInterface)
    {
        $this->categoryRepository = $categoryInterface;
    }

    public function showProductInCategory($id)
    {
        $category = $this->categoryRepository->find($id);
        $data['categoryShow'] = $category;
        $data['categories'] = $this->categoryRepository->getCategory(config('view.take-category'));

        return view('category', $data);
    }
}
