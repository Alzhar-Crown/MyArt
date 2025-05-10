<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Catalog extends Model
{
    //
     public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }
    protected $table = 'Catalogs';
    protected $fillable = ['user_id', 'nama_depan','preview','deskripsi','headline','kategori_desain','gelar','status','file design','harga'];

}
