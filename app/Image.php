<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;

class Image extends Model
{
    public function Product()
    {
        return $this->belongsTo(Product::class);
    }
}
