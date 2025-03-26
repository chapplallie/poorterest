<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/categories',
    [CategoryController::class, 'store']); 

Route::put('/categories/{id}/deactivate',
    [CategoryController::class, 'deactivate']);

