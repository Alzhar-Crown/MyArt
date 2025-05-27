<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
      protected $table = 'orders';
    protected $fillable = ['user_id', 'via_transaksi','harga','checkout_link','external_id','status'];

}
