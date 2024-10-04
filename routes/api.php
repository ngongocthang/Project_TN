<?php

use Illuminate\Support\Facades\Route;

Route::get('/reports', [App\Http\Controllers\Api\DataController::class, 'repost']);
Route::get('/stocks', [App\Http\Controllers\Api\DataController::class, 'stock']);

