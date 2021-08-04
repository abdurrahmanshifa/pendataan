<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateMasterRangkaAtapTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_rangka_atap', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();
            $table->softdeletes();
        });

        $data = [
            [
                'nama'          => 'Baja',
                'keterangan'    => null,
                'created_at'    => now(),
            ],
            [
                'nama'          => 'Baja Ringan',
                'keterangan'    => null,
                'created_at'    => now(),
            ],
            [
                'nama'          => 'Kayu',
                'keterangan'    => null,
                'created_at'    => now(),
            ],
        ];
        DB::table('master_rangka_atap')->insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('master_rangka_atap');
    }
}
