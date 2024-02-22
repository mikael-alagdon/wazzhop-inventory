<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Cache;
use App\Models\Category;

class CategoryController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "name" => ["required", "max:32", "min:4", "unique:categories"],
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
        Cache::forget("categories");
        return response()->json([
            'ok' => true,
            'message' => "Category has been created",
            'data' => $category
        ], 201);
    }

    public function index()
    {
        $categories = Cache::remember('categories', now()->addHours(1), function () {
            $categories = Category::all();
            $categories->map(function($category){
                $category->items;
            });
           return $categories; 
        });
        return response()->json([
            'ok' => true,
            'data' => $categories,
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

    public function paginate(Request $request, $page = 1){
        $inputs = [
            "page" => $page,
            "numOfData" => $request->get("numOfData") ?? 25,
        ];
        $validator = Validator::make($inputs, [
            'page' => 'required|integer|min:1',
            'numOfData' => 'required|integer|min:1|max:100'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'ok' => false,
                'message' => "Request didn't pass the validation",
                'errors' => $validator->errors()
            ], 400);
        }

        $categories = Cache::remember("categories.page=" . $page . ".numOfData=" . $inputs['numOfData'], now()->addSeconds(30), function () use($inputs, $page){
            return Category::limit($inputs["numOfData"])->offset(($page - 1) * $inputs["numOfData"])->get();
        });
        if(!$categories->count()){
            return response()->json([
                'ok' => false,
                'message' => 'Not Found'
            ], 404);
    
        }
        return response()->json([
            'ok' => true,
            'data' => $categories,
            'message' => 'Pages'
        ], 200);

    }
}
