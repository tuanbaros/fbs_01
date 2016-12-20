<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\CollectionRepositoryInterface as CollectionRepositoryInterface;
use Auth;
use Lang;

class CollectionController extends Controller
{
    private $collectionRepository;

    public function __construct(CollectionRepositoryInterface $collectionRepository)
    {
       $this->collectionRepository = $collectionRepository;
    }

    public function index()
    {
        $collections = $this->collectionRepository->paginate(config('view.paginate'));

        return view('user.collection.index', compact('collections'));
    }

    public function create()
    {
        return view('user.collection.index');
    }

    public function store(Request $request)
    {
        $data = $request->only('name');
        if (!Auth::user()->shop()) {
            return redirect()->to('/');
        }

        $data['shop_id'] = Auth::user()->shop->id;
        if ($this->collectionRepository->validate($data, 'create')) {
            $this->collectionRepository->create($data);

            return redirect()->route('user.collection.index')->with([
                'flash_level' => Lang::get('admin.success'),
                'flash_message' => Lang::get('admin.message.add_success', ['name' => 'Collection'])
            ]);
        }

        return redirect()->back()->withErrors($this->collectionRepository->valid());
    }

    public function postUpdateAjax(Request $request)
    {
        $data = $request->only('name');
        if (!$request->id) {
            return response()->json(['sms' => Lang::get('user.sms.not_found')]);
        }
        $this->collectionRepository->update($data, $request->id);
        
        return response()->json(['sms' => Lang::get('user.sms.update')]);
    }

    public function postDeleteAjax(Request $request)
    {
        if (!$request->id) {
            return response()->json(['sms' => Lang::get('user.sms.not_found')]);
        }
        $this->collectionRepository->delete($request->id);

        return response()->json(['sms' => Lang::get('user.sms.delete')]);
    }
}
