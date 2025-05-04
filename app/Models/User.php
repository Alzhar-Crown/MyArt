<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    public function profil()
    {
        return $this->hasOne(Profil::class);
    }
    protected $table = '_user';
    protected $fillable = ['username', 'password'];
    //
}
