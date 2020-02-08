<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Unit;
use DataTables;

class UnitController extends Controller
{
	private $unit, $request;

    public function __construct(Unit $unit, Request $request)
    {
        $this->request = $request;
        $this->unit = $unit;
    }

    public function index(){
    	return view('themes.units.index');
	}

    public function getData()
    {
        $units = Unit::select('id','name');
        return DataTables::of($units)
                ->addIndexColumn()
                ->editColumn('name', function($row){
                    return ucfirst($row->name);
                })
                ->addColumn('action', function($row){
                    $btn = '<a href="javascript:;" id="edit-unit" data-id="'.$row->id.'" title="Edit"><i class="fa fa-edit"></i></a>
                            <a href="javascript:;" id="unitDelete" data-id="'.$row->id.'" title="Delete"><i class="fa fa-trash text-danger"></i></a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->skipTotalRecords()
                ->toJson();
    }

    
    public function store()
    {
        $unit = $this->unit->saveUnit($this->request);
        if($unit){
            if($this->request->id){
                return response()->json(['status' => 'success', 'message' => 'Unit updated successfully']);    
            }
            return response()->json(['status' => 'success', 'message' => 'Unit added successfully']);
        }
        return response()->json(['status' => 'error', 'message' => 'Unit does not added']);
    }

    public function unitValidate()
    {
        $data = Unit::where('name', $this->request->name)
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
        $unitData = Unit::find($id);
        return response()->json(compact('unitData'));
    }

    public function destroy($id){
        $unit = $this->unit->deleteUnit($id);
        if($unit){
            return response()->json(['status' => 'success', 'message' => 'Unit deleted successfully']); 
        }
        return response()->json(['status' => 'error', 'message' => 'Unit does not deleted']);
    }
}
