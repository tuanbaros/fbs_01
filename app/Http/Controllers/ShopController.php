<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Contracts\ShopRepositoryInterface as ShopInterface;
use App\Repositories\Contracts\CollectionRepositoryInterface as CollectionInterface;

class ShopController extends Controller
{
    private $shopRepository;
    private $collectionRepository;

    public function __construct(
        ShopInterface $shopInterface,
        CollectionInterface $collectionInterface)
    {
        $this->shopRepository = $shopInterface;
        $this->collectionRepository =$collectionInterface;
    }

    public function show($id)
    {
        $data['shop'] = $this->shopRepository->find($id);

        return view('shops.show', $data);
    }

    public function shopCollection($id)
    {
        $data['collection'] = $this->collectionRepository->find($id);

        return view('shops.collection', $data);
    }
}
