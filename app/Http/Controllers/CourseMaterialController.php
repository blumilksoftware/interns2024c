<?php

namespace Interns2024c\Http\Controllers;

use Illuminate\Http\Request;

class CourseMaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $materials = \Interns2024c\Models\CourseMaterial::with('lesson')->get();

        $englishLevels = ['English A1', 'English A2', 'English B1', 'English B2', 'English C1', 'English C2', 'No Lesson'];

        $groupedMaterials = $materials->groupBy(function ($material) {
            return $material->lesson->title ?? 'No Lesson';
        });

        $sortedMaterials = $groupedMaterials->sortBy(function ($group, $lessonTitle) use ($englishLevels) {
            $index = array_search($lessonTitle, $englishLevels);
            return $index !== false ? $index : PHP_INT_MAX;
        });

        $transformedMaterials = $sortedMaterials->map(function ($group, $lessonTitle) {
            return [
                'lesson_title' => $lessonTitle,
                'materials' => $group->map(function ($material) {
                    return [
                        'id' => $material->id,
                        'title' => $material->title,
                        'description' => $material->description,
                        'file_path' => $material->file_path,
                        'type' => $material->type,
                    ];
                })->values(),
            ];
        })->values();

        return inertia('CourseMaterials/Index', [
            'materials' => $transformedMaterials,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $lessons = \Interns2024c\Models\Lesson::all();

        return inertia('CourseMaterials/Create', [
            'lessons' => $lessons,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|string|in:text,file,video',
            'description' => 'nullable|string',
            'lesson_id' => 'required|exists:lessons,id',
            'file' => 'nullable|file|mimes:jpg,png,pdf,mp4|max:20480',
        ]);

        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('uploads', 'public');
            $validated['file_path'] = $filePath;
        }

        \Interns2024c\Models\CourseMaterial::create($validated);

        return redirect()->route('course-materials.index')->with('success', 'Course material created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $material = \Interns2024c\Models\CourseMaterial::findOrFail($id);

        return inertia('CourseMaterials/Show', [
            'material' => $material
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $material = \Interns2024c\Models\CourseMaterial::with('lesson')->findOrFail($id);
        $lessons = \Interns2024c\Models\Lesson::all();

        return inertia('CourseMaterials/Edit', [
            'material' => $material,
            'lessons' => $lessons,
            'csrfToken' => csrf_token(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|string|in:text,file,video',
            'description' => 'nullable|string',
            'lesson_id' => 'required|exists:lessons,id',
            'file' => 'nullable|file|mimes:jpg,png,pdf,mp4|max:20480',
        ]);

        $material = \Interns2024c\Models\CourseMaterial::findOrFail($id);

        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('uploads', 'public');
            $validated['file_path'] = $filePath;
        }

        $material->update($validated);

        return redirect()->route('course-materials.index')->with('success', 'Course material updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $material = \Interns2024c\Models\CourseMaterial::findOrFail($id);

        if ($material->file_path) {
            \Storage::disk('public')->delete($material->file_path);
        }

        $material->delete();

        return redirect()->route('course-materials.index')->with('success', 'Course material deleted successfully.');
    }
}
