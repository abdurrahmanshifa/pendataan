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
                         <div id="myChart2"></div>
                    </div>
               </div>
          </div>  
     </div>
     <div class="row">
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
                                       <th>Tahun Pembangunan</th>
                                       <th>Luas</th>
                                       <th>Status Lahan</th>
                                       <th>Titik Lokasi</th>
                                       <th>Aksi</th>
                                  </tr>
                             </thead>
                             <tbody>
                              {{-- @foreach ($surveys as $survey)
                              <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $survey->klasifikasi }}</td>
                                <td>{{ $survey->nama_objek }}</td>
                                <td>{{ $survey->kelurahan->nama_kel }}</td>
                                <td>{{ $survey->kelurahan->kecamatan->nama_kec }}</td>
                                <td>
                                     @foreach ($survey->pembangunan as $p)
                                     {{ $p->tahun }}
                                     @endforeach
                                   </td>
                                <td>
                                     @foreach ($survey->pembangunan as $p)
                                     {{ $p->luas }}
                                     @endforeach
                                   </td>
                                <td>{{ $survey->statuslahan->nama }}</td>
                                <td>Lat:{{ $survey->lat }} Long:{{ $survey->lat }} </td>
                                <td>
                                   <a href="#" title="Detail Data" class="btn btn-warning btn-sm"> <i class="fas fa-eye text-white"></i></a>
                                </td>
                              </tr> 
                                @endforeach --}}
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