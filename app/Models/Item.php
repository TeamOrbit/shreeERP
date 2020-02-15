<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Item;

class Item extends Model
{
    protected $fillable = [
        'name', 'description', 'purchase_price', 'quantity', 'category_id', 'unit_id', 'selling_price', 'gst'
    ];

    public function saveItem($item)
    {
    	return $this->updateOrCreate(
        ['id' => $item['id']],
       	[
            'name' => $item['name'],
            'description' => $item['description'],
            'purchase_price' => $item['purchase_price'],
            'quantity' => $item['quantity'],
            'category_id' => $item['category'],
            'unit_id' => $item['unit'],
            'selling_price' => $item['selling_price'],
            'gst' => $item['gst']
        ]);  
    }

    public function deleteItem($id)
    {
    	return $this->find($id)->delete();
    }

    public function getSelectedItemData($itemIds)
    {
        $itemsInfo = $this->whereIn('id', $itemIds)->get();
        return $itemsInfo;
    }

    public function categories() {
        return $this->belongsTo('App\Models\Category','category_id');
    }

    public function units() {
        return $this->belongsTo('App\Models\Unit','unit_id');
    }
}
