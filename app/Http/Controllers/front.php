<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class front extends Controller
{
    public function home()
    {
        return view('front.front');
    }
}
