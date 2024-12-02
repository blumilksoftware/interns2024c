<?php

namespace Interns2024c\Http\Controllers;

use Inertia\Response;
use Illuminate\Support\Facades\Auth;

class WelcomeController extends Controller
{
    public function welcome(): Response
    {
        return inertia('Welcome');
    }
}
