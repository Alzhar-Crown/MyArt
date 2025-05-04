<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profil extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    protected $table = 'profils';
    protected $fillable = ['user_id','nama_depan', 'nama_belakang', 'foto_profil', 'foto_profil', 'headline', 'deskripsi'];
    //
}
