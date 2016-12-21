<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Input;
use Config;
use Auth;
use Cart;

class OrderController extends Controller
{
    public function index()
    {
        $cart = Cart::instance(Auth::user()->id)->content();

        return view('user.order.index', compact('cart'));
    }
}
