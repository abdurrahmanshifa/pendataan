<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes([
    'register'  => false,
    'reset'     => false,
    'verify'    => false,
]);


Route::get('/', function () {
    return redirect('login');
});

Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

    Route::group(['prefix'=>'master'], function () {
        Route::get('/kecamatan', 'App\Http\Controllers\Master\KecamatanController@index')->name('kecamatan');

        Route::get('/kelurahan', 'App\Http\Controllers\Master\KelurahanController@index')->name('kelurahan');
        Route::get('/kelurahan/id-by-kec/{id}', 'App\Http\Controllers\Master\KelurahanController@kel_by_kec')->name('kel-by-kec');
        Route::get('/kelurahan/id-by-kec/{id}/{id_kel}', 'App\Http\Controllers\Master\KelurahanController@kel_by_kec')->name('kel-by-kec');
        Route::get('/kelurahan/id-by-kec', 'App\Http\Controllers\Master\KelurahanController@kel_by_kec')->name('kel-by-kec');

        Route::get('/ruangan', 'App\Http\Controllers\Master\RuanganController@index')->name('ruangan');
        Route::post('ruangan/simpan', 'App\Http\Controllers\Master\RuanganController@simpan')->name('ruangan.simpan');
        Route::post('ruangan/ubah', 'App\Http\Controllers\Master\RuanganController@ubah')->name('ruangan.ubah');
        Route::get('ruangan/data/{id}', 'App\Http\Controllers\Master\RuanganController@data')->name('ruangan.data');
        Route::delete('ruangan/hapus/{id}', 'App\Http\Controllers\Master\RuanganController@hapus')->name('ruangan.hapus');

        Route::get('/halaman', 'App\Http\Controllers\Master\HalamanController@index')->name('halaman');
        Route::post('halaman/simpan', 'App\Http\Controllers\Master\HalamanController@simpan')->name('halaman.simpan');
        Route::post('halaman/ubah', 'App\Http\Controllers\Master\HalamanController@ubah')->name('halaman.ubah');
        Route::get('halaman/data/{id}', 'App\Http\Controllers\Master\HalamanController@data')->name('halaman.data');
        Route::delete('halaman/hapus/{id}', 'App\Http\Controllers\Master\HalamanController@hapus')->name('halaman.hapus');
        
    });

    Route::get('/pengguna', 'App\Http\Controllers\PenggunaController@index')->name('pengguna');
    Route::post('pengguna/simpan', 'App\Http\Controllers\PenggunaController@simpan')->name('pengguna.simpan');
    Route::post('pengguna/ubah', 'App\Http\Controllers\PenggunaController@ubah')->name('pengguna.ubah');
    Route::get('pengguna/data/{id}', 'App\Http\Controllers\PenggunaController@data')->name('pengguna.data');
    Route::delete('pengguna/hapus/{id}', 'App\Http\Controllers\PenggunaController@hapus')->name('pengguna.hapus');

    Route::get('/survey', 'App\Http\Controllers\SurveyController@index')->name('survey');
    Route::post('survey/simpan', 'App\Http\Controllers\SurveyController@simpan')->name('survey.simpan');
    Route::post('survey/ubah', 'App\Http\Controllers\SurveyController@ubah')->name('survey.ubah');
    Route::get('survey/data/{id}', 'App\Http\Controllers\SurveyController@data')->name('survey.data');
    Route::delete('survey/hapus/{id}', 'App\Http\Controllers\SurveyController@hapus')->name('survey.hapus');
    Route::get('survey/detail/{id}', 'App\Http\Controllers\SurveyController@detail')->name('survey.data');

    Route::group(['prefix'=>'survey'], function () {
        Route::get('/pembangunan/{id}', 'App\Http\Controllers\PembangunanController@index')->name('pembangunan');
        Route::post('pembangunan/simpan', 'App\Http\Controllers\PembangunanController@simpan')->name('pembangunan.simpan');

        Route::post('pembangunan/ruangan-simpan', 'App\Http\Controllers\PembangunanController@ruangan_simpan')->name('pembangunan-ruangan.simpan');
        Route::post('pembangunan/ruangan-ubah', 'App\Http\Controllers\PembangunanController@ruangan_ubah')->name('pembangunan-ruangan.ubah');
        Route::get('pembangunan/ruangan-data/{id}', 'App\Http\Controllers\PembangunanController@ruangan_data')->name('pembangunan-ruangan.data');
        Route::delete('pembangunan/ruangan-hapus/{id}', 'App\Http\Controllers\PembangunanController@ruangan_hapus')->name('pembangunan-ruangan.hapus');

        Route::get('/rehabilitasi/{id}', 'App\Http\Controllers\RehabilitasiController@index')->name('rehabilitasi');
        Route::post('rehabilitasi/simpan', 'App\Http\Controllers\RehabilitasiController@simpan')->name('rehabilitasi.simpan');
        Route::post('rehabilitasi/ubah', 'App\Http\Controllers\RehabilitasiController@ubah')->name('rehabilitasi.ubah');
        Route::get('rehabilitasi/data/{id}', 'App\Http\Controllers\RehabilitasiController@data')->name('rehabilitasi.data');
        Route::delete('rehabilitasi/hapus/{id}', 'App\Http\Controllers\RehabilitasiController@hapus')->name('rehabilitasi.hapus');

        Route::get('/rehabilitasi-detail/{id}', 'App\Http\Controllers\RehabilitasiController@rehabilitasi_detail')->name('rehabilitasi-detail');
        Route::post('rehabilitasi-detail/simpan', 'App\Http\Controllers\RehabilitasiController@simpan_detail')->name('rehabilitasi-detail.simpan');
        Route::post('rehabilitasi-detail/ubah', 'App\Http\Controllers\RehabilitasiController@ubah_detail')->name('rehabilitasi-detail.ubah');
        Route::get('rehabilitasi-detail/data/{id}', 'App\Http\Controllers\RehabilitasiController@data_detail')->name('rehabilitasi-detail.data');
        Route::delete('rehabilitasi-detail/hapus/{id}', 'App\Http\Controllers\RehabilitasiController@hapus_detail')->name('rehabilitasi-detail.hapus');

        Route::get('/spesifikasi/{id}', 'App\Http\Controllers\SpesifikasiController@index')->name('spesifikasi');
        Route::post('spesifikasi/simpan', 'App\Http\Controllers\SpesifikasiController@simpan')->name('spesifikasi.simpan');
        Route::post('spesifikasi/simpan-lain', 'App\Http\Controllers\SpesifikasiController@simpan_lain')->name('spesifikasi.simpan-lain');
        Route::post('spesifikasi/ubah', 'App\Http\Controllers\SpesifikasiController@ubah')->name('spesifikasi.ubah');
        Route::get('spesifikasi/data/{id}', 'App\Http\Controllers\SpesifikasiController@data')->name('spesifikasi.data');
        Route::delete('spesifikasi/hapus/{id}', 'App\Http\Controllers\SpesifikasiController@hapus')->name('spesifikasi.hapus');

        Route::get('/kondisi/{id}', 'App\Http\Controllers\KondisiController@index')->name('kondisi');
        Route::post('kondisi/simpan', 'App\Http\Controllers\KondisiController@simpan')->name('kondisi.simpan');
        Route::post('kondisi/simpan-lain', 'App\Http\Controllers\KondisiController@simpan_lain')->name('kondisi.simpan-lain');
        Route::post('kondisi/ubah', 'App\Http\Controllers\KondisiController@ubah')->name('kondisi.ubah');
        Route::get('kondisi/data/{id}', 'App\Http\Controllers\KondisiController@data')->name('kondisi.data');
        Route::delete('kondisi/hapus/{id}', 'App\Http\Controllers\KondisiController@hapus')->name('kondisi.hapus');
    });

});

Route::get('show-file/{dir}/{filename}', 'App\Http\Controllers\Controller@displayFiles');
Route::get('show-files/{dir}/{filename}', 'App\Http\Controllers\Controller@displayFile');
Route::get('show-image/{dir}/{filename}', 'App\Http\Controllers\Controller@showImage');
