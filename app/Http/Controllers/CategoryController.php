<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function store(Request $request){
        $inputs = $request->all();
        Category::create([
            'name' => $inputs['name'],
        ]);
        return response()->json([
            'ok' => true, 
            'message' => 'category has been created.'
        ], 200);
    }

    public function index(){
        return response()->json([
            'ok' => true, 
            'data' => Category::all(), 
            'message' => 'all categories retrieved'
        ], 200);
    }

    public function update(Request $request, Category $category){
        $inputs = $request->all();
        $category->update($inputs);
        return response()->json([
            'ok' => true, 
            'data' => $category, 
            'message' => 'category has been updated'
        ], 200);
    }

    public function destroy(Category $category){
        $category->delete();
        return response()->json([
            'ok' => true, 
            'message' => 
            'category has been deleted'
        ], 200);
    }
}
