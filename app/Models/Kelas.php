<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    //p
    protected $table ='kelas';
    protected $fillable =['nama_kelas','jumlah_siswa'];
}
