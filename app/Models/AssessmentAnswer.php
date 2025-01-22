<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssessmentAnswer extends Model
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

    public function assessmentGrade()
    {
        return $this->hasOne(AssessmentGrade::class,'assessment_answer_id');
    }
}
