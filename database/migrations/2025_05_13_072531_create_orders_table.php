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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('catalog_id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('_user');
            $table->foreign('catalog_id')->references('id')->on('catalogs');
            $table->string('via_transaksi',30);
            $table->integer('harga');
            $table->string('headline',50);
            $table->string('kategori_desain',20);
            $table->string('checkout_link');
            $table->string('external_id');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
