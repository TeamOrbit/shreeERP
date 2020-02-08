<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name', 'description'
    ];

    public function saveCategory($category)
    {
    	return $this->updateOrCreate(
        ['id' => $category['id']],
       	[
            'name' => $category['name'],
            'description' => $category['description']
        ]);  
    }

    public function deleteCategory($id)
    {
    	return $this->find($id)->delete();
    }
}
