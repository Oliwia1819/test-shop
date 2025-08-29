<?php

use App\Http\Controllers\CommentsController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login']);
Route::post('/register', [\App\Http\Controllers\AuthController::class, 'register']);
Route::resource('products', ProductController::class);
Route::post('/products/{productId}/comments', [CommentsController::class, 'store'])
    ->middleware('auth')
    ->name('comments.store');

Route::delete('/comments/{comment}', [CommentsController::class, 'destroy'])
    ->middleware('auth')
    ->name('comments.destroy');
Route::middleware('auth:sanctum')->get('/orders/history', [OrderController::class, 'history']);
