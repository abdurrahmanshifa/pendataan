@extends('layouts.template')

@section('title')
<title>TRANSAKSI SURVEY | DINAS PERKIM KOTA TANGERANG </title>
@endsection

@section('content')
<section class="section">
     <div class="section-header">
          <h1>Survey</h1>
          <div class="section-header-breadcrumb">
               <div class="breadcrumb-item active"><a href="#">Transaksi</a></div>
               <div class="breadcrumb-item">Survey</div>
          </div>
     </div>
     <div class="section-body">
          <div class="row">
               <div class="col-12">
                    <div class="card">
                         <div class="card-header">
                              <h4>
                                   Filter Searching
                              </h4>
                              <div class="card-header-form">
                                   <a data-collapse="#mycard-collapse1" class="btn btn-icon btn-info" href="#"><i class="fas fa-minus"></i></a>
                              </div>
                         </div>
                         <div class="collapse" id="mycard-collapse1" style="">
                              <div class="card-body p-0">
                                   <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-md-2">
                                             Tahun Pembangunan
                                        </label>
                                        <div class="col-md-4">
                                             <input type="text" class="form-control" name="filter_tahun">
                                        </div>
                                   </div>
                                   <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-md-2">
                                             Klasifikasi
                                        </label>
                                        <div class="col-md-4">
                                             <select name="filter_kla" class="form-control select2" style="width:100%">
                                                  <option value="">-- Semua Klasifikasi --</option>
                                                  @foreach($klasifikasi as $val)
                                                       <option value="{{$val->id}}">{{$val->nama}}</option>
                                                  @endforeach
                                             </select>
                                        </div>
                                   </div>
                                   <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-md-2">
                                             Kecamatan
                                        </label>
                                        <div class="col-md-4">
                                             <select name="filter_kec" class="form-control select2" style="width:200px">
                                                  <option value="">-- Semua Kecamatan --</option>
                                                  @foreach($kecamatan as $val)
                                                       <option value="{{ $val->id }}">{{ $val->nama_kec }}</option>
                                                  @endforeach
                                             </select>
                                        </div>
                                   </div>
                                   <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-md-2">
                                             Kelurahan
                                        </label>
                                        <div class="col-md-4">
                                             <select name="filter_kel" class="form-control select2" style="width:200px">
                                                  <option value="">-- Semua Kelurahan --</option>
                                             </select>
                                        </div>
                                   </div>
                                   <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-md-2">
                                             Status Lahan
                                        </label>
                                        <div class="col-md-4">
                                             <select name="filter_stat" class="form-control select2" style="width:200px">
                                                  <option value="">-- Semua Lahan --</option>
                                                  @foreach($status_lahan as $val)
                                                       <option value="{{ $val->id }}">{{ $val->nama }}</option>
                                                  @endforeach
                                             </select>
                                        </div>
                                   </div>
                                   <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-md-2">
                                             
                                        </label>
                                        <div class="col-md-4">
                                             <button type="button" class="refresh btn btn-icon btn-xs btn-warning">
                                                  Cari
                                             </button>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
               <div class="col-12">
                    <div class="card">
                         <div class="card-header">
                              <h4>
                                   <button class="btn btn-icon btn-lg btn-dark tambah" type="button" title="Tambah Data">
                                        <i class="fas fa-plus"></i> Tambah
                                   </button>
                                   <button type="button" class="refresh btn btn-icon btn-lg btn-success">
                                        <i class="fas fa-sync-alt"></i> Muat Ulang
                                   </button>
                              </h4>
                              <div class="card-header-form">
                                   <a data-collapse="#mycard-collapse" class="btn btn-icon btn-info" href="#"><i class="fas fa-minus"></i></a>
                              </div>
                         </div>
                         <div class="collapse show" id="mycard-collapse" style="">
                              <div class="card-body p-0">
                                   <div style="padding: 30px;">
                                        <div class="table-responsive">
                                             <table id="table" class="table table-bordered table-hover">
                                                  <thead>
                                                       <tr>
                                                            <th style="text-align: center;" width="50px;">No</th>
                                                            <th style="text-align: center;" width="200px;">Klasifikasi</th>
                                                            <th style="text-align: center;">Lokasi</th>
                                                            <th style="text-align: center;">Pembangunan</th>
                                                            <th style="text-align: center;">Status Lahan</th>
                                                            <th style="text-align: center;" width="100px;">Media</th>
                                                            <th style="text-align: center;" width="100px;">Aksi</th>
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
</section>
@endsection

@section('modal')
     @include('pages.survey.modal')
@endsection

@section('script')
     @include('pages.survey.script')
@endsection