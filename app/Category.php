<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;
use App\Shop;
use App\Category;

class Category extends Model
{
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function shops()
    {
        return $this->hasMany(Shop::class);
    }

    public function categories()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }
}
