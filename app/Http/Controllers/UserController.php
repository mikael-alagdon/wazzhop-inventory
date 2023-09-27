<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function store(Request $request){
        $inputs = $request->all();
        User::create([
            'name' => $inputs['name'],
            'email' => $inputs['email'],
            'password' => bcrypt($inputs['password'])
        ]);
    }

    public function index(){
        return response()->json([
            'ok' => true, 
            'data' => User::all(), 
            'message' => 'all users retrieved'
        ], 200);
    }

    public function update(Request $request, User $user){
        $inputs = $request->all();
        if(isset($inputs['password'])){
            $inputs['password'] = bcrypt($inputs['password']);
        }
        $user->update($inputs);
        return response()->json([
            'ok' => true, 
            'data' => $user, 
            'message' => 'user has been updated'
        ], 200);
    }

    public function destroy(User $user){
        $user->delete();
        return response()->json([
            'ok' => true, 
            'message' => 'user has been deleted'
        ], 200);
    }
}
