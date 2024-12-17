<?php

namespace Interns2024c\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Course extends Model
{  use HasFactory;

    protected $fillable = ['title', 'description', 'language', 'skill_level', 'user_id'];

    public function teacher()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
