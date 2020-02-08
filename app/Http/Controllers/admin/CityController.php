<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\City;
use DataTables;

class CityController extends Controller
{
    private $city, $request;

    public function __construct(City $city, Request $request)
    {
        $this->request = $request;
        $this->city = $city;
    }

    public function index()
    {
    	return view('themes.cities.index');
    }

    public function getData()
    {
        $cities = City::select('id','name');
        return DataTables::of($cities)
                ->addIndexColumn()
                ->editColumn('name', function($row){
                    return ucfirst($row->name);
                })
                ->addColumn('action', function($row){
                    $btn = '<a href="javascript:;" id="edit-city" data-id="'.$row->id.'" title="Edit"><i class="fa fa-edit"></i></a>
                            <a href="javascript:;" id="cityDelete" data-id="'.$row->id.'" title="Delete"><i class="fa fa-trash text-danger"></i></a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->skipTotalRecords()
                ->toJson();
    }

    
    public function store()
    {
        $city = $this->city->saveCity($this->request);
        if($city){
            if($this->request->id){
                return response()->json(['status' => 'success', 'message' => 'City updated successfully']);    
            }
            return response()->json(['status' => 'success', 'message' => 'City added successfully']);
        }
        return response()->json(['status' => 'error', 'message' => 'City does not added']);
    }

    public function cityValidate()
    {
        $data = City::where('name', $this->request->name)
                    ->where('id','!=',$this->request->id)
                    ->first();
        if($data){
            return 'false';
        } else {
            return 'true';
        }
    } 

    /**
     * Show the form for editing a specified city
     */
    public function edit($id)
    {
        $cityData = City::find($id);
        return response()->json(compact('cityData'));
    }

    /**
     * Remove the specified city
     */
    public function destroy($id){
        $city = $this->city->deleteCity($id);
        if($city){
            return response()->json(['status' => 'success', 'message' => 'City deleted successfully']); 
        }
        return response()->json(['status' => 'error', 'message' => 'City does not deleted']);
    }
    
}
