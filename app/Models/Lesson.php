<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function lessonVideos()
    {
        return $this->hasMany(LessonVideo::class);
    }

    public function lessonMaterials()
    {
        return $this->hasMany(LessonMaterial::class);
    }
    
    public function assessments()
    {
        return $this->hasMany(Assessment::class);
    }
    
    
}
