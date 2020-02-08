<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $fillable = [
        'name'
    ];

    public function saveUnit($unit)
    {
    	return $this->updateOrCreate(
        ['id' => $unit['id']],
       	[
            'name' => $unit['name']
        ]);  
    }

    public function deleteUnit($id)
    {
    	return $this->find($id)->delete();
    }
}
