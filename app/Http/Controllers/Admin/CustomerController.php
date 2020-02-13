<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\City;
use DataTables;

class CustomerController extends Controller
{
	private $customer, $request;

    public function __construct(Customer $customer, Request $request)
    {
        $this->request = $request;
        $this->customer = $customer;
    }
    public function index(){
        $cities = City::select('id', 'name')->get();
    	return view('themes.customers.index', compact('cities'));
	}
	public function getData()
    {
        $data = Customer::select('id', 'name', 'email')->orderBy('id', 'desc');
        return DataTables::of($data)
        		->addIndexColumn()
                ->editColumn('name', function($row){
                    return ucfirst($row->name);
                })
                ->addColumn('action', function($row){
                    $btn = '<a href="javascript:;" id="edit-customer" data-id="'.$row->id.'" title="Edit"><i class="fa fa-edit"></i></a>
                            <a href="javascript:;" id="customerDelete" data-id="'.$row->id.'" title="Delete"><i class="fa fa-trash text-danger"></i></a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
    }
  
    public function store()
    {
        $customer = $this->customer->saveCustomer($this->request);
        if($customer){
            if($this->request->id){
                return response()->json(['status' => 'success', 'message' => 'Customer updated successfully']);    
            }
            return response()->json(['status' => 'success', 'message' => 'Customer added successfully']);
        }
        return response()->json(['status' => 'error', 'message' => 'Customer does not added']);
    }

    public function emailValidate()
    {
        $data = Customer::where('email', $this->request->email)
                    ->where('id','!=',$this->request->id)
                    ->first();
        if($data){
            return 'false';
        } else {
            return 'true';
        }
    } 

    public function edit($id)
    {
        $customerData = Customer::find($id);
        return response()->json(compact('customerData'));
    }

    public function destroy($id) {
        $customer = $this->customer->deleteCustomer($id);
        if($customer){
            return response()->json(['status' => 'success', 'message' => 'Customer deleted successfully']); 
        }
        return response()->json(['status' => 'error', 'message' => 'Customer does not deleted']);
    }
}
