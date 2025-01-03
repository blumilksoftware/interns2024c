<?php

declare(strict_types=1);

namespace Interns2024c\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Interns2024c\Models\Course;

class CourseController extends Controller
{
    use AuthorizesRequests;

    public function index(Request $request)
    {
        // Sadece İngilizce kursları filtrelemek
        $query = Course::query();


        // Skill Level (Seviye) filtresi
        if ($request->filled('skill_level')) {
            $query->where('skill_level', $request->skill_level);
        }

        // Sıralama Kriteri
        $sortBy = $request->get('sort_by', 'id'); // Varsayılan olarak 'id' ile sıralar
        $order = $request->get('order', 'asc');  // Varsayılan olarak 'asc'

        // Desteklenen sıralama alanları
        $allowedSortBy = ['title', 'created_at', 'id'];

        if (in_array($sortBy, $allowedSortBy)) {
            $query->orderBy($sortBy, $order);
        }

        // Kursları sayfalandırarak al
        $courses = $query->paginate(6); // Her sayfada 6 kurs göster

        // Filtreleri Vue'ya gönder
        return inertia('Courses/Index', [
            'courses' => $courses,
            'filters' => $request->only('skill_level', 'sort_by', 'order'),
        ]);
    }




    public function create()
    {
        return Inertia::render("Courses/Create");
    }

    public function show($id)
    {
        $course = Course::findOrFail($id);

        return Inertia::render("Courses/Show", [
            "course" => $course,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            "title" => "required|string|max:255",
            "description" => "required|string",
            "language" => "required|string",
            "skill_level" => "required|string",
        ]);

        $request->user()->courses()->create($validated);

        return redirect()->route("courses.index")->with("success", "Course created successfully.");
    }

    public function edit(Course $course)
    {
        return Inertia::render("Courses/Edit", ["course" => $course]);
    }

    public function update(Request $request, Course $course)
    {
        $this->authorize("update", $course);

        $validated = $request->validate([
            "title" => "required|string|max:255",
            "description" => "required|string",
            "language" => "required|string",
            "skill_level" => "required|string",
        ]);

        $course->update($validated);

        return redirect()->route("courses.index")->with("success", "Course updated successfully.");
    }

    public function destroy(Course $course)
    {
        $this->authorize("delete", $course);

        $course->delete();

        return redirect()->route("courses.index")->with("success", "Course deleted successfully.");
    }
}
