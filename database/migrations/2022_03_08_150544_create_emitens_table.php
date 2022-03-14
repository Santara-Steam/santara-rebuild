<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmitensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emitens', function (Blueprint $table) {
            $table->id();
            $table->string('nama_perusahaan')->nullable();
            $table->string('logo')->nullable();
            $table->string('cover_profile')->nullable();
            $table->string('galeri')->nullable();
            $table->string('owner')->nullable();
            $table->string('foto_owner')->nullable();
            $table->string('kategori')->nullable();
            $table->integer('omset1')->nullable();
            $table->integer('omset2')->nullable();
            $table->integer('dana')->nullable();
            $table->integer('sahamdilepas')->nullable();
            $table->integer('omset_penerbit')->nullable();
            $table->integer('deviden_tahunan')->nullable();
            $table->string('video_profile')->nullable();
            $table->string('web')->nullable();
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->longText('deskripsi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('emitens');
    }
}
