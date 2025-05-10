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
        Schema::create('catalogs', function (Blueprint $table) {
            $table->id();
             $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('_user')->onDelete('cascade');
            $table->string('nama_depan',30);
            $table->longText('preview');
            $table->longText('deskripsi');
            $table->integer('harga');
            $table->string('headline',50);
            $table->longText('file_desain');
            $table->string('status')->default('ready');
            $table->string('kategori_desain',20);
            $table->string('gelar',50);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('catalogs');
    }
};
