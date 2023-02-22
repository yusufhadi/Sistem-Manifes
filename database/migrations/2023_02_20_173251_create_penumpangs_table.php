<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenumpangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penumpangs', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('noHp');
            $table->integer('usia');
            $table->string('jk');
            $table->string('golongan');
            $table->string('harga');
            $table->dateTime('tgl_keberangkatan');
            $table->string('asal');
            $table->string('tujuan');
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
        Schema::dropIfExists('penumpangs');
    }
}
