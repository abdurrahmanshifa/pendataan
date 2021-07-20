@extends('layouts.template')

@section('title')
<title>SURVEY DETAIL {{ strtoupper($data->klasi->nama) }} | DINAS PERKIM KOTA TANGERANG </title>
<style>
     .file {
          visibility: hidden;
          position: absolute;
     }
</style>
@endsection

@section('content')
<section class="section">
     <div class="section-header">
          <h1>Detail Survey</h1>
          <div class="section-header-breadcrumb">
               <div class="breadcrumb-item active"><a href="#">Transaksi</a></div>
               <div class="breadcrumb-item"><a href="{{ route('survey') }}">Survey</a></div>
               <div class="breadcrumb-item">{{ ucwords($data->klasi->nama) }}</div>
          </div>
     </div>
     <h2 class="section-title">
          <a href="{{ route('survey') }}" title="Kembali" class="btn btn-icon btn-sm btn-warning rounded-circle icon-back">
               <i class="fas fa-arrow-circle-left"></i>
          </a> 
          Klasifikasi : {{ ucwords($data->klasi->nama) }}
     </h2>
     <p class="section-lead">Nama Objek : {{ ucwords($data->nama_objek) }}</p>
     <div class="section-body">
          <div class="row">
               <div class="col-12">
                    <div class="card">
                         @include('pages.pembangunan.index');
                    </div>
               </div>
          </div>
     </div>
     <div class="section-body">
          <div class="row">
               <div class="col-12">
                    <div class="card">
                         @include('pages.rehabilitasi.index');
                    </div>
               </div>
          </div>
     </div>
     <div class="section-body">
          <div class="row">
               <div class="col-12">
                    <div class="card">
                         @include('pages.spesifikasi.index')
                    </div>
               </div>
          </div>
     </div>
     <div class="section-body">
          <div class="row">
               <div class="col-12">
                    <div class="card">
                         @include('pages.kondisi.index')
                    </div>
               </div>
          </div>
     </div>
     <div class="section-body">
          <div class="row">
               <div class="col-12">
                    <div class="card">
                    <form role="form" id="form_site_plan" name="form_site_plan" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id_survey" value="{{ $data->id }}">
                         <div class="card-header">
                              <h4>
                                   Site Plan
                              </h4>
                              <div class="card-header-action">
                                   <button class="btn btn-icon btn-lg btn-dark" id="btn_siteplan" type="submit" title="Tambah Data">
                                        <i class="fas fa-save"></i> Simpan
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
                                                       <label class="col-form-label col-md-6 col-lg-6">
                                                            @if(isset($sitePlan->foto))
                                                                 <img src="{{ url('show-image/site-plan/'.$sitePlan->foto) }}" id="preview" class="img-thumbnail">
                                                            @else
                                                                 <img src="{{ asset('stisla/img/news/img04.jpg') }}" id="preview" class="img-thumbnail">
                                                            @endif
                                                       </label>
                                                  </div>
                                                  <div class="form-group row mb-1">
                                                       <div class="col-md-6 col-lg-6">
                                                            <div class="input-group mb-3">
                                                                 <div class="custom-file">
                                                                      <input type="file" accept="image/x-png,image/gif,image/jpeg" class="custom-file-input" name="foto" id="inputGroupFile02">
                                                                      <label class="custom-file-label" for="inputGroupFile02">Pilih File</label>
                                                                 </div>
                                                            </div>
                                                       </div>
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </form>
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