<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUrutanToTRehabilitasiDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('t_rehabilitasi_detail', function (Blueprint $table) {
            //
            $table->string('urutan')->nullable()->after('id_survey');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('t_rehabilitasi_detail', function (Blueprint $table) {
            //
        });
    }
}
