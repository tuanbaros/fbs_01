<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Shop;
use App\User;

class Like extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }
}
