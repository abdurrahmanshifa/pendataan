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
                                             <table id="table" class="table table-bordered ">
                                                  <thead>
                                                       <tr>
                                                            <th style="text-align: center;" width="50px;">No</th>
                                                            <th style="text-align: center;">Klasifikasi</th>
                                                            <th style="text-align: center;" width="200px;">Lokasi</th>
                                                            <th style="text-align: center;">Status Lahan</th>
                                                            <th style="text-align: center;">Kelengkapan</th>
                                                            <th style="text-align: center;width:100px;">Media</th>
                                                            <th style="text-align: center;width:100px;">Petugas Input</th>
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