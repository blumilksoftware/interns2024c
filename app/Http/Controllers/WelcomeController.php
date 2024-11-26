<?php

namespace Interns2024c\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function welcome(){
        return view('app');
    }
}
