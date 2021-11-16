<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDaftarNilaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daftar_nilais', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('siswa_id');
            $table->foreign('siswa_id')->on('siswas')->references('id')->onDelete('cascade');
            $table->string('jenis_ujian');
            $table->string('periode');
            $table->string('semester')->nullable();
            $table->string('tahun_ajaran')->nullable();
            $table->unsignedBigInteger('guru_mata_pelajaran_id');
            $table->foreign('guru_mata_pelajaran_id')->on('guru_mata_pelajarans')->references('id')->onDelete('cascade');
            $table->float('nilai');
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
        Schema::dropIfExists('daftar_nilais');
    }
}
