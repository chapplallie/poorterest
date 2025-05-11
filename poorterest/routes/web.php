<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Middleware\CheckIfUserActive;
use App\Http\Controllers\MediaController;

Route::get('/',
    [MediaController::class, 'index'])->name('welcome');

Auth::routes();

Route::get('/home',
    [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/users',
    [App\Http\Controllers\ProfileController::class, 'index'])->middleware('auth')->name('users');

Route::get('/categories', [CategoryController::class, 'index'])->middleware('auth')->name('categories');
Route::post('/categories', [CategoryController::class, 'store'])->middleware('auth')->name('categories.store');
Route::get('/categories/create', [CategoryController::class, 'create'])->middleware('auth')->name('categories.create');
Route::put('/categories/{id}/deactivate',
    [CategoryController::class, 'deactivate'])->middleware('auth')->name('categories.deactivate');
Route::put('/categories/{id}/activate', [CategoryController::class, 'activate'])->name('categories.activate');


Route::get('/profile',
    [ProfileController::class, 'show'])->middleware('auth')->name('profile');
Route::get('/profile/edit',
    [ProfileController::class, 'edit'])->middleware('auth')->name('profile.edit');
Route::put('/profile/{id}',
    [ProfileController::class, 'update'])->middleware('auth')->name('profile.update');
Route::delete('/profile/{id}',
    [ProfileController::class, 'deactivate'])->middleware('auth')->name('profile.deactivate');

Route::get('user/edit/{id}',
    [ProfileController::class, 'editUser'])->middleware('auth')->name('users.edit');
Route::put('user/{id}',
    [ProfileController::class, 'update'])->middleware('auth')->name('users.update');