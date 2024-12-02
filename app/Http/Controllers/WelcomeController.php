<?php

namespace Interns2024c\Http\Controllers;

use Inertia\Response;


class WelcomeController extends Controller
{
    public function welcome(){
        return inertia('Welcome');
    }
}
