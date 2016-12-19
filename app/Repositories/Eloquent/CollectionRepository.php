<?php 

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\CollectionRepositoryInterface;
use Prettus\Repository\Eloquent\BaseRepository;
use App\Models\Collection;
use Lang;

class CollectionRepository extends BaseRepository implements CollectionRepositoryInterface
{
    public function model()
    {
        return Collection::class;
    }
}
