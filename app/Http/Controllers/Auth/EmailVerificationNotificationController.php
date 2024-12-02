<?php

declare(strict_types=1);

namespace Interns2024c\Http\Controllers\Auth;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Interns2024c\Http\Controllers\Controller;

class EmailVerificationNotificationController extends Controller
{
    /**
     * Send a new email verification notification.
     */
    public function store(Request $request): RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended(route("dashboard", absolute: false));
        }

        $request->user()->sendEmailVerificationNotification();

        return back()->with("status", "verification-link-sent");
    }
}
