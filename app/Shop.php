<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Follow;
use App\Like;
use App\Collection;
use App\Product;
use App\Category;

class Shop extends Model
{
    public function follows()
    {
        return $this->hasMany(Follow::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function collections()
    {
        return $this->hasMany(Collection::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }
}
