<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateMasterPagarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_pagar', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();
            $table->softdeletes();
        });

        $data = [
            [
                'nama'          => 'BRC',
                'keterangan'    => null,
                'created_at'    => now(),
            ],
            [
                'nama'          => 'Teralis',
                'keterangan'    => null,
                'created_at'    => now(),
            ],
            [
                'nama'          => 'Hollow',
                'keterangan'    => null,
                'created_at'    => now(),
            ],
        ];
        DB::table('master_pagar')->insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('master_pagar');
    }
}
