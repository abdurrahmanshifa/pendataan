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
        Route::post('kecamatan/simpan', 'App\Http\Controllers\Master\KecamatanController@simpan')->name('kecamatan.simpan');
        Route::post('kecamatan/ubah', 'App\Http\Controllers\Master\KecamatanController@ubah')->name('kecamatan.ubah');
        Route::get('kecamatan/data/{id}', 'App\Http\Controllers\Master\KecamatanController@data')->name('kecamatan.data');
        Route::delete('kecamatan/hapus/{id}', 'App\Http\Controllers\Master\KecamatanController@hapus')->name('kecamatan.hapus');

        Route::get('/kelurahan', 'App\Http\Controllers\Master\KelurahanController@index')->name('kelurahan');
        Route::post('kelurahan/simpan', 'App\Http\Controllers\Master\KelurahanController@simpan')->name('kelurahan.simpan');
        Route::post('kelurahan/ubah', 'App\Http\Controllers\Master\KelurahanController@ubah')->name('kelurahan.ubah');
        Route::get('kelurahan/data/{id}', 'App\Http\Controllers\Master\KelurahanController@data')->name('kelurahan.data');
        Route::delete('kelurahan/hapus/{id}', 'App\Http\Controllers\Master\KelurahanController@hapus')->name('kelurahan.hapus');

        Route::get('/ruangan', 'App\Http\Controllers\Master\RuanganController@index')->name('ruangan');
        Route::post('ruangan/simpan', 'App\Http\Controllers\Master\RuanganController@simpan')->name('ruangan.simpan');
        Route::post('ruangan/ubah', 'App\Http\Controllers\Master\RuanganController@ubah')->name('ruangan.ubah');
        Route::get('ruangan/data/{id}', 'App\Http\Controllers\Master\RuanganController@data')->name('ruangan.data');
        Route::delete('ruangan/hapus/{id}', 'App\Http\Controllers\Master\RuanganController@hapus')->name('ruangan.hapus');
    });

    Route::get('/pengguna', 'App\Http\Controllers\PenggunaController@index')->name('pengguna');
    Route::post('pengguna/simpan', 'App\Http\Controllers\PenggunaController@simpan')->name('pengguna.simpan');
    Route::post('pengguna/ubah', 'App\Http\Controllers\PenggunaController@ubah')->name('pengguna.ubah');
    Route::get('pengguna/data/{id}', 'App\Http\Controllers\PenggunaController@data')->name('pengguna.data');
    Route::delete('pengguna/hapus/{id}', 'App\Http\Controllers\PenggunaController@hapus')->name('pengguna.hapus');

});
