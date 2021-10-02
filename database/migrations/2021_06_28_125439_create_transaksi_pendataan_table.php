<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksiPendataanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_survey', function (Blueprint $table) {
            $table->string('id', 32)->primary();
            $table->string('klasifikasi')->nullable();
            $table->string('nama_objek')->nullable();
            $table->string('provinsi')->default('Banten')->nullable();
            $table->string('kota')->default('Kota Tangerang')->nullable();
            $table->string('id_kec')->nullable();
            $table->string('id_kel')->nullable();
            $table->text('alamat')->nullable();
            $table->string('lat')->nullable();
            $table->string('long')->nullable();
            $table->integer('id_status_lahan')->nullable();
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
        Schema::dropIfExists('t_survey');
    }
}
