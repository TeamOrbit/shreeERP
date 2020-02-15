<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Supplier;
use App\Models\Item;

class PurchaseController extends Controller
{
    public function index(){
    	$items = Item::get();
    	$suppliers = Supplier::get();
    	return view('themes.purchases.index',compact('suppliers','items'));
	}
}
