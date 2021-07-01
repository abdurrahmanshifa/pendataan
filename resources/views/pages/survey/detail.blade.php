@extends('layouts.template')

@section('title')
<title>SURVEY DETAIL {{ strtoupper($data->klasifikasi) }} | DINAS PERKIM KOTA TANGERANG </title>
<style>
</style>
@endsection

@section('content')
<section class="section">
     <div class="section-header">
          <h1>Detail Survey</h1>
          <div class="section-header-breadcrumb">
               <div class="breadcrumb-item active"><a href="#">Transaksi</a></div>
               <div class="breadcrumb-item"><a href="{{ route('survey') }}">Survey</a></div>
               <div class="breadcrumb-item">{{ ucwords($data->klasifikasi) }}</div>
          </div>
     </div>
     <h2 class="section-title">
          <a href="{{ route('survey') }}" title="Kembali" class="btn btn-icon btn-sm btn-warning rounded-circle icon-back">
               <i class="fas fa-arrow-circle-left"></i>
          </a> 
          Klasifikasi : {{ ucwords($data->klasifikasi) }}
     </h2>
     <p class="section-lead">Nama Objek : {{ ucwords($data->nama_objek) }}</p>
     <div class="section-body">
          <div class="row">
               <div class="col-12">
                    <div class="card">
                         <div class="card-header">
                              <h4>
                                   Survey Pembangunan
                              </h4>
                              <div class="card-header-action">
                                   @if($data->pembangunan != null)
                                        <a href="{{ route('pembangunan',['id' => $data->id]) }}" class="btn btn-icon btn-lg btn-success text-white" title="Ubah Data">
                                             <i class="fas fa-edit"></i> Ubah
                                        </a>
                                   @else
                                        <a href="{{ route('pembangunan',['id' => $data->id]) }}" class="btn btn-icon btn-lg btn-info" title="Tambah Data">
                                             <i class="fas fa-plus"></i> Tambah
                                        </a>
                                   @endif
                                   <a data-collapse="#mycard-collapse" class="btn btn-icon btn-lg btn-info" href="#"><i class="fas fa-minus"></i></a>
                              </div>
                         </div>
                         <div class="collapse show" id="mycard-collapse" style="">
                              <div class="card-body p-0">
                                   <div style="padding: 30px;">
                                        <div class="row">
                                             <div class="col-md-4">
                                                  <div class="form-group row mb-1">
                                                       <label class="col-form-label col-md-5 col-lg-5">
                                                            <strong> Tahun </strong>
                                                       </label>
                                                       <label class="col-form-label col-md-1 col-lg-1">
                                                            <strong> : </strong>
                                                       </label>
                                                       <label class="col-form-label col-md-6 col-lg-6">
                                                            {{ (isset($data->pembangunan->tahun) ?$data->pembangunan->tahun:'-') }}
                                                       </label>
                                                  </div>
                                                  <div class="form-group row mb-1">
                                                       <label class="col-form-label col-md-5 col-lg-5">
                                                            <strong> Luas </strong>
                                                       </label>
                                                       <label class="col-form-label col-md-1 col-lg-1">
                                                            <strong> : </strong>
                                                       </label>
                                                       <label class="col-form-label col-md-6 col-lg-6">
                                                       {{ (isset($data->pembangunan->luas) ?$data->pembangunan->luas:'-') }}
                                                       </label>
                                                  </div>
                                                  <div class="form-group row mb-1">
                                                       <label class="col-form-label col-md-5 col-lg-5">
                                                            <strong> Jumlah Lantai </strong>
                                                       </label>
                                                       <label class="col-form-label col-md-1 col-lg-1">
                                                            <strong> : </strong>
                                                       </label>
                                                       <label class="col-form-label col-md-6 col-lg-6">
                                                       {{ (isset($data->pembangunan->jml_lantai) ?$data->pembangunan->jml_lantai:'-') }}
                                                       </label>
                                                  </div>
                                             </div>
                                             <div class="col-md-4">
                                                  <div class="form-group row mb-1">
                                                       <label class="col-form-label col-md-5 col-lg-5">
                                                            <strong> Halaman </strong>
                                                       </label>
                                                       <label class="col-form-label col-md-1 col-lg-1">
                                                            <strong> : </strong>
                                                       </label>
                                                       <label class="col-form-label col-md-6 col-lg-6">
                                                       {{ (isset($data->pembangunan->halaman) ?$data->pembangunan->halaman->nama:'-') }}
                                                       </label>
                                                  </div>
                                                  <div class="form-group row mb-1">
                                                       <label class="col-form-label col-md-5 col-lg-5">
                                                            <strong> Pagar </strong>
                                                       </label>
                                                       <label class="col-form-label col-md-1 col-lg-1">
                                                            <strong> : </strong>
                                                       </label>
                                                       <label class="col-form-label col-md-6 col-lg-6">
                                                       {{ (isset($data->pembangunan->pagar) ?$data->pembangunan->pagar->nama:'-') }}
                                                       </label>
                                                  </div>
                                                  <div class="form-group row mb-1">
                                                       <label class="col-form-label col-md-5 col-lg-5">
                                                            <strong> Saluran </strong>
                                                       </label>
                                                       <label class="col-form-label col-md-1 col-lg-1">
                                                            <strong> : </strong>
                                                       </label>
                                                       <label class="col-form-label col-md-6 col-lg-6">
                                                       {{ (isset($data->pembangunan->saluran) ?$data->pembangunan->saluran->nama:'-') }}
                                                       </label>
                                                  </div>
                                             </div>
                                             <div class="col-md-4">
                                                  <div class="form-group row mb-1">
                                                       <label class="col-form-label col-md-5 col-lg-5">
                                                            <strong> Luas Halaman </strong>
                                                       </label>
                                                       <label class="col-form-label col-md-1 col-lg-1">
                                                            <strong> : </strong>
                                                       </label>
                                                       <label class="col-form-label col-md-6 col-lg-6">
                                                       {{ (isset($data->pembangunan->luas_halaman) ?$data->pembangunan->luas_halaman:'-') }} m <sup>2</sup>
                                                       </label>
                                                  </div>
                                                  <div class="form-group row mb-1">
                                                       <label class="col-form-label col-md-5 col-lg-5">
                                                            <strong> Panjang Pagar </strong>
                                                       </label>
                                                       <label class="col-form-label col-md-1 col-lg-1">
                                                            <strong> : </strong>
                                                       </label>
                                                       <label class="col-form-label col-md-6 col-lg-6">
                                                       {{ (isset($data->pembangunan->panjang_pagar) ?$data->pembangunan->panjang_pagar:'-') }} m <sup>2</sup>
                                                       </label>
                                                  </div>
                                                  <div class="form-group row mb-1">
                                                       <label class="col-form-label col-md-5 col-lg-5">
                                                            <strong> Panjang Saluran </strong>
                                                       </label>
                                                       <label class="col-form-label col-md-1 col-lg-1">
                                                            <strong> : </strong>
                                                       </label>
                                                       <label class="col-form-label col-md-6 col-lg-6">
                                                       {{ (isset($data->pembangunan->panjang_saluran) ?$data->pembangunan->panjang_saluran:'-') }} m <sup>2</sup>
                                                       </label>
                                                  </div>
                                             </div>
                                             <div class="col-md-12">
                                                  <div class="form-group row mb-1 mt-3">
                                                       <label class="col-form-label col-md-12">
                                                            <strong> Jenis Ruangan </strong>
                                                       </label>
                                                  </div>
                                                  <div class="table-responsive">
                                                       <table id="table-jenis-ruangan" class="table table-bordered table-hover">
                                                            <thead>
                                                                 <tr>
                                                                      <th style="text-align: center;" width="50px;">No</th>
                                                                      <th style="text-align: center;">Ruangan</th>
                                                                      <th style="text-align: center;" width="150px">Jumlah Ruangan</th>
                                                                      <th style="text-align: center;" width="150px">Luas</th>
                                                                      <th style="text-align: center;width:100px;">Media</th>
                                                                 </tr>
                                                            </thead>
                                                            <tbody>

                                                            </tbody>
                                                       </table>
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </div>
     <div class="section-body">
          <div class="row">
               <div class="col-12">
                    <div class="card">
                         <div class="card-header">
                              <h4>
                                   Rehabilitasi
                              </h4>
                              <div class="card-header-action">
                                   <button class="btn btn-icon btn-lg btn-dark tambah" type="button" title="Simpan Data">
                                        <i class="fas fa-plus"></i> Tambah
                                   </button>
                                   <a data-collapse="#rehabilitasi" class="btn btn-icon btn-lg btn-info" href="#"><i class="fas fa-minus"></i></a>
                              </div>
                         </div>
                         <div class="collapse show" id="rehabilitasi" style="">
                              <div class="card-body p-0">
                                   <div style="padding: 30px;">
                                        <div class="row">
                                             <div class="col-md-12">
                                                  <div class="table-responsive">
                                                       <table id="table-rehabilitasi" class="table table-bordered table-hover">
                                                            <thead>
                                                                 <tr>
                                                                      <th style="text-align: center;" width="50px;">No</th>
                                                                      <th style="text-align: center;">Nama</th>
                                                                      <th style="text-align: center;">Tahun</th>
                                                                      <th style="text-align: center;">Sumber Anggaran</th>
                                                                 </tr>
                                                            </thead>
                                                            <tbody>

                                                            </tbody>
                                                       </table>
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </div>
     <div class="section-body">
          <div class="row">
               <div class="col-12">
                    <div class="card">
                         <div class="card-header">
                              <h4>
                                   Spesifikasi Bangunan
                              </h4>
                              <div class="card-header-action">
                                   <button class="btn btn-icon btn-lg btn-dark tambah" type="button" title="Simpan Data">
                                        <i class="fas fa-plus"></i> Tambah
                                   </button>
                                   <a data-collapse="#spesifikasi" class="btn btn-icon btn-lg btn-info" href="#"><i class="fas fa-minus"></i></a>
                              </div>
                         </div>
                         <div class="collapse show" id="spesifikasi" style="">
                              <div class="card-body p-0">
                                   <div style="padding: 30px;">
                                        <div class="row">
                                             <div class="col-md-12">
                                                  <div class="table-responsive">
                                                       <table id="table-spesifikasi" class="table table-bordered table-hover">
                                                            <thead>
                                                                 <tr>
                                                                      <th style="text-align: center;" width="50px;">No</th>
                                                                      <th style="text-align: center;">Jenis</th>
                                                                      <th style="text-align: center;">Detail</th>
                                                                      <th style="text-align: center;">Media</th>
                                                                 </tr>
                                                            </thead>
                                                            <tbody>

                                                            </tbody>
                                                       </table>
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </div>
     <div class="section-body">
          <div class="row">
               <div class="col-12">
                    <div class="card">
                         <div class="card-header">
                              <h4>
                                   Kondisi Tahun {{ date('Y') }}
                              </h4>
                              <div class="card-header-action">
                                   <button class="btn btn-icon btn-lg btn-dark tambah" type="button" title="Simpan Data">
                                        <i class="fas fa-plus"></i> Tambah
                                   </button>
                                   <a data-collapse="#kondisi" class="btn btn-icon btn-lg btn-info" href="#"><i class="fas fa-minus"></i></a>
                              </div>
                         </div>
                         <div class="collapse show" id="kondisi" style="">
                              <div class="card-body p-0">
                                   <div style="padding: 30px;">
                                        <div class="row">
                                             <div class="col-md-12">
                                                  <div class="table-responsive">
                                                       <table id="table-kondisi" class="table table-bordered table-hover">
                                                            <thead>
                                                                 <tr>
                                                                      <th style="text-align: center;" width="50px;">No</th>
                                                                      <th style="text-align: center;">Jenis</th>
                                                                      <th style="text-align: center;">Kondisi</th>
                                                                      <th style="text-align: center;">Foto Kondisi</th>
                                                                      <th style="text-align: center;">Luas</th>
                                                                      <th style="text-align: center;">Foto Luas</th>
                                                                 </tr>
                                                            </thead>
                                                            <tbody>

                                                            </tbody>
                                                       </table>
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </div>
     <div class="section-body">
          <div class="row">
               <div class="col-12">
                    <div class="card">
                         <div class="card-header">
                              <h4>
                                   Site Plan
                              </h4>
                              <div class="card-header-action">
                                   <button class="btn btn-icon btn-lg btn-dark tambah" type="button" title="Simpan Data">
                                        <i class="fas fa-plus"></i> Tambah
                                   </button>
                                   <a data-collapse="#kondisi" class="btn btn-icon btn-lg btn-info" href="#"><i class="fas fa-minus"></i></a>
                              </div>
                         </div>
                         <div class="collapse show" id="kondisi" style="">
                              <div class="card-body p-0">
                                   <div style="padding: 30px;">
                                        <div class="row">
                                             <div class="col-md-12">
                                                  <div class="form-group row mb-1">
                                                       <label class="col-form-label col-md-3 col-lg-3">
                                                            <strong> Foto </strong>
                                                       </label>
                                                       <label class="col-form-label col-md-9 col-lg-9">
                                                            Tahun
                                                       </label>
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </div>
</section>
@endsection

@section('modal')
     @include('pages.survey.detail-modal')
@endsection

@section('script')
     @include('pages.survey.detail-script')
@endsection