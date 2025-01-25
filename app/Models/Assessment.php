<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assessment extends Model
{

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }


    public function assessmentAnswers()
    {
        return $this->hasMany(AssessmentAnswer::class,'assessment_id');
    }


}
