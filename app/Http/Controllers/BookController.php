<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class BookController extends Controller
{
    public function __construct()
    {
        
    }

    public function book(){
        $response = "Data all book";
        return response()->json($response, 200);
    }

    public function bookAuth(){
        $response = "Welcome ". Auth::user()->name;
        return response()->json($response, 200);
    }
    
}
