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
        $data = City::select('id', 'name')->orderBy('id', 'desc')
                        ->get();
        return DataTables::of($data)
                ->editColumn('name', function($row){
                    return ucfirst($row->name);
                })
                ->addColumn('action', function($row){
                    $btn = '<a href="javascript:;" id="edit-city" data-id="'.$row->id.'" title="Edit"><i class="fa fa-edit"></i></a>
                            <a href="javascript:;" id="cityDelete" data-id="'.$row->id.'" title="Delete"><i class="fa fa-trash text-danger"></i></a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
    }

    
    public function store()
    {
        $category = $this->category->saveCategory($this->request);
        if($category){
            if($this->request->id){
                return response()->json(['status' => 'success', 'message' => 'Category updated successfully']);    
            }
            return response()->json(['status' => 'success', 'message' => 'Category added successfully']);
        }
        return response()->json(['status' => 'error', 'message' => 'Category does not added']);
    }

    public function categoryValidate()
    {
        $data = Category::where('name', $this->request->name)
                    ->where('id','!=',$this->request->id)
                    ->first();
        if($data){
            return 'false';
        } else {
            return 'true';
        }
    } 

    /**
     * Show the form for editing a specified category
     */
    public function edit($id)
    {
        $categoryData = Category::find($id);
        return response()->json(compact('categoryData'));
    }

    /**
     * Remove the specified category
     */
    public function destroy($id)
    {
        $questions = $this->questionBank::where('category_id', $id)->first();
        $exams = $this->exam::where('category_id', $id)->first();
        if ($questions) {
            return response()->json(['status' => 'error', 'message' => 'Sorry! Category is present in question bank']); 
        } else if ($exams){
            return response()->json(['status' => 'error', 'message' => 'Sorry! Category is present in exams']);
        } else{
            if($this->category->deleteCategory($id)){
                return response()->json(['status' => 'success', 'message' => 'Category deleted successfully']); 
            }
            return response()->json(['status' => 'error', 'message' => 'Category does not deleted']);
        }
    }
}
