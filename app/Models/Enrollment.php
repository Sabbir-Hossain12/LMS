<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    
    
    protected $casts=[
        'enrolled_at' => 'datetime',
    ];
    public function student()
    {
        return $this->belongsTo(User::class,'user_id');
    }

//    public function ()
//    {
//        
//    }
    
    
}
