<?php

declare(strict_types=1);

namespace Interns2024c\Http\Controllers;

use Inertia\Response;

class WelcomeController extends Controller
{
    public function welcome(): Response
    {
        return inertia("Welcome");
    }
}
