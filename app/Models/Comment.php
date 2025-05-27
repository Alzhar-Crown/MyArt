<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function thread()
    {
        return $this->belongsTo(Thread::class);
    }

    // protected $table = 'comments';
    protected $fillable = ['body', 'user_id','thread_id'];

    //
}
