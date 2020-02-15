<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Unit;
use App\Models\Category;
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
        $categories = Category::get();
        $units = Unit::get();
    	return view('themes.items.index',compact('categories','units'));
	}

    public function getData()
    {
        $data = Item::select('id', 'name', 'category_id', 'purchase_price', 'quantity', 'unit_id', 'selling_price', 'gst')->orderBy('id', 'desc')
                        ->get();
        return DataTables::of($data)
        		->addIndexColumn()
                ->editColumn('name', function($row){
                    return ucfirst($row->name);
                })
                ->editColumn('category_id', function($row){
                    return ucfirst($row->categories->name);
                })
                ->editColumn('purchase_price', function($row){
                    return ucfirst($row->purchase_price);
                })
                ->editColumn('quantity', function($row){
                    return ucfirst($row->quantity);
                })
                ->editColumn('unit_id', function($row){
                    return ucfirst($row->units->name);
                })
                ->editColumn('selling_price', function($row){
                    return ucfirst($row->selling_price);
                })
                ->editColumn('gst', function($row){
                    return ucfirst($row->gst);
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

    public function getItemsData()
    {
        $itemIds = $this->request->selectedItems;
        $quantity = $this->request->quantity;
        $itemsData = $this->item->getSelectedItemData($itemIds);
        if($itemsData)
        {
            return response()->json(['itemsInfo' => $itemsData , 'quantity' => $quantity]);
        }
    }
}
