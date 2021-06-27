<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateKecamatanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kecamatan', function (Blueprint $table) {
            $table->bigIncrements('id')->primary();
            $table->string('id_kabkota');
            $table->string('nama_kec');
            $table->timestamps();
            $table->softdeletes();
        });
        $data = [
            [
                'id'            => '3671010',
                'id_kabkota'    => '3671',
                'nama_kec'      => 'CILEDUG',
                'created_at'    => now(),
            ],
            [
                'id'            => '3671011',
                'id_kabkota'    => '3671',
                'nama_kec'      => 'LARANGAN',
                'created_at'    => now(),
            ],
            [
                'id'            => '3671012',
                'id_kabkota'    => '3671',
                'nama_kec'      => 'KARANG TENGAH',
                'created_at'    => now(),
            ],
            [
                'id'            => '3671020',
                'id_kabkota'    => '3671',
                'nama_kec'      => 'CIPONDOH',
                'created_at'    => now(),
            ],
            [
                'id'            => '3671021',
                'id_kabkota'    => '3671',
                'name_kec'      => 'PINANG',
                'created_at'    => now(),
            ],
            [
                'id'            => '3671030',
                'id_kabkota'    => '3671',
                'name_kec'      => 'TANGERANG',
                'created_at'    => now(),
            ],
            [
                'id'            => '3671031',
                'id_kabkota'    => '3671',
                'name_kec'      => 'KARAWACI',
                'created_at'    => now(),
            ],
            [
                'id'            => '3671040',
                'id_kabkota'    => '3671',
                'name_kec'      => 'JATI UWUNG',
                'created_at'    => now(),
            ],
            [
                'id'            => '3671041',
                'id_kabkota'    => '3671',
                'name_kec'      => 'CIBODAS',
                'created_at'    => now(),
            ],
            [
                'id'            => '3671042',
                'id_kabkota'    => '3671',
                'name_kec'      => 'PRIUK',
                'created_at'    => now(),
            ],
            [
                'id'            => '3671050',
                'id_kabkota'    => '3671',
                'name_kec'      => 'BATUCEPER',
                'created_at'    => now(),
            ],
            [
                'id'            => '3671051',
                'id_kabkota'    => '3671',
                'name_kec'      => 'NEGLASARI',
                'created_at'    => now(),
            ],
            [
                'id'            => '3671060',
                'id_kabkota'    => '3671',
                'name_kec'      => 'BENDA',
                'created_at'    => now(),
            ]
        ];

        DB::table('kecamatan')->insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kecamatan');
    }
}
