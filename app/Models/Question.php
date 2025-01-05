<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{

    public function questionGrades()
    {
        return $this->hasMany(QuestionGrade::class);
    }
}
