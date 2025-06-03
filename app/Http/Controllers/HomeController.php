<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class HomeController extends Controller
{
    public function index(){
        // return View::make('home.index');
        // return view('home.index',[
        //     'name'=>'Alex',
        //     'surname'=> 'Tro',
        // ]);
         return view('home.index')
         ->with ('name', 'Alexx')
         ->with ('surname', 'Tro')
         ->with ('deals', ['books','guitar','gymnastics']);
    }
}
