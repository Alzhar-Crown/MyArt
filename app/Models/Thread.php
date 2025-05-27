<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    //
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function members()
    {
        return $this->belongsToMany(User::class, 'thread_user')->withTimestamps();
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    protected $table = 'threads';
    protected $fillable = ['user_id', 'title','body'];
}
