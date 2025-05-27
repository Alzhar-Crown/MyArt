<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    //
     public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
     public function portofolio()
    {
        return $this->belongsTo(Portofolio::class, 'portofolio_id');
    }
}
