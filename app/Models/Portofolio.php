<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Portofolio extends Model
{
    //
    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }
    protected $table = 'portofolios';
    protected $fillable = ['user_id', 'nama_depan','preview','deskripsi','headline','jumlah_like','jumlah_simpan','kategori_desain','peringkat'];
}
