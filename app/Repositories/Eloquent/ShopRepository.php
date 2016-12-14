<?php 

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\ShopRepositoryInterface;
use Prettus\Repository\Eloquent\BaseRepository;
use App\Models\Shop;
use Lang;

class ShopRepository extends BaseRepository implements ShopRepositoryInterface
{
    public function model()
    {
        return Shop::class;
    }

    private function validate($data, $ruleName)
    {
        return $this->model->validate($data, $ruleName);
    }

    public function create(array $data)
    {
        if ($this->validate($data, 'create')) {
            $this->model->create($data);
        }
        
        return redirect()->back()->withErrors($this->model->valid());
    }
}
