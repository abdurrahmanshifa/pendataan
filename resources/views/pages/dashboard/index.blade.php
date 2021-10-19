@extends('layouts.template')

@section('title')
<title>DASHBOARD | DINAS PERKIM KOTA TANGERANG </title>
@endsection


@section('content')
<section class="section">
     <div class="section-header">
          <h1>Dashboard</h1>
     </div>
     <div class="row">
          <div class="col-lg-3 col-md-6 col-sm-6 col-12">
               <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                         <i class="far fa-user"></i>
                    </div>
                    <div class="card-wrap">
                         <div class="card-header">
                              <h4>Pengguna</h4>
                         </div>
                         <div class="card-body">
                              {{ $user }}
                         </div>
                    </div>
               </div>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-6 col-12">
               <div class="card card-statistic-1">
                    <div class="card-icon bg-danger">
                         <i class="fas fa-map-marked"></i>
                    </div>
                    <div class="card-wrap">
                         <div class="card-header">
                              <h4>Kecamatan</h4>
                         </div>
                         <div class="card-body">
                              {{ $kecamatan }}
                         </div>
                    </div>
               </div>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-6 col-12">
               <div class="card card-statistic-1">
                    <div class="card-icon bg-warning">
                         <i class="far fa-map"></i>
                    </div>
                    <div class="card-wrap">
                         <div class="card-header">
                              <h4>Kelurahan</h4>
                         </div>
                         <div class="card-body">
                              {{ $kelurahan }}
                         </div>
                    </div>
               </div>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-6 col-12">
               <div class="card card-statistic-1">
                    <div class="card-icon bg-success">
                         <i class="fas fa-poll"></i>
                    </div>
                    <div class="card-wrap">
                         <div class="card-header">
                              <h4>Survey</h4>
                         </div>
                         <div class="card-body">
                              {{ $survey }}
                         </div>
                    </div>
               </div>
          </div>
     </div>
     <div class="row">
          <div class="col-12">
               <div class="card">
                    <div class="card-header">
                         <h4>Survey Menurut Klasifikasi</h4>
                    </div>
                    <div class="card-body">
                         {{-- <canvas id="myChart2"></canvas> --}}
                         <div id="myChart2" style="overflow:scroll"></div>
                    </div>
               </div>
          </div>  
     </div>
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
                                             @foreach($kecamatans as $val)
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
                         <h4>Data Survey </h4>
                    </div>
                    <div class="card-body">
                     <div class="table-responsive">
                        <table class="table table-bordered" id="table">
                             <thead>
                                  <tr>
                                       <th>No</th>
                                       <th>Klasifikasi</th>
                                       <th>Lokasi</th>
                                       <th>Pembangunan</th>
                                       <th>Status Lahan</th>
                                       <th>Titik Lokasi</th>
                                       <th>Aksi</th>
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
</section>
@endsection
@section('script')
     @include('pages.dashboard.script')
@endsection