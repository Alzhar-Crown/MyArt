<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;



class User extends Authenticatable
{
    use Notifiable;

    public function profil()
    {
        return $this->hasOne(Profil::class);
    }
    public function portofolio()
    {
        return $this->hasMany(Portofolio::class, 'user_id');
    }
    public function Catalog()
    {
        return $this->hasMany(Portofolio::class, 'user_id');
    }
    protected $table = '_user';
    protected $fillable = ['username', 'password'];
    //
}
