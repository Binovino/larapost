<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function about(){
        return view('pages.about');
    }

    public function home(){
        return view('pages.home');
    }
    public function welcome(){
        return view('pages.welcome');
    }
}
