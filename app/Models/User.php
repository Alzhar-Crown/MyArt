<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;



class User extends Authenticatable
{
    use Notifiable;
    protected $table = '_user';
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function threads()
    {
        return $this->hasMany(Thread::class);
    }
    public function ordered()
    {
        return $this->hasMany(Ordered::class, 'user_id');
    }

    public function profil()    
    {
        return $this->hasOne(Profil::class);
    }
    public function wallet()
    {
        return $this->hasOne(Wallet::class);
    }
    public function portofolio()
    {
        return $this->hasMany(Portofolio::class);
    }
    public function Catalog()
    {
        return $this->hasMany(Catalog::class, 'user_id');
    }
    protected $fillable = ['username', 'password'];
    //
}
