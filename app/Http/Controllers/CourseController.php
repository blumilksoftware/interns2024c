<?php

namespace Interns2024c\Http\Controllers;

use Interns2024c\Models\Course;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::with('teacher')->paginate(10);
        return Inertia::render('Courses/Index', ['courses' => $courses]);
    }

    public function create()
    {
        return Inertia::render('Courses/Create');
    }

    public function show($id)
    {

        $course = Course::findOrFail($id);


        return Inertia::render('Courses/Show', [
            'course' => $course,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'language' => 'required|string',
            'skill_level' => 'required|string',
        ]);

        $request->user()->courses()->create($validated);
        return redirect()->route('courses.index')->with('success', 'Course created successfully.');
    }

    public function edit(Course $course)
    {
        return Inertia::render('Courses/Edit', ['course' => $course]);
    }

    public function update(Request $request, Course $course)
    {
        $this->authorize('update', $course);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'language' => 'required|string',
            'skill_level' => 'required|string',
        ]);

        $course->update($validated);
        return redirect()->route('courses.index')->with('success', 'Course updated successfully.');
    }

    public function destroy(Course $course)
    {
        $this->authorize('delete', $course);

        $course->delete();
        return redirect()->route('courses.index')->with('success', 'Course deleted successfully.');
    }
}


