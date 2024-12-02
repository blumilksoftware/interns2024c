<?php

declare(strict_types=1);

namespace Interns2024c\Http\Controllers\Auth;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Interns2024c\Http\Controllers\Controller;

class EmailVerificationPromptController extends Controller
{
    /**
     * Display the email verification prompt.
     */
    public function __invoke(Request $request): RedirectResponse|Response
    {
        return $request->user()->hasVerifiedEmail()
                    ? redirect()->intended(route("dashboard", absolute: false))
                    : Inertia::render("Auth/VerifyEmail", ["status" => session("status")]);
    }
}
