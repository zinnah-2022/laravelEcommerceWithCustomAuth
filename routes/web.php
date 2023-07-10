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
Route::get('/taher/view', [App\Http\Controllers\admin\apiController::class, 'index']);
Route::get('/dashboard/product/sub_category/{id}',[\App\Http\Controllers\admin\axionAPI::class,'subcategory']);

