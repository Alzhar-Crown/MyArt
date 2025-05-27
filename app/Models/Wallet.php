<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    //
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    protected $table = 'saldos';
    protected $fillable = ['user_id', 'saldo','spending'];
}
