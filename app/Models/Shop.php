<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Follow;
use App\Models\Like;
use App\Models\Collection;
use App\Models\Product;
use App\Models\Category;
use App\Models\BaseModel;

class Shop extends BaseModel
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
