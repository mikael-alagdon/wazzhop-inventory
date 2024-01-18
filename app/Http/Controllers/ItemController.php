<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use Illuminate\Support\Facades\Validator;

class ItemController extends Controller
{
    public function store(Request $request)
    {
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

    public function index()
    {
        return response()->json([
            'ok' => true,
            'data' => Item::all(),
            'message' => 'all items retrieved'
        ], 200);
    }


    public function update(Request $request, Item $item)
    {
        $validator = Validator::make($request->all(), [
            "name" => ["sometimes", "max:32", "min:4", "unique:item, name," . $item->id],
            "description" => "sometimes|max:64|regex:/^[a-z ,. '-]+$/i",
        ]);
        if ($validator->fails()) {
            return response()->json([
                'ok' => false,
                'message' => "Request didn't pass the validation",
                'errors' => $validator->errors()
            ], 400);
        }
        $validated = $validator->safe()->only("name", "description", "category_id");
        $item->update($validated);
        $item->category->update($validator->safe()->except("name", "description", "category_id"));

        return response()->json([
            'ok' => true,
            'data' => $item,
            'message' => 'Item has been updated'
        ], 200);
    }


    public function destroy(Item $item)
    {
        $item->delete();
        return response()->json([
            'ok' => true,
            'message' =>
            'item has been deleted'
        ], 200);
    }
}
