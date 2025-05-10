<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('portofolios', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('_user')->onDelete('cascade');
            $table->string('nama_depan',30);
            $table->longText('preview');
            $table->longText('deskripsi', );
            $table->string('headline',50);
            $table->integer('jumlah_like')->default(0);
            $table->integer('jumlah_simpan')->default(0);
            $table->string('kategori_desain',40);
            $table->string('peringkat',50);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('portofolios');
    }
};
