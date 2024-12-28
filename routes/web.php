<?php

declare(strict_types=1);

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Interns2024c\Http\Controllers\Auth\ProfileController;
use Interns2024c\Http\Controllers\CourseController;

// Ana sayfa rotası
Route::get("/", function () {
    return Inertia::render("Welcome", [
        "canLogin" => Route::has("login"),
        "canRegister" => Route::has("register"),
        "laravelVersion" => Application::VERSION,
        "phpVersion" => PHP_VERSION,
    ]);
});

// Dashboard rotası
Route::get("/dashboard", fn() => Inertia::render("Dashboard"))
    ->middleware(["auth", "verified"])
    ->name("dashboard");

// Profil işlemleri rotaları
Route::middleware("auth")->group(function (): void {
    Route::get("/profile", [ProfileController::class, "edit"])->name("profile.edit");
    Route::patch("/profile", [ProfileController::class, "update"])->name("profile.update");
    Route::delete("/profile", [ProfileController::class, "destroy"])->name("profile.destroy");
});

// Kurs işlemleri rotaları
Route::middleware(["auth"])->group(function (): void {
    // Kurs CRUD rotaları
    Route::resource("courses", CourseController::class)
        ->parameters(["courses" => "course"]) // Parametre adını açıkça belirledik
        ->whereNumber("course"); // 'course' parametresini yalnızca sayısal olarak kabul eder
});

// Auth işlemleri için gerekli rotalar
require __DIR__ . "/auth.php";
