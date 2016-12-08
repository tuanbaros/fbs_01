<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Rate;
use App\Collection;
use App\Image;
use App\Category;
use App\Shop;
use App\OrderDetail;

class Product extends Model
{
    public function rates()
    {
        return $this->hasMany(Rate::class);
    }

    public function collections()
    {
        return $this->belongsToMany(Collection::class, 'product_collections');
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }
}
