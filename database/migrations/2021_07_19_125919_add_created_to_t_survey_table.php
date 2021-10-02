<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCreatedToTSurveyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('t_survey', function (Blueprint $table) {
            $table->string('id_created')->nullable()->after('foto');
            $table->string('id_updated')->nullable()->after('id_created');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('t_survey', function (Blueprint $table) {
            //
        });
    }
}
