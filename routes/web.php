<?php

declare(strict_types=1);

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Interns2024c\Http\Controllers\Auth\ProfileController;
use Interns2024c\Http\Controllers\CourseMaterialController;

// Welcome page
Route::get("/", function () {
    return Inertia::render("Welcome", [
        "canLogin" => Route::has("login"),
        "canRegister" => Route::has("register"),
        "laravelVersion" => Application::VERSION,
        "phpVersion" => PHP_VERSION,
    ]);
});

// Dashboard route
Route::get("/dashboard", fn() => Inertia::render("Dashboard"))->middleware(["auth", "verified"])->name("dashboard");

// Course Materials routes
Route::middleware(['web', 'auth'])->group(function (): void {
    Route::resource('course-materials', CourseMaterialController::class);
});

// Profile routes
Route::middleware("auth")->group(function (): void {
    Route::get("/profile", [ProfileController::class, "edit"])->name("profile.edit");
    Route::patch("/profile", [ProfileController::class, "update"])->name("profile.update");
    Route::delete("/profile", [ProfileController::class, "destroy"])->name("profile.destroy");
});

// Debug lessons route
Route::get('/debug-lessons', function () {
    return response()->json(['success' => true, 'lessons' => \Interns2024c\Models\Lesson::all()]);
});

// Auth routes
require __DIR__ . "/auth.php";
