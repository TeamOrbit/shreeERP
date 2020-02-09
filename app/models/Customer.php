<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'name', 'email', 'phone', 'gender', 'address', 'city', 'state', 'country', 'pincode'
    ];

    public function saveCustomer($customer)
    {
    	return $this->updateOrCreate(
        ['id' => $customer['id']],
       	[
            'name' => $customer['name'],
            'email' => $customer['email'],
            'phone' => $customer['phone'],
            'gender' => $customer['gender'],
            'address' => $customer['address'],
            'city' => $customer['city'],
            'pincode' => $customer['pincode'],
            'state' => $customer['state'],
            'country' => $customer['country']
        ]);  
    }

    public function deleteCustomer($id)
    {
    	return $this->find($id)->delete();
    }
}
