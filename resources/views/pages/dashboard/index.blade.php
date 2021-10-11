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
<<<<<<< HEAD
          <div class="col-lg-6 col-6">
=======
          <div class="col-12">
>>>>>>> 0d497187dec807cf52f64144c5c6e3b575dd1166
               <div class="card">
                    <div class="card-header">
                         <h4>Survey Menurut Klasifikasi</h4>
                    </div>
                    <div class="card-body">
<<<<<<< HEAD
                         <canvas id="myChart2"></canvas>
                    </div>
               </div>
          </div>
          <div class="col-lg-6 col-6">
=======
                         {{-- <canvas id="myChart2"></canvas> --}}
                         <div id="myChart2" style="overflow:scroll"></div>
                    </div>
               </div>
          </div>  
     </div>
     <div class="row">
          <div class="col-12">
>>>>>>> 0d497187dec807cf52f64144c5c6e3b575dd1166
               <div class="card">
                    <div class="card-header">
                         <h4>Data Survey </h4>
                    </div>
                    <div class="card-body">
<<<<<<< HEAD
=======
                     <div class="table-responsive">
>>>>>>> 0d497187dec807cf52f64144c5c6e3b575dd1166
                        <table class="table table-bordered" id="table">
                             <thead>
                                  <tr>
                                       <th>No</th>
                                       <th>Klasifikasi</th>
<<<<<<< HEAD
                                       <th>Kelengkapan</th>
                                       <th>Aksi</th>
                                  </tr>
                             </thead>
                        </table>
=======
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
>>>>>>> 0d497187dec807cf52f64144c5c6e3b575dd1166
                    </div>
               </div>
          </div>
     </div>
</section>
@endsection
@section('script')
     @include('pages.dashboard.script')
@endsection