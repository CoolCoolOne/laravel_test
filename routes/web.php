<?php

use App\Http\Controllers\mathController;
use App\Http\Controllers\CarController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


route::get('/car', [CarController::class, 'index']);
route::get('/sum/{a}/{b}', [MathController::class, 'sum'])->whereNumber(['a','b']);
route::get('/subtract/{a}/{b}', [MathController::class, 'subtract'])->whereNumber(['a','b']);