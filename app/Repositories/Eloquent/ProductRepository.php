<?php 

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\ProductRepositoryInterface;
use Prettus\Repository\Eloquent\BaseRepository;
use Illuminate\Container\Container as Application;
use App\Models\Product;
use Lang;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface 
{
 
    public function model()
    {
        return Product::class;
    }

    public function searchProductByName($name)
    {
        return $this->model->where('name', 'like', '%' . $name . '%');
    }
}
