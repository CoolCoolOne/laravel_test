<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\mathController;
// use App\Http\Controllers\CarController;
use Illuminate\Support\Facades\Route;

route::get('/home/', [HomeController::class, 'index'])->name('home');

route::get('/', [HomeController::class, 'layout'])->name('layout');

// route::get('/sum/{a}/{b}', [MathController::class, 'sum'])->whereNumber(['a','b']);
// route::get('/subtract/{a}/{b}', [MathController::class, 'subtract'])->whereNumber(['a','b']);