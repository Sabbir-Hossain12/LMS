<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{

    protected $guarded = [];
    public function questionGrades()
    {
        return $this->hasMany(QuestionGrade::class);
    }
    
    public function assessment()
    {
        return $this->belongsTo(Assessment::class);
    }
    
        public function attempts()
        {
        return $this->hasMany(QuizAttemptAnswer::class);
        }

    public function userAttempt($student_id, $assessment_id)
    {
        return $this->hasOne(QuizAttemptAnswer::class, 'question_id')
            ->where('student_id', $student_id)
            ->where('assessment_id', $assessment_id);
    }
}
