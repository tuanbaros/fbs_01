<?php

namespace App\Repositories\Contracts;

use Prettus\Repository\Contracts\RepositoryInterface;

interface CategoryRepositoryInterface extends RepositoryInterface
{
    public function getParents();

    public function getSubCategory($id);
}
