<?php

declare(strict_types=1);

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Interns2024c\Http\Controllers\Auth\ProfileController;
use Interns2024c\Http\Controllers\CourseController;

// home page
Route::get("/", function () {
    return Inertia::render("Welcome", [
        "canLogin" => Route::has("login"),
        "canRegister" => Route::has("register"),
        "laravelVersion" => Application::VERSION,
        "phpVersion" => PHP_VERSION,
    ]);
});

// Dashboard route
Route::get("/dashboard", fn() => Inertia::render("Dashboard"))
    ->middleware(["auth", "verified"])
    ->name("dashboard");


Route::middleware("auth")->group(function (): void {
    Route::get("/profile", [ProfileController::class, "edit"])->name("profile.edit");
    Route::patch("/profile", [ProfileController::class, "update"])->name("profile.update");
    Route::delete("/profile", [ProfileController::class, "destroy"])->name("profile.destroy");
});


Route::middleware(["auth"])->group(function (): void {
    // course crud route
    Route::resource("courses", CourseController::class)
        ->parameters(["courses" => "course"])
        ->whereNumber("course");
});


require __DIR__ . "/auth.php";
