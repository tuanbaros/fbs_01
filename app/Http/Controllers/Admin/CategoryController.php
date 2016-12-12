<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Repositories\Contracts\CategoryRepositoryInterface as CategoryRepository;

class CategoryController extends Controller
{
    private $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
       $this->categoryRepository = $categoryRepository;
    }

    public function index()
    {
        $categories = $this->categoryRepository->paginate(config('view.paginate'));
        return view('admin.category.index', compact('categories'));
    }

    public function create()
    {
        $parents = $this->categoryRepository->getParents();

        return view('admin.category.create', compact('parents', 'sorts'));
    }

    public function store(Request $request)
    {
        $data = $request->only('name', 'parent_id', 'sort');

        return $this->categoryRepository->create($data);
    }

    public function subCategory()
    {
        $subs = $this->categoryRepository->getSubCategory($id);
    }
}
