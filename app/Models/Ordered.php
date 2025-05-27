<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ordered extends Model
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
    protected $table = 'ordereds';
    protected $fillable = ['user_id','catalog_id','kategori_desain','file_desain','harga', 'nama_depan','preview','headline'];

}

