<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = [
        'company_name','first_name','last_name', 'email', 'phone', 'gender', 'address', 'city', 'state', 'country', 'pincode', 'gst_no', 'pancard_no'
    ];

    public function saveSupplier($supplier)
    {
    	return $this->updateOrCreate(
        ['id' => $supplier['id']],
       	[
            'company_name' => $supplier['company_name'],
            'first_name' => $supplier['first_name'],
            'last_name' => $supplier['last_name'],
            'email' => $supplier['email'],
            'phone' => $supplier['phone'],
            'gender' => $supplier['gender'],
            'address' => $supplier['address'],
            'city' => $supplier['city'],
            'pincode' => $supplier['pincode'],
            'state' => $supplier['state'],
            'country' => $supplier['country'],
            'gst_no' => $supplier['gst_no'],
            'pancard_no' => $supplier['pancard_no']
        ]);  
    }

    public function deleteSupplier($id)
    {
    	return $this->find($id)->delete();
    }
}
