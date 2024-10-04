<?php

use App\Http\Controllers\BlogController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Routes for Book
Route::get('/posts', [BlogController::class, 'index']);
Route::get('/posts/{id}', [BlogController::class, 'show']);
Route::post('/posts', [BlogController::class, 'store']);
Route::put('/posts/{id}', [BlogController::class, 'update']);
Route::delete('/posts/{id}', [BlogController::class, 'destroy']);
