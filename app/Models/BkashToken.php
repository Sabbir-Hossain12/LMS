<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BkashToken extends Model
{
    protected $table ='bkash_tokens';
    
    protected $casts = [
        't_created_at' => 'datetime',
    ];
}
