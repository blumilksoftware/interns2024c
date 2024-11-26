<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Inertia\Response;
use Interns2024c\Http\Controllers\WelcomeController;






Route::get('/', [WelcomeController::class, 'welcome'])->name('welcome');
