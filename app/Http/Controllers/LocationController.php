<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\Models\Location;
use Illuminate\Support\Facades\Validator;

class LocationController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "name" => ["required", "max:32", "min:4", "unique:users"],
        ]);
        if ($validator->fails()) {
            return response()->json([
                'ok' => false,
                'message' => "Request didn't pass the validation",
                'errors' => $validator->errors()
            ], 400);
        }
        $validated = $validator->safe()->only('name', 'email', 'password');
        $location = Location::create([
            'name' => $validated['name']
        ]);
        return response()->json([
            'ok' => true,
            'message' => "Location has been created",
            'data' => $location
        ], 400);
    }

    public function index(){
        return response()->json([
            'ok' => true, 
            'data' => Location::all(), 
            'message' => 'All locations retrieved'
        ], 200);
    }

    public function update(Request $request, Location $location)
    {
        $validator = Validator::make($request->all(), [
            "name" => ["sometimes", "max:32", "min:4", "unique:locations"]
        ]);
        if ($validator->fails()) {
            return response()->json([
                'ok' => false,
                'message' => "Request didn't pass the validation",
                'errors' => $validator->errors()
            ], 400);
        }
        $validated = $validator->safe()->only("name");
        $location->update($validated);

        return response()->json([
            'ok' => true,
            'data' => $location,
            'message' => 'Location has been updated'
        ], 200);
    }

    public function destroy(Location $location){
        $location->delete();
        return response()->json([
            'ok' => true, 
            'message' => 
            'Location has been deleted'
        ], 200);
    }
}
