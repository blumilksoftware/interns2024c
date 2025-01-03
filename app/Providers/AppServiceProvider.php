<?php

declare(strict_types=1);

namespace Interns2024c\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;
use Inertia\Inertia;
use Interns2024c\Models\Course;
use Interns2024c\Policies\CoursePolicy;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Vite prefetch
        Vite::prefetch(concurrency: 3);

        // Inertia auth
        Inertia::share([
            "auth" => function () {
                return [
                    "user" => Auth::user(),
                ];
            },
        ]);


        Gate::policy(Course::class, CoursePolicy::class);
    }
}
