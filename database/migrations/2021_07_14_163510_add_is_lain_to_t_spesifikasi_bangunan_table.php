<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsLainToTSpesifikasiBangunanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('t_spesifikasi_bangunan', function (Blueprint $table) {
            //
            $table->integer('is_lain')->default(0)->nullable()->after('foto');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('t_spesifikasi_bangunan', function (Blueprint $table) {
            //
        });
    }
}
