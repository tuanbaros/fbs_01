<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\BaseModel;

class Image extends BaseModel
{
    public function Product()
    {
        return $this->belongsTo(Product::class);
    }
}
