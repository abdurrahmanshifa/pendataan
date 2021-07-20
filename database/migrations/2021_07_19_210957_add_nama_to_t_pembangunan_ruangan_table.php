<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNamaToTPembangunanRuanganTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('t_pembangunan_ruangan', function (Blueprint $table) {
            //
            $table->string('nama')->nullable()->after('id_jenis_ruangan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('t_pembangunan_ruangan', function (Blueprint $table) {
            //
        });
    }
}
