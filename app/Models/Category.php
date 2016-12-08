<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\Shop;
use App\Models\Category;
use App\Models\BaseModel;

class Category extends BaseModel
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
