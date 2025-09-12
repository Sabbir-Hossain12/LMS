<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssessmentGrade extends Model
{
    protected $casts=[
        'submitted_at' => 'datetime',
    ];

    public function student()
    {
        return $this->belongsTo(User::class,'student_id');
    }

    public function assessment()
    {
        return $this->belongsTo(Assessment::class);
    }


    public function assessmentAnswer()
    {
        return $this->belongsTo(AssessmentAnswer::class,'assessment_answer_id');
    }
}
