<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::view('/items', 'item');
Route::post('/item/post', [\App\Http\Controllers\ItemController::class, 'store']);
Route::get('/items/detail', [\App\Http\Controllers\ItemController::class, 'show']);
