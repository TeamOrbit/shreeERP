<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Supplier;
use DataTables;

class SupplierController extends Controller
{
    private $supplier, $request;

    public function __construct(Supplier $supplier, Request $request)
    {
        $this->request = $request;
        $this->supplier = $supplier;
    }
    public function index(){
    	return view('themes.suppliers.index');
	}
	public function getData()
    {
        $data = Supplier::select('id', 'company_name', 'first_name', 'last_name', 'email')->orderBy('id', 'desc');
        return DataTables::of($data)
        		->addIndexColumn()
        		->editColumn('company_name', function($row){
                    return ucfirst($row->company_name);
                })
                ->addColumn('name', function($row){
                    return ucfirst($row->first_name). ' ' .ucfirst($row->last_name);
                })
                ->addColumn('action', function($row){
                    $btn = '<a href="javascript:;" id="edit-supplier" data-id="'.$row->id.'" title="Edit"><i class="fa fa-edit"></i></a>
                            <a href="javascript:;" id="supplierDelete" data-id="'.$row->id.'" title="Delete"><i class="fa fa-trash text-danger"></i></a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->skipTotalRecords()
                ->toJson();
    }
  
    public function store()
    {
        $supplier = $this->supplier->saveSupplier($this->request);
        if($supplier){
            if($this->request->id){
                return response()->json(['status' => 'success', 'message' => 'Supplier updated successfully']);    
            }
            return response()->json(['status' => 'success', 'message' => 'Supplier added successfully']);
        }
        return response()->json(['status' => 'error', 'message' => 'Supplier does not added']);
    }

    public function emailValidate()
    {
        $data = Supplier::where('email', $this->request->email)
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
        $supplierData = Supplier::find($id);
        return response()->json(compact('supplierData'));
    }

    public function destroy($id) {
        $supplier = $this->supplier->deleteSupplier($id);
        if($supplier){
            return response()->json(['status' => 'success', 'message' => 'Supplier deleted successfully']); 
        }
        return response()->json(['status' => 'error', 'message' => 'Supplier does not deleted']);
    }
}
