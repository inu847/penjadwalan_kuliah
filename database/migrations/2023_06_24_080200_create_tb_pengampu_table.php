<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbPengampuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_pengampu', function (Blueprint $table) {
            $table->id();
            $table->integer('kode_pengampu');
            $table->text('nama_matkul');
            $table->text('nama_dosen');
            $table->string('kelas');
            $table->integer('tahun_akademik');
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
        Schema::dropIfExists('tb_pengampu');
    }
}
