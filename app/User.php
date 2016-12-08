<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Activity;
use App\Follow;
use App\Like;
use App\Rate;
use App\Order;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }

    public function follows()
    {
        return $this->hasMany(Follow::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function rates()
    {
        return $this->hasMany(Rate::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function shop()
    {
        return $this->hasOne(Shop::class);
    }
}
