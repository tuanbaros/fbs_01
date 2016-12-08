<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Shop;
use App\Collection;
use App\Product;

class Collection extends Model
{
    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    public function collections()
    {
        return $this->hasMany(Collection::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_collections');
    }
}
