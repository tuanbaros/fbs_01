<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\OrderDetail;
use App\Models\Receiver;
use App\Models\Payment;
use App\Models\BaseModel;

class Order extends BaseModel
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function receivers()
    {
        return $this->hasMany(Receiver::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}
