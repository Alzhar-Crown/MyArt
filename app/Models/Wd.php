<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wd extends Model
{
    //
      public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    
    protected $table = 'wd';
    protected $fillable = ['user_id', 'nominal','pajak'];
}
