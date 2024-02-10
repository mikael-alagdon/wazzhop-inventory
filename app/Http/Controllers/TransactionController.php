<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    public function store(Request $request){
        $inputs = $request->all();
        Transaction::create([
            'name' => $inputs['name'],
        ]);
        return response()->json([
            'ok' => true, 
            'message' => 'transaction has been created.'
        ], 200);
    }

    public function index(){
        return response()->json([
            'ok' => true, 
            'data' => Transaction::all(), 
            'message' => 'all transactions retrieved'
        ], 200);
    }

    public function update(Request $request, Transaction $transaction){
        $inputs = $request->all();
        $transaction->update($inputs);
        return response()->json([
            'ok' => true, 
            'data' => $transaction, 
            'message' => 'transaction has been updated'
        ], 200);
    }

    public function destroy(Transaction $transaction){
        $transaction->delete();
        return response()->json([
            'ok' => true, 
            'message' => 
            'transaction has been deleted'
        ], 200);
    }
}
