<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTRehabilitasiDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_rehabilitasi_detail', function (Blueprint $table) {
            $table->string('id', 32)->primary();
            $table->string('id_survey',32);
            $table->string('id_rehabilitasi',32);
            $table->string('nama')->nullable();
            $table->string('luas')->nullable();
            $table->string('foto')->nullable();
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
        Schema::dropIfExists('t_rehabilitasi_detail');
    }
}
