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
        Route::post('pembangunan/ubah', 'App\Http\Controllers\PembangunanController@ubah')->name('pembangunan.ubah');
        Route::get('pembangunan/data/{id}', 'App\Http\Controllers\PembangunanController@data')->name('pembangunan.data');
        Route::delete('pembangunan/hapus/{id}', 'App\Http\Controllers\PembangunanController@hapus')->name('pembangunan.hapus');
    });

});
