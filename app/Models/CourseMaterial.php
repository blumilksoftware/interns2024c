<?php

namespace Interns2024c\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseMaterial extends Model
{
    use HasFactory;

    protected $table = 'course_materials';

    protected $fillable = [
        'title',
        'type',
        'file_path',
        'lesson_id',
        'description'
    ];

    public function lesson()
    {
        return $this->belongsTo(\Interns2024c\Models\Lesson::class);
    }
}

