<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateMasterSaluranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_saluran', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();
            $table->softdeletes();
        });

        $data = [
            [
                'nama'          => 'Buis Beton',
                'keterangan'    => null,
                'created_at'    => now(),
            ],
            [
                'nama'          => 'U Ditch',
                'keterangan'    => null,
                'created_at'    => now(),
            ],
        ];
        DB::table('master_saluran')->insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('master_saluran');
    }
}
