<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TagController;
use App\Http\Controllers\Api\SeriesController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CharacterController;

Route::controller(CategoryController::class)->group(function () {
    Route::get('category', 'index');
    Route::get('category/{id}', 'show');
});

Route::controller(TagController::class)->group(function () {
    Route::get('tag', 'index');
    Route::get('tag/{id}', 'show');

    Route::post('tag', 'store');
    Route::put('tag/{id}', 'update');

    Route::delete('tag/{id}', 'destroy');
});

Route::controller(SeriesController::class)->group(function () {
    Route::get('series', 'index');
    Route::get('series/{id}', 'show');

    Route::post('series', 'store');
    Route::post('series/{id}', 'update');

    Route::delete('series/{id}', 'destroy');
});

Route::controller(CharacterController::class)->group(function () {
    Route::get('character', 'index');
    Route::get('character/{id}', 'show');

    // Route::post('character', 'store');
    // Route::post('character/{id}', 'update');

    // Route::delete('character/{id}', 'destroy');
});
