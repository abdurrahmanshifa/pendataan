<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateMasterLantaiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_lantai', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();
            $table->softdeletes();
        });

        $data = [
            [
                'nama'          => 'Keramik',
                'keterangan'    => null,
                'created_at'    => now(),
            ],
            [
                'nama'          => 'Granit',
                'keterangan'    => null,
                'created_at'    => now(),
            ],
        ];
        DB::table('master_lantai')->insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('master_lantai');
    }
}
