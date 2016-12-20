<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Order;
use App\Models\BaseModel;

class Receiver extends BaseModel
{
    protected $table = 'receivers';

    public function rules($ruleName)
    {
        if ($ruleName == 'create') {
            return [
                'name' => 'required|max:50|unique:collections,name'
            ];
        }

        return [
            'name' => 'required|max:50|unique:collections,name,' . $this->id
        ];
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
