<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MathController extends Controller
{
    public function sum(int $x_arg,int $y_arg){
        return ($x_arg+$y_arg);
    }
    public function subtract(int $x_arg,int $y_arg){
        return ($x_arg-$y_arg);
    }
}
