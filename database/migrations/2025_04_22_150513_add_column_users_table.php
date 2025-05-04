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
        Schema::table('profils', function ( $table) {
            $table->integer('user_id');
            $table->string('nama_depan');
            $table->string('nama_belakang');
            $table->longText('foto_profil');
            $table->string('headline');
            $table->string('deskripsi');


            //
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('profils', function ( $table) {
            //
           $table->dropColumn('user_id');
            $table->dropColumn('nama_depan');
            $table->dropColumn('nama_belakang');
            $table->dropColumn('foto_profil');
            $table->dropColumn('headline');
            $table->dropColumn('deskripsi');

        });
    }
};
