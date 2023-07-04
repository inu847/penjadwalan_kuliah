<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbMatkulTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_matkul', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dosen_id');
            $table->string('kode_matkul');
            $table->text('nama_matkul');
            $table->integer('sks');
            $table->integer('semester');
            $table->text('jenis');
            $table->integer('kurikulum');
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
        Schema::dropIfExists('tb_matkul');
    }
}
