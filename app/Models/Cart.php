<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    //
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function catalog()
    {
        return $this->belongsTo(Catalog::class, 'catalog_id');
    }
    protected $table = 'carts';
    protected $fillable = ['user_id','catalog_id','file_desain','harga', 'nama_depan','preview','headline'];

}
