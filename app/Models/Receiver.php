<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Order;
use App\Models\BaseModel;

class Receiver extends BaseModel
{
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
