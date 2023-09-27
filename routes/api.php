<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Users

// ULR/api/register
Route::post('register', [App\Http\Controllers\UserController::class, 'store']);
// ULR/api/users
Route::get('/users', [App\Http\Controllers\UserController::class, 'index']);
// ULR/api/users/{id}
Route::patch('/users/{user}', [App\Http\Controllers\UserController::class, 'update']);
// ULR/api/users/{id}
Route::delete('/users/{user}', [App\Http\Controllers\UserController::class, 'destroy']);

//Categories

// ULR/api/categories/add
Route::post('categories/add', [App\Http\Controllers\CategoryController::class, 'store']);
// ULR/api/categories
Route::get('/categories', [App\Http\Controllers\CategoryController::class, 'index']);
// ULR/api/categories/{id}
Route::patch('/categories/{category}', [App\Http\Controllers\CategoryController::class, 'update']);
// ULR/api/categories/{id}
Route::delete('/categories/{category}', [App\Http\Controllers\CategoryController::class, 'destroy']);

//Items

// ULR/api/items/add
Route::post('items/add', [App\Http\Controllers\ItemController::class, 'store']);
// ULR/api/items
Route::get('/items', [App\Http\Controllers\ItemController::class, 'index']);
// ULR/api/items/{id}
Route::patch('/items/{item}', [App\Http\Controllers\ItemController::class, 'update']);
// ULR/api/items/{id}
Route::delete('/items/{item}', [App\Http\Controllers\ItemController::class, 'destroy']);

//Locations

// ULR/api/locations/add
Route::post('locations/add', [App\Http\Controllers\LocationController::class, 'store']);
// ULR/api/items
Route::get('/locations', [App\Http\Controllers\LocationController::class, 'index']);
// ULR/api/items/{id}
Route::patch('/locations/{location}', [App\Http\Controllers\LocationController::class, 'update']);
// ULR/api/items/{id}
Route::delete('/locations/{location}', [App\Http\Controllers\LocationController::class, 'destroy']);

//Transactions

// ULR/api/transactions/add
Route::post('transactions/add', [App\Http\Controllers\TransactionController::class, 'store']);
// ULR/api/items
Route::get('/transactions', [App\Http\Controllers\TransactionController::class, 'index']);
// ULR/api/items/{id}
Route::patch('/transactions/{transaction}', [App\Http\Controllers\TransactionController::class, 'update']);
// ULR/api/items/{id}
Route::delete('/transactions/{transaction}', [App\Http\Controllers\TransactionController::class, 'destroy']);