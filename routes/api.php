<?php

use App\Http\Controllers\CityController;
use App\Http\Controllers\CountyController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Users
Route::post('/users/login', [UserController::class, 'login']);
Route::get('/users', [UserController::class, 'index'])->middleware('auth:sanctum');

// Cities
Route::get('cities', [CityController::class, 'index']);
Route::post('city', [CityController::class, 'store'])->middleware('auth:sanctum');
Route::put('cities/{id}', [CityController::class, 'update'])->middleware('auth:sanctum');
Route::delete('cities/{id}', [CityController::class, 'destroy'])->middleware('auth:sanctum');

// Counties
Route::get('counties', [CountyController::class, 'index']);
Route::post('county', [CountyController::class, 'store'])->middleware('auth:sanctum');
Route::put('counties/{id}', [CountyController::class, 'update'])->middleware('auth:sanctum');
Route::delete('counties/{id}', [CountyController::class, 'destroy'])->middleware('auth:sanctum');