<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostViewTrack extends Model
{
    use HasFactory;
    
    public function setCreatedAtAttribute($value) { 
        $this->attributes['viewed_at'] = \Carbon\Carbon::now(); 
    }
}
