<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\OrderDetail;
use App\Receiver;
use App\Payment;

class Order extends Model
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
