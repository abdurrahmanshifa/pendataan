<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTRehabilitasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_rehabilitasi', function (Blueprint $table) {
            $table->string('id', 32)->primary();
            $table->string('id_survey',32);
            $table->string('tahun')->nullable();
            $table->string('sumber_anggaran')->nullable();
            $table->timestamps();
            $table->softdeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_rehabilitasi');
    }
}
