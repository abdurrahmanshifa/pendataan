<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterStatusLahanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_status_lahan', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();
            $table->softdeletes();
        });

        $data = [
            [
                'nama'          => 'Tercatat di Aset',
                'keterangan'    => null,
                'created_at'    => now(),
            ],
            [
                'nama'          => 'Hibah',
                'keterangan'    => null,
                'created_at'    => now(),
            ],
            [
                'nama'          => 'BAST Perkim',
                'keterangan'    => null,
                'created_at'    => now(),
            ],
        ];
        DB::table('master_status_lahan')->insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('master_status_lahan');
    }
}
