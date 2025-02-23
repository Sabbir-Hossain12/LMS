<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LessonVideo extends Model
{
    //

     protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];
    

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }
}
