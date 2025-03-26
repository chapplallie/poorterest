<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::post('/categories',
    [CategoryController::class, 'store']); 

Route::put('/categories/{id}/deactivate',
    [CategoryController::class, 'deactivate']);

