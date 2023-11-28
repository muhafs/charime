<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TagController;
use App\Http\Controllers\Api\CategoryController;

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
