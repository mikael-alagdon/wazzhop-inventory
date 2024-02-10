<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "name" => ["required", "max:32", "min:4", "unique:items"],
        ]);
        if ($validator->fails()) {
            return response()->json([
                'ok' => false,
                'message' => "Request didn't pass the validation",
                'errors' => $validator->errors()
            ], 400);
        }
        $validated = $validator->safe()->only('name');
        $category = Category::create([
            'name' => $validated['name']
        ]);
        return response()->json([
            'ok' => true,
            'message' => "Item has been created",
            'data' => $category
        ], 200);
    }

    public function index()
    {
        return response()->json([
            'ok' => true,
            'data' => Category::all(),
            'message' => 'All categories retrieved'
        ], 200);
    }

    public function update(Request $request, Category $category)
    {
        $validator = Validator::make($request->all(), [
            "name" => ["sometimes", "max:32", "min:4", "unique:categories"],
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

        return response()->json([
            'ok' => true,
            'data' => $category,
            'message' => 'Category has been updated'
        ], 200);
    }


    public function destroy(Category $category)
    {
        $category->delete();
        return response()->json([
            'ok' => true,
            'message' =>
            'Category has been deleted'
        ], 200);
    }
}
