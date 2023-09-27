<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class ItemController extends Controller
{
    public function store(Request $request){
        $inputs = $request->all();
        Item::create([
            'name' => $inputs['name'],
            'description' => $inputs['description'],
            'category_id' => 1,
        ]);
        return response()->json([
            'ok' => true, 
            'message' => 'item has been created.'
        ], 200);
    }

    public function index(){
        return response()->json([
            'ok' => true, 
            'data' => Item::all(), 
            'message' => 'all items retrieved'
        ], 200);
    }

    public function update(Request $request, Item $item){
        $inputs = $request->all();
        $item->update($inputs);
        return response()->json([
            'ok' => true, 
            'data' => $item, 
            'message' => 'item has been updated'
        ], 200);
    }

    public function destroy(Item $item){
        $item->delete();
        return response()->json([
            'ok' => true, 
            'message' => 
            'item has been deleted'
        ], 200);
    }
}
