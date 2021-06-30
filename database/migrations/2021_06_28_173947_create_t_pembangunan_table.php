<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTPembangunanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_pembangunan', function (Blueprint $table) {
            $table->string('id', 32)->primary();
            $table->string('id_survey',32);
            $table->string('tahun')->nullable();
            $table->double('luas')->nullable();
            $table->integer('jml_lantai')->nullable();
            $table->integer('id_halaman')->nullable();
            $table->double('luas_halaman')->nullable();
            $table->integer('id_pagar')->nullable();
            $table->double('panjang_pagar')->nullable();
            $table->integer('id_saluran')->nullable();
            $table->double('panjang_saluran')->nullable();
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
        Schema::dropIfExists('t_pembangunan');
    }
}
