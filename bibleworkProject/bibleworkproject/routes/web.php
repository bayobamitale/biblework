<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BibleController;

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', [HomeController::class,'homepage']);

Route::post('/search', [BibleController::class, 'search']);
