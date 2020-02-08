<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use DataTables;

class CategoryController extends Controller
{
	private $category, $request;

    public function __construct(Category $category, Request $request)
    {
        $this->request = $request;
        $this->category = $category;
    }

	/**
     * Show the categories dashboard.
     */
   	public function index(){
    	return view('themes.categories.index');
	}

    public function getData()
    {
        $data = Category::select('id', 'name', 'description')->orderBy('id', 'desc')
                        ->get();
        return DataTables::of($data)
        		->addIndexColumn()
                ->editColumn('name', function($row){
                    return ucfirst($row->name);
                })
                ->editColumn('description', function($row){
                    return ucfirst($row->description);
                })
                ->addColumn('action', function($row){
                    $btn = '<a href="javascript:;" id="edit-category" data-id="'.$row->id.'" title="Edit"><i class="fa fa-edit"></i></a>
                            <a href="javascript:;" id="categoryDelete" data-id="'.$row->id.'" title="Delete"><i class="fa fa-trash text-danger"></i></a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
    }
  
    /**
     * Store a newly created category
     */
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
    public function destroy($id) {
        $category = $this->category->deleteCategory($id);
        if($category){
            return response()->json(['status' => 'success', 'message' => 'Category deleted successfully']); 
        }
        return response()->json(['status' => 'error', 'message' => 'Category does not deleted']);
    }
}
