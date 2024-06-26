<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    
    
    public function comments()
    {
        return $this->hasMany(PostComment::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function likes()
    {
        return $this->belongsToMany(User::class,'post_likes');
    }
    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
    public function hasEditPermission($user)
    {
        return $this->user_id==$user->id || $user->role=='admin';
    }
}
