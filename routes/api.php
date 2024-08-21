<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DataController;


Route::get('/fetch-iphones', [ProductController::class, 'fetchAndSaveIphones']);
Route::get('/iphones', [ProductController::class, 'index']);

Route::get('/fetch/{type}', [DataController::class, 'fetchAndSave']);
Route::get('/{type}', [DataController::class, 'index']);
