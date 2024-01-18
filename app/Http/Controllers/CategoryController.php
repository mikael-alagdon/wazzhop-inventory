<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function store(Request $request)
    {
        $inputs = $request->all();
        Category::create([
            'name' => $inputs['name'],
        ]);
        return response()->json([
            'ok' => true,
            'message' => 'category has been created.'
        ], 200);
    }

    public function index()
    {
        return response()->json([
            'ok' => true,
            'data' => Category::all(),
            'message' => 'all categories retrieved'
        ], 200);
    }

    public function update1(Request $request, Category $category)
    {
        $inputs = $request->all();
        $category->update($inputs);
        return response()->json([
            'ok' => true,
            'data' => $category,
            'message' => 'category has been updated'
        ], 200);
    }
    public function update(Request $request, Category $category)
    {
        $validator = Validator::make($request->all(), [
            "name" => ["sometimes", "max:32", "min:4", "unique:item, name," . $category->id],
            "description" => "sometimes|max:64|regex:/^[a-z ,. '-]+$/i",
        ]);
        if ($validator->fails()) {
            return response()->json([
                'ok' => false,
                'message' => "Request didn't pass the validation",
                'errors' => $validator->errors()
            ], 400);
        }
        $validated = $validator->safe()->only("name");
        $category->update($validated);
        $category->profile->update($validator->safe()->except("name"));

        return response()->json([
            'ok' => true,
            'data' => $category,
            'message' => 'Item has been updated'
        ], 200);
    }


    public function destroy(Category $category)
    {
        $category->delete();
        return response()->json([
            'ok' => true,
            'message' =>
            'category has been deleted'
        ], 200);
    }
}
