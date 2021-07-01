@extends('layouts.template')

@section('title')
<title>TRANSAKSI SURVEY REHABILITASI | DINAS PERKIM KOTA TANGERANG </title>

@endsection

@section('content')
<section class="section">
     <div class="section-header">
          <h1>Survey Rehabilitasi</h1>
          <div class="section-header-breadcrumb">
               <div class="breadcrumb-item active"><a href="#">Transaksi</a></div>
               <div class="breadcrumb-item"><a href="{{ route('survey') }}">Survey</a></div>
               <div class="breadcrumb-item"><a href="{{ url('survey/detail/'.$data->id_survey) }}">{{ $data->survey->klasifikasi }}</a></div>
               <div class="breadcrumb-item">Rehabilitasi</div>
          </div>
     </div>
     <h2 class="section-title">
          <a href="{{ url('survey/detail/'.$data->id_survey) }}" title="Kembali" class="btn btn-icon btn-sm btn-warning rounded-circle icon-back">
               <i class="fas fa-arrow-circle-left"></i>
          </a> 
          Data Survey Rehabilitasi
     </h2>
     <p class="section-lead" style="margin-top:0;line-height:0;"><b>Klasifikasi : </b> {{ ucwords($data->survey->klasifikasi) }} </p>
     <p class="section-lead"><b> Nama Objek : </b>{{ ucwords($data->survey->klasifikasi) }}</p>
     <div class="section-body">
          <div class="row">
               <div class="col-12">
                    <div class="card">
                         <div class="card-header">
                              <h4>
                                   Data Rehabilitasi Ke {{$data->urutan}}
                              </h4>
                              <div class="card-header-form">
                                   <a data-collapse="#mycard-collapse" class="btn btn-icon btn-info" href="#"><i class="fas fa-minus"></i></a>
                              </div>
                         </div>
                         <div class="collapse show" id="mycard-collapse" style="">
                              <div class="card-body p-0">
                                   <div style="padding: 30px;">
                                        <div class="row">
                                             <div class="col-md-4">
                                                  <div class="form-group row mb-4">
                                                       <label class="col-form-label col-md-5 col-lg-5">
                                                            <strong> Tahun </strong>
                                                       </label>
                                                       <label class="col-form-label col-md-5 col-lg-5">
                                                            {{ $data->tahun }}
                                                       </label>
                                                  </div>
                                                  <div class="form-group row mb-4">
                                                       <label class="col-form-label col-md-5 col-lg-5">
                                                            <strong> Sumber Anggaran </strong>
                                                       </label>
                                                       <label class="col-form-label col-md-5 col-lg-5">
                                                            {{ $data->sumber_anggaran }}
                                                       </label>
                                                  </div>
                                             </div>
                                             <div class="col-md-12">
                                                  <div class="form-group row mb-3 mt-3">
                                                       <label class="col-form-label col-md-6">
                                                            <strong> Detail Data</strong>
                                                       </label>
                                                       <div class="col-md-6 text-md-right">
                                                            <button class="btn btn-icon btn-sm btn-dark tambah" type="button" title="Tambah Data">
                                                                 <i class="fas fa-plus"></i>
                                                            </button>
                                                            <button type="button" class="refresh btn btn-icon btn-sm btn-success" title="Muat Ulang">
                                                                 <i class="fas fa-sync-alt"></i>
                                                            </button>
                                                       </div>
                                                  </div>
                                                  <div class="table-responsive">
                                                       <table id="table-detail" class="table table-bordered table-hover">
                                                            <thead>
                                                                 <tr>
                                                                      <th style="text-align: center;" width="50px;">No</th>
                                                                      <th style="text-align: center;">Nama</th>
                                                                      <th style="text-align: center;" width="150px">Luas</th>
                                                                      <th style="text-align: center;width:100px;">Media</th>
                                                                      <th style="text-align: center;" width="100px">Aksi</th>
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
     @include('pages.rehabilitasi.modal')
@endsection

@section('script')
     @include('pages.rehabilitasi.script')
@endsection