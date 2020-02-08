<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Item;
use DataTables;

class ItemController extends Controller
{
	private $item, $request;

    public function __construct(Item $item, Request $request)
    {
        $this->request = $request;
        $this->item = $item;
    }

   	public function index(){
    	return view('themes.items.index');
	}

    public function getData()
    {
        $data = Item::select('id', 'name', 'description')->orderBy('id', 'desc')
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
                    $btn = '<a href="javascript:;" id="edit-item" data-id="'.$row->id.'" title="Edit"><i class="fa fa-edit"></i></a>
                            <a href="javascript:;" id="itemDelete" data-id="'.$row->id.'" title="Delete"><i class="fa fa-trash text-danger"></i></a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
    }
  
    public function store()
    {
        $item = $this->item->saveItem($this->request);
        if($item){
            if($this->request->id){
                return response()->json(['status' => 'success', 'message' => 'Item updated successfully']);    
            }
            return response()->json(['status' => 'success', 'message' => 'Item added successfully']);
        }
        return response()->json(['status' => 'error', 'message' => 'Item does not added']);
    }

    public function itemValidate()
    {
        $data = Item::where('name', $this->request->name)
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
        $itemData = Item::find($id);
        return response()->json(compact('itemData'));
    }

    public function destroy($id) {
        $item = $this->item->deleteItem($id);
        if($item){
            return response()->json(['status' => 'success', 'message' => 'Item deleted successfully']); 
        }
        return response()->json(['status' => 'error', 'message' => 'Item does not deleted']);
    }
}
