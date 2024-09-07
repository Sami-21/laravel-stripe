<?php

use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



Route::controller(ProductController::class)
    ->prefix('products')
    ->group(function () {
        Route::get('/all', 'index');
        Route::post('/store', 'store');
        Route::get('/{id}', 'show');
    });
