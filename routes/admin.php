<?php

use Illuminate\Support\Facades\Route;





Route::middleware('guest')->group(function (){
    Route::get('/', [\App\Http\Controllers\auth\authController::class, 'welcome'])->name('welcome');
    Route::get('/register', [\App\Http\Controllers\auth\authController::class, 'index'])->name('register');
    Route::post('/register', [\App\Http\Controllers\auth\authController::class, 'register']);
    Route::get('/login', [\App\Http\Controllers\auth\loginController::class, 'index'])->name('login');
    Route::post('/login', [\App\Http\Controllers\auth\loginController::class, 'login']);
    Route::get('/forgetPassword',[\App\Http\Controllers\auth\forgetPasswordManager::class, 'index'] )->name('forgetPassword');
    Route::post('/forgetPassword',[\App\Http\Controllers\auth\forgetPasswordManager::class, 'forgetPassword'] )->name('forgetPasswordPost');
    Route::get('/resetPassword/{token}',[\App\Http\Controllers\auth\forgetPasswordManager::class, 'resetPassword'] )->name('resetPassword');
    Route::post('/resetPassword/post',[\App\Http\Controllers\auth\forgetPasswordManager::class, 'resetPasswordPost'])->name('resetPasswordPost');

});
Route::prefix('dashboard')->middleware('auth')->group(function (){
    Route::get('/', [\App\Http\Controllers\auth\authController::class, 'dashboard'])->name('dashboard');
    Route::get('/logout', [\App\Http\Controllers\auth\authController::class, 'logout'])->name('logout');
    Route::resource('category', \App\Http\Controllers\admin\categoryController::class);
    Route::resource('sub_category', \App\Http\Controllers\admin\subCategoryController::class);
    Route::resource('brand', \App\Http\Controllers\admin\brandController::class);
    Route::get('/brand_name', [App\Http\Controllers\admin\brandController::class, 'brand_name']);
    Route::resource('product', \App\Http\Controllers\admin\productController::class);
});

Route::get('/myuser', [App\Http\Controllers\admin\categoryController::class, 'userview']);
