<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminWallet extends Model
{
    //
    protected $table = 'admin_wallets';
    protected $fillable = ['kepemilikan', 'nominal'];
    protected $attributes = [
        'kepemilikan' => 'Developer',
    ];
}
