@extends('layouts.template')

@section('title')
<title>TRANSAKSI SURVEY PEMBANGUNAN | DINAS PERKIM KOTA TANGERANG </title>
@endsection

@section('content')
<section class="section">
     <div class="section-header">
          <h1>Survey Pembangunan</h1>
          <div class="section-header-breadcrumb">
               <div class="breadcrumb-item active"><a href="#">Transaksi</a></div>
               <div class="breadcrumb-item"><a href="{{ route('survey') }}">Survey</a></div>
               <div class="breadcrumb-item"><a href="{{ url('survey/detail/'.$data->id_survey) }}">{{ $data->survey->klasifikasi }}</a></div>
               <div class="breadcrumb-item">Pembangunan</div>
          </div>
     </div>
     <h2 class="section-title">
          <a href="{{ url('survey/detail/'.$data->id_survey) }}" title="Kembali" class="btn btn-icon btn-sm btn-warning rounded-circle icon-back">
               <i class="fas fa-arrow-circle-left"></i>
          </a> 
          Data Survey Pembangunan
     </h2>
     <p class="section-lead">Data Survey Pembangunan</p>
     <div class="section-body">
          <div class="row">
               <div class="col-12">
                    <div class="card">
                         <div class="card-header">
                              <h4>
                                   
                              </h4>
                              <div class="card-header-form">
                                   <a data-collapse="#mycard-collapse" class="btn btn-icon btn-info" href="#"><i class="fas fa-minus"></i></a>
                              </div>
                         </div>
                         <div class="collapse show" id="mycard-collapse" style="">
                              <div class="card-body p-0">
                                   <div style="padding: 30px;">
                                        <div class="row">
                                             <div class="col-md-6">
                                                  <div class="form-group row mb-5">
                                                       <label class="col-form-label col-md-3 col-lg-3">
                                                            <strong> Tahun </strong>
                                                       </label>
                                                       <div class="col-sm-12 col-md-9">
                                                            <input type="text" class="form-control" name="tahun">
                                                            <span class="help form-control-label"></span>
                                                       </div>
                                                  </div>
                                                  <div class="form-group row mb-1">
                                                       <label class="col-form-label col-md-3 col-lg-3">
                                                            <strong> Luas </strong>
                                                       </label>
                                                       <label class="col-form-label col-md-9 col-lg-9">
                                                            Tahun
                                                       </label>
                                                  </div>
                                                  <div class="form-group row mb-1">
                                                       <label class="col-form-label col-md-3 col-lg-3">
                                                            <strong> Jumlah Lantai </strong>
                                                       </label>
                                                       <label class="col-form-label col-md-9 col-lg-9">
                                                            Tahun
                                                       </label>
                                                  </div>
                                             </div>
                                             <div class="col-md-6">
                                                  <div class="form-group row mb-1">
                                                       <label class="col-form-label col-md-3 col-lg-3">
                                                            <strong> Halaman </strong>
                                                       </label>
                                                       <label class="col-form-label col-md-9 col-lg-9">
                                                            
                                                       </label>
                                                  </div>
                                                  <div class="form-group row mb-1">
                                                       <label class="col-form-label col-md-3 col-lg-3">
                                                            <strong> Pagar </strong>
                                                       </label>
                                                       <label class="col-form-label col-md-9 col-lg-9">
                                                            
                                                       </label>
                                                  </div>
                                                  <div class="form-group row mb-1">
                                                       <label class="col-form-label col-md-3 col-lg-3">
                                                            <strong> Saluran </strong>
                                                       </label>
                                                       <label class="col-form-label col-md-9 col-lg-9">
                                                            
                                                       </label>
                                                  </div>
                                             </div>
                                             <div class="col-md-12">
                                                  <div class="form-group row mb-3 mt-3">
                                                       <label class="col-form-label col-md-6">
                                                            <strong> Jenis Ruangan</strong>
                                                       </label>
                                                       <div class="col-md-6 text-md-right">
                                                            <button class="btn btn-icon btn-sm btn-info tambah" type="button" title="Tambah Data">
                                                                 <i class="fas fa-plus"></i>
                                                            </button>
                                                            <button type="button" class="refresh btn btn-icon btn-sm btn-success" title="Muat Ulang">
                                                                 <i class="fas fa-sync-alt"></i>
                                                            </button>
                                                       </div>
                                                  </div>
                                                  <div class="table-responsive">
                                                       <table id="table-jenis-ruangan" class="table table-bordered table-hover">
                                                            <thead>
                                                                 <tr>
                                                                      <th style="text-align: center;" width="50px;">No</th>
                                                                      <th style="text-align: center;">Ruangan</th>
                                                                      <th style="text-align: center;">Jumlah Ruangan</th>
                                                                      <th style="text-align: center;">Luas</th>
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
</section>
@endsection

@section('modal')
     
@endsection

@section('script')
     
@endsection