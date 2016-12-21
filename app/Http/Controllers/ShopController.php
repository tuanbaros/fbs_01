<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Contracts\ShopRepositoryInterface as ShopInterface;
use App\Repositories\Contracts\CollectionRepositoryInterface as CollectionInterface;
use App\Repositories\Contracts\FollowRepositoryInterface as FollowInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Exception;
use Auth;

class ShopController extends Controller
{
    private $shopRepository;
    private $followRepository;
    private $collectionRepository;

    public function __construct(
        ShopInterface $shopInterface,
        FollowInterface $followInterface,
        CollectionInterface $collectionInterface)
    {
        $this->shopRepository = $shopInterface;
        $this->followRepository = $followInterface;
        $this->collectionRepository =$collectionInterface;
    }

    public function index()
    {
        $data['shops'] = $this->shopRepository->paginate(config('view.number-shop'));

        return view('shops.index', $data);
    }

    public function show($id)
    {
        $data['shop'] = $this->shopRepository->find($id);
        if (Auth::user()) {
            $data['followed'] = count($this->followRepository->findWhere([
                'user_id' => Auth::id(),
                'shop_id' => $id
            ]));
        }

        return view('shops.show', $data);
    }

    public function shopCollection($id)
    {
        $data['collection'] = $this->collectionRepository->find($id);

        return view('shops.collection', $data);
    }

    public function follow($id)
    {
        $shop = $this->shopRepository->find($id);
        if (count($shop) == 0) {

            return response()->json('not-found');
        }
        if (Auth::user()) {
            $follow = $this->followRepository->findWhere([
                'user_id' => Auth::id(),
                'shop_id' => $id
            ])->first();
            DB::beginTransaction();
            try {
                if ($follow) {
                    $this->followRepository->delete($follow->id);
                } else {
                    $this->followRepository->create([
                        'user_id' => Auth::id(),
                        'shop_id' => $id
                    ]);
                }
                DB::commit();

                return response()->json('success');
            } catch (Exception $e) {
                DB::rollback();
            }
        }

        return response()->json('error');
    }
}
