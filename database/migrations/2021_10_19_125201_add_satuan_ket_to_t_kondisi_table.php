<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSatuanKetToTKondisiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('t_kondisi', function (Blueprint $table) {
            $table->string('satuan')->nullable()->after('luas');
            $table->text('keterangan')->nullable()->after('satuan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('t_kondisi', function (Blueprint $table) {
            //
        });
    }
}
