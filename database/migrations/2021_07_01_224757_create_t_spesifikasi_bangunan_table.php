<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTSpesifikasiBangunanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_spesifikasi_bangunan', function (Blueprint $table) {
            $table->string('id', 32)->primary();
            $table->string('id_survey',32);
            $table->string('nama')->nullable();
            $table->string('jenis')->nullable();
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
        Schema::dropIfExists('t_spesifikasi_bangunan');
    }
}
