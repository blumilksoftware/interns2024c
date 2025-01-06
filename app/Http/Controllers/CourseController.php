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

        $query = Course::query();



        if ($request->filled('skill_level')) {
            $query->where('skill_level', $request->skill_level);
        }


        $sortBy = $request->get('sort_by', 'id');
        $order = $request->get('order', 'asc');


        $allowedSortBy = ['title', 'created_at', 'id'];

        if (in_array($sortBy, $allowedSortBy)) {
            $query->orderBy($sortBy, $order);
        }


        $courses = $query->paginate(6);


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
