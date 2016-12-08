<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Order;

class Payment extends Model
{
    public function order()
    {
        return $this->hasOne(Order::class);
    }
}
