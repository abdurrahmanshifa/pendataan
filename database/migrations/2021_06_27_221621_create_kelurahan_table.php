<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateKelurahanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kelurahan', function (Blueprint $table) {
            $table->bigIncrements('id')->primary();
            $table->string('id_kec');
            $table->string('nama_kel');
            $table->timestamps();
            $table->softdeletes();
        });

        $data = [
            [
                'id'    => '3671010001',
                'id_kec'    => '3671010',
                'nama_kel'  => 'TAJUR',
                'created_at'    => now(),
            ],
            [
                'id'    => '3671010002',
                'id_kec'    => '3671010',
                'nama_kel'  => 'PARUNG SERAB',
                'created_at'    => now(),
            ],
            [
                'id'    => '3671010003',
                'id_kec'    => '3671010',
                'nama_kel'  => 'PANINGGILAN',
                'created_at'    => now(),
            ],
            [
                'id'    => '3671010012',
                'id_kec'    => '3671010',
                'nama_kel'  => 'PANINGGILAN UTARA',
                'created_at'    => now(),
            ],
            [
                'id'    => '3671010013',
                'id_kec'    => '3671010',
                'nama_kel'  => 'SUDIMARA SELATAN',
                'created_at'    => now(),
            ],
            [
                'id'    => '3671010014',
                'id_kec'    => '3671010',
                'nama_kel'  => 'SUDIMARA BARAT',
                'created_at'    => now(),
            ],
            [
                'id'    => '3671010015',
                'id_kec'    => '3671010',
                'nama_kel'  => 'SUDIMARA JAYA',
                'created_at'    => now(),
            ],
            [
                'id'    => '3671010016',
                'id_kec'    => '3671010',
                'nama_kel'  => 'SUDIMARA TIMUR',
                'created_at'    => now(),
            ],
            [
                'id'    => '3671011001',
                'id_kec'    => '3671011',
                'nama_kel'  => 'LARANGAN SELATAN',
                'created_at'    => now(),
            ],
            [
                'id'    => '3671011002',
                'id_kec'    => '3671011',
                'nama_kel'  => 'GAGA',
                'created_at'    => now(),
            ],
            [
                'id'    => '3671011003',
                'id_kec'    => '3671011',
                'nama_kel'  => 'CIPADU JAYA',
                'created_at'    => now(),
            ],
            [
                'id'    => '3671011004',
                'id_kec'    => '3671011',
                'nama_kel'  => 'KEREO SELATAN',
                'created_at'    => now(),
            ],
            [
                'id'    => '3671011005',
                'id_kec'    => '3671011',
                'nama_kel'  => 'CIPADU',
                'created_at'    => now(),
            ],
            [
                'id'    => '3671011006',
                'id_kec'    => '3671011',
                'nama_kel'  => 'KEREO',
                'created_at'    => now(),
            ],
            [
                'id'    => '3671011007',
                'id_kec'    => '3671011',
                'nama_kel'  => 'LARANGAN INDAH',
                'created_at'    => now(),
            ],
            [
                'id'    => '3671011008',
                'id_kec'    => '3671011',
                'nama_kel'  => 'LARANGAN UTARA',
                'created_at'    => now(),
            ],
            [
                'id'    => '3671012001',
                'id_kec'    => '3671012',
                'nama_kel'  => 'PEDURENAN',
                'created_at'    => now(),
            ],
            [
                'id'    => '3671012002',
                'id_kec'    => '3671012',
                'nama_kel'  => 'PONDOK PUCUNG',
                'created_at'    => now(),
            ],
            [
                'id'    => '3671012003',
                'id_kec'    => '3671012',
                'nama_kel'  => 'KARANG TENGAH',
                'created_at'    => now(),
            ],
            [
                'id'    => '3671012004',
                'id_kec'    => '3671012',
                'nama_kel'  => 'KARANG TIMUR',
                'created_at'    => now(),
            ],
            [
                'id'    => '3671012005',
                'id_kec'    => '3671012',
                'nama_kel'  => 'KARANG MULYA',
                'created_at'    => now(),
            ],
            [
                'id'    => '3671012006',
                'id_kec'    => '3671012',
                'nama_kel'  => 'PARUNG JAYA',
                'created_at'    => now(),
            ],
            [
                'id'    => '3671012007',
                'id_kec'    => '3671012',
                'nama_kel'  => 'PONDOK BAHAR',
                'created_at'    => now(),
            ],
            [
                'id'    => '3671020012',
                'id_kec'    => '3671020',
                'nama_kel'  => 'PORIS PLAWAD INDAH',
                'created_at'    => now(),
            ],
            [
                'id'    => '3671020013',
                'id_kec'    => '3671020',
                'nama_kel'  => 'CIPONDOH',
                'created_at'    => now(),
            ],
            [
                'id'    => '3671020014',
                'id_kec'    => '3671020',
                'nama_kel'  => 'KENANGA',
                'created_at'    => now(),
            ],
            [
                'id'    => '3671020015',
                'id_kec'    => '3671020',
                'nama_kel'  => 'GONDRONG',
                'created_at'    => now(),
            ],
            [
                'id'    => '3671020016',
                'id_kec'    => '3671020',
                'nama_kel'  => 'PETIR',
                'created_at'    => now(),
            ],
            [
                'id'    => '3671020017',
                'id_kec'    => '3671020',
                'nama_kel'  => 'KETAPANG',
                'created_at'    => now(),
            ],
            [
                'id'    => '3671020018',
                'id_kec'    => '3671020',
                'nama_kel'  => 'CIPONDOH INDAH',
                'created_at'    => now(),
            ],
            [
                'id'    => '3671020019',
                'id_kec'    => '3671020',
                'nama_kel'  => 'CIPONDOH MAKMUR',
                'created_at'    => now(),
            ],
            [
                'id'    => '3671020020',
                'id_kec'    => '3671020',
                'nama_kel'  => 'PORIS PLAWAD UTARA',
                'created_at'    => now(),
            ],
            [
                'id'    => '3671020021',
                'id_kec'    => '3671020',
                'nama_kel'  => 'PORIS PLAWAD',
                'created_at'    => now(),
            ],
            [
                'id'    => '3671021001',
                'id_kec'    => '3671021',
                'nama_kel'  => 'PANUNGGANGAN UTARA',
                'created_at'    => now(),
            ],
            [
                'id'    => '3671021002',
                'id_kec'    => '3671021',
                'nama_kel'  => 'PANUNGGANGAN',
                'created_at'    => now(),
            ],
            [
                'id'    => '3671021003',
                'id_kec'    => '3671021',
                'nama_kel'  => 'PANUNGGANGAN TIMUR',
                'created_at'    => now(),
            ],
            [
                'id'    => '3671021004',
                'id_kec'    => '3671021',
                'nama_kel'  => 'KUNCIRAN',
                'created_at'    => now(),
            ],
            [
                'id'    => '3671021005',
                'id_kec'    => '3671021',
                'nama_kel'  => 'KUNCIRAN INDAH',
                'created_at'    => now(),
            ],
            [
                'id'    => '3671021006',
                'id_kec'    => '3671021',
                'nama_kel'  => 'SUDIMARA PINANG',
                'created_at'    => now(),
            ],
            [
                'id'    => '3671021007',
                'id_kec'    => '3671021',
                'nama_kel'  => 'PINANG',
                'created_at'    => now(),
            ],
            [
                'id'    => '3671021008',
                'id_kec'    => '3671021',
                'nama_kel'  => 'NEROKTOG',
                'created_at'    => now(),
            ],
            [
                'id'    => '3671021009',
                'id_kec'    => '3671021',
                'nama_kel'  => 'KUNCIRAN JAYA',
                'created_at'    => now(),
            ],
            [
                'id'    => '3671021010',
                'id_kec'    => '3671021',
                'nama_kel'  => 'PAKOJAN',
                'created_at'    => now(),
            ],
            [
                'id'    => '3671021011',
                'id_kec'    => '3671021',
                'nama_kel'  => 'CIPETE',
                'created_at'    => now(),
            ],
            [
                'id'    => '3671030004',
                'id_kec'    => '3671030',
                'nama_kel'  => 'CIKOKOL',
                'created_at'    => now(),
            ],
            [
                'id'    => '3671030005',
                'id_kec'    => '3671030',
                'nama_kel'  => 'KELAPA INDAH',
                'created_at'    => now(),
            ],
            [
                'id'    => '3671030006',
                'id_kec'    => '3671030',
                'nama_kel'  => 'BABAKAN',
                'created_at'    => now(),
            ],
            [
                'id'    => '3671030014',
                'id_kec'    => '3671030',
                'nama_kel'  => 'SUKASARI',
                'created_at'    => now(),
            ],
            [
                'id'    => '3671030015',
                'id_kec'    => '3671030',
                'nama_kel'  => 'BUARAN INDAH',
                'created_at'    => now(),
            ],
            [
                'id'    => '3671030016',
                'id_kec'    => '3671030',
                'nama_kel'  => 'TANAH TINGGI',
                'created_at'    => now(),
            ],
            [
                'id'    => '3671030017',
                'id_kec'    => '3671030',
                'nama_kel'  => 'SUKAASIH',
                'created_at'    => now(),
            ],
            [
                'id'    => '3671030018',
                'id_kec'    => '3671030',
                'nama_kel'  => 'SUKARASA',
                'created_at'    => now(),
            ],
            [
                'id'    => '3671031001',
                'id_kec'    => '3671031',
                'nama_kel'  => 'KARAWACI BARU',
                'created_at'    => now(),
            ],
            [
                'id'    => '3671031002',
                'id_kec'    => '3671031',
                'nama_kel'  => 'NUSAJAYA',
                'created_at'    => now(),
            ],
            [
                'id'    => '3671031003',
                'id_kec'    => '3671031',
                'nama_kel'  => 'BOJONGJAYA',
                'created_at'    => now(),
            ],
            [
                'id'    => '3671031004',
                'id_kec'    => '3671031',
                'nama_kel'  => 'KARAWACI',
                'created_at'    => now(),
            ],
            [
                'id'    => '3671031005',
                'id_kec'    => '3671031',
                'nama_kel'  => 'CIMONE JAYA',
                'created_at'    => now(),
            ],
            [
                'id'    => '3671031006',
                'id_kec'    => '3671031',
                'nama_kel'  => 'CIMONE',
                'created_at'    => now(),
            ],
            [
                'id'    => '3671031007',
                'id_kec'    => '3671031',
                'nama_kel'  => 'BUGEL',
                'created_at'    => now(),
            ],
            [
                'id'    => '3671031008',
                'id_kec'    => '3671031',
                'nama_kel'  => 'MARGASARI',
                'created_at'    => now(),
            ],
            [
                'id'    => '3671031009',
                'id_kec'    => '3671031',
                'nama_kel'  => 'PABUARAN',
                'created_at'    => now(),
            ],
            [
                'id'    => '3671031010',
                'id_kec'    => '3671031',
                'nama_kel'  => 'SUKAJADI',
                'created_at'    => now(),
            ],
            [
                'id'    => '3671031011',
                'id_kec'    => '3671031',
                'nama_kel'  => 'GERENDENG',
                'created_at'    => now(),
            ],
            [
                'id'    => '3671031012',
                'id_kec'    => '3671031',
                'nama_kel'  => 'KOANGJAYA',
                'created_at'    => now(),
            ],
            [
                'id'    => '3671031013',
                'id_kec'    => '3671031',
                'nama_kel'  => 'PASARBARU',
                'created_at'    => now(),
            ],
            [
                'id'    => '3671031014',
                'id_kec'    => '3671031',
                'nama_kel'  => 'SUMUR PACING',
                'created_at'    => now(),
            ],
            [
                'id'    => '3671031015',
                'id_kec'    => '3671031',
                'nama_kel'  => 'PABUARAN TUMPENG',
                'created_at'    => now(),
            ],
            [
                'id'    => '3671031016',
                'id_kec'    => '3671031',
                'nama_kel'  => 'NAMBOJAYA',
                'created_at'    => now(),
            ],
            [
                'id'    => '3671040001',
                'id_kec'    => '3671040',
                'nama_kel'  => 'MANIS JAYA',
                'created_at'    => now(),
            ],
            [
                'id'    => '3671040002',
                'id_kec'    => '3671040',
                'nama_kel'  => 'JATAKE',
                'created_at'    => now(),
            ],
            [
                'id'    => '3671040003',
                'id_kec'    => '3671040',
                'nama_kel'  => 'GANDASARI',
                'created_at'    => now(),
            ],
            [
                'id'    => '3671040010',
                'id_kec'    => '3671040',
                'nama_kel'  => 'KRONCONG',
                'created_at'    => now(),
            ],
            [
                'id'    => '3671040011',
                'id_kec'    => '3671040',
                'nama_kel'  => 'ALAM JAYA',
                'created_at'    => now(),
            ],
            [
                'id'    => '3671040012',
                'id_kec'    => '3671040',
                'nama_kel'  => 'PASIR JAYA',
                'created_at'    => now(),
            ],
            [
                'id'    => '3671041001',
                'id_kec'    => '3671041',
                'nama_kel'  => 'PANUNGGANGAN BARAT',
                'created_at'    => now(),
            ],
            [
                'id'    => '3671041002',
                'id_kec'    => '3671041',
                'nama_kel'  => 'CIBODASARI',
                'created_at'    => now(),
            ],
            [
                'id'    => '3671041003',
                'id_kec'    => '3671041',
                'nama_kel'  => 'CIBODAS BARU',
                'created_at'    => now(),
            ],
            [
                'id'    => '3671041004',
                'id_kec'    => '3671041',
                'nama_kel'  => 'CIBODAS',
                'created_at'    => now(),
            ],
            [
                'id'    => '3671041005',
                'id_kec'    => '3671041',
                'nama_kel'  => 'UWUNG JAYA',
                'created_at'    => now(),
            ],
            [
                'id'    => '3671041006',
                'id_kec'    => '3671041',
                'nama_kel'  => 'JATIUWUNG',
                'created_at'    => now(),
            ],
            [
                'id'    => '3671042001',
                'id_kec'    => '3671042',
                'nama_kel'  => 'GEMBOR',
                'created_at'    => now(),
            ],
            [
                'id'    => '3671042002',
                'id_kec'    => '3671042',
                'nama_kel'  => 'GEBANG RAYA',
                'created_at'    => now(),
            ],
            [
                'id'    => '3671042003',
                'id_kec'    => '3671042',
                'nama_kel'  => 'SANGIANG JAYA',
                'created_at'    => now(),
            ],
            [
                'id'    => '3671042004',
                'id_kec'    => '3671042',
                'nama_kel'  => 'PERIUK',
                'created_at'    => now(),
            ],
            [
                'id'    => '3671042005',
                'id_kec'    => '3671042',
                'nama_kel'  => 'PERIUK JAYA',
                'created_at'    => now(),
            ],
            [
                'id'    => '3671050001',
                'id_kec'    => '3671050',
                'nama_kel'  => 'PORISGAGA BARU',
                'created_at'    => now(),
            ],
            [
                'id'    => '3671050002',
                'id_kec'    => '3671050',
                'nama_kel'  => 'PORIS JAYA',
                'created_at'    => now(),
            ],
            [
                'id'    => '3671050003',
                'id_kec'    => '3671050',
                'nama_kel'  => 'PORISGAGA',
                'created_at'    => now(),
            ],
            [
                'id'    => '3671050004',
                'id_kec'    => '3671050',
                'nama_kel'  => 'KEBON BESAR',
                'created_at'    => now(),
            ],
            [
                'id'    => '3671050005',
                'id_kec'    => '3671050',
                'nama_kel'  => 'BATUCEPER',
                'created_at'    => now(),
            ],
            [
                'id'    => '3671050006',
                'id_kec'    => '3671050',
                'nama_kel'  => 'BATUJAYA',
                'created_at'    => now(),
            ],
            [
                'id'    => '3671050007',
                'id_kec'    => '3671050',
                'nama_kel'  => 'BATUSARI',
                'created_at'    => now(),
            ],
            [
                'id'    => '3671051001',
                'id_kec'    => '3671051',
                'nama_kel'  => 'KARANG ANYAR',
                'created_at'    => now(),
            ],
            [
                'id'    => '3671051002',
                'id_kec'    => '3671051',
                'nama_kel'  => 'KARANG SARI',
                'created_at'    => now(),
            ],
            [
                'id'    => '3671051003',
                'id_kec'    => '3671051',
                'nama_kel'  => 'NEGLASARI',
                'created_at'    => now(),
            ],
            [
                'id'    => '3671051004',
                'id_kec'    => '3671051',
                'nama_kel'  => 'MEKARSARI',
                'created_at'    => now(),
            ],
            [
                'id'    => '3671051005',
                'id_kec'    => '3671051',
                'nama_kel'  => 'KEDAUNG BARU',
                'created_at'    => now(),
            ],
            [
                'id'    => '3671051006',
                'id_kec'    => '3671051',
                'nama_kel'  => 'KEDAUNG WETAN',
                'created_at'    => now(),
            ],
            [
                'id'    => '3671051007',
                'id_kec'    => '3671051',
                'nama_kel'  => 'SELAPAJANG JAYA',
                'created_at'    => now(),
            ],
            [
                'id'    => '3671060001',
                'id_kec'    => '3671060',
                'nama_kel'  => 'BELENDUNG',
                'created_at'    => now(),
            ],
            [
                'id'    => '3671060002',
                'id_kec'    => '3671060',
                'nama_kel'  => 'JURUMUDI BARU',
                'created_at'    => now(),
            ],
            [
                'id'    => '3671060003',
                'id_kec'    => '3671060',
                'nama_kel'  => 'JURUMUDI',
                'created_at'    => now(),
            ],
            [
                'id'    => '3671060004',
                'id_kec'    => '3671060',
                'nama_kel'  => 'PAJANG',
                'created_at'    => now(),
            ],
            [
                'id'    => '3671060005',
                'id_kec'    => '3671060',
                'nama_kel'  => 'BENDA',
                'created_at'    => now(),
            ],
        ];
        
        DB::table('kelurahan')->insert($data);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kelurahan');
    }
}
