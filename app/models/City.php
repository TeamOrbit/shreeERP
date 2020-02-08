<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = [
        'name'
    ];

    public function saveCity($city)
    {
    	return $this->updateOrCreate(
        ['id' => $city['id']],
       	[
            'name' => $city['name']
        ]);  
    }

    public function deleteCity($id)
    {
    	return $this->find($id)->delete();
    }
}
