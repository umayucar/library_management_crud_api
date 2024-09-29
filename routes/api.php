<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\LibraryController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Public routes for registration and login
Route::controller(AuthController::class)->group(function () {
    Route::post('register', 'register')->name('register'); 
    Route::post('login', 'login')->name('login');        
});

// Protected routes for authenticated users
Route::middleware('auth:sanctum')->group(function () {
    // API resource routes for users, books, and authors
    Route::apiResource('users', UserController::class);
    Route::apiResource('books', BookController::class);
    Route::apiResource('authors', AuthorController::class);
    Route::apiResource('libraries', LibraryController::class);

    // for media updates:
    Route::post('/books/{book}/media', [BookController::class, 'updateMedia']);
    Route::post('/authors/{author}/media', [AuthorController::class, 'updateMedia']);
});

