<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Contracts\ShopRepositoryInterface as ShopInterface;

class ShopController extends Controller
{
    private $shopRepository;

    public function __construct(ShopInterface $shopInterface)
    {
        $this->shopRepository = $shopInterface;
    }

    public function show($id)
    {
        $data['shop'] = $this->shopRepository->find($id);

        return view('shop.show', $data);
    }
}
