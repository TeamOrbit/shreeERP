<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Supplier;
use App\Models\City;
use DataTables;
use DB;

class SupplierController extends Controller
{
    private $supplier, $request;

    public function __construct(Supplier $supplier, Request $request)
    {
        $this->request = $request;
        $this->supplier = $supplier;
    }
    public function index(){
        $cities = City::select('id', 'name')->get();
    	return view('themes.suppliers.index', compact('cities'));
	}
	public function getData()
    {
        $suppliers = Supplier::select('id', 'company_name',  \DB::raw("CONCAT(suppliers.first_name,' ',suppliers.last_name) as name"), 'email')->orderBy('id', 'desc');

        return DataTables::of($suppliers)
        		->addIndexColumn()
        		->editColumn('company_name', function($row){
                    return ucfirst($row->company_name);
                })
                ->filterColumn('name', function($query, $keyword) {
                    $query->whereRaw("CONCAT(suppliers.first_name,' ',suppliers.last_name) like ?", ["%{$keyword}%"]);
                })
                ->addColumn('name', function($row){
                    return ucfirst($row->name);
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
