<?php 

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\CategoryRepositoryInterface;
use Prettus\Repository\Eloquent\BaseRepository;
use Illuminate\Container\Container as Application;
use App\Models\Category;
use Lang;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface 
{
 
    public function model()
    {
        return Category::class;
    }

    private function validate($data, $ruleName)
    {
        return $this->model->validate($data, $ruleName);
    }

    public function paginate($perPage = 0, $columns = ['*']) 
    {
        return $this->model->paginate($perPage, $columns);
    }

    public function create(array $data)
    {
        if ($this->validate($data, 'create')) {
            $this->model->create($data);
            return redirect()->route('category.index')->with([
                'flash_level' => Lang::get('admin.success'),
                'flash_message' => Lang::get('admin.message.add_success', ['name' => 'Category'])
            ]);
        }
        return redirect()->back()->withErrors($this->model->valid());
    }

    public function getParents()
    {
        return $this->model->select('id', 'name', 'parent_id')->get();
    }

    public function getSubCategory($id)
    {
        return $this->model->where('parent_id', $id)->get();
    }
    
    public function getCategory($take = 9)
    {
        return $this->model->where('sort', '<>', 0)
            ->where('parent_id', null)
            ->orderBy('sort', 'asc')->take($take)->get();
    }
}
