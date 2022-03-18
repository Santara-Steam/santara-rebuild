<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookSahamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_sahams', function (Blueprint $table) {
            $table->id();
            $table->integer('trader_id');
            $table->integer('emiten_id');
            $table->integer('lembar_saham');
            $table->integer('total_amount');
            $table->string('bukti_tranfer');
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
        Schema::dropIfExists('book_sahams');
    }
}
