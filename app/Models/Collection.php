<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Shop;
use App\Models\Collection;
use App\Models\Product;
use App\Models\BaseModel;

class Collection extends BaseModel
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
