<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\Models\Location;

class LocationController extends Controller
{
    public function store(Request $request){
        $inputs = $request->all();
        Location::create([
            'name' => $inputs['name'],
        ]);
        return response()->json([
            'ok' => true, 
            'message' => 'location has been created.'
        ], 200);
    }

    public function index(){
        return response()->json([
            'ok' => true, 
            'data' => Location::all(), 
            'message' => 'all locations retrieved'
        ], 200);
    }

    public function update(Request $request, Location $location){
        $inputs = $request->all();
        $location->update($inputs);
        return response()->json([
            'ok' => true, 
            'data' => $location, 
            'message' => 'location has been updated'
        ], 200);
    }

    public function destroy(Location $location){
        $location->delete();
        return response()->json([
            'ok' => true, 
            'message' => 
            'location has been deleted'
        ], 200);
    }
}
