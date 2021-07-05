@extends('layouts.template')

@section('title')
<title>TRANSAKSI SURVEY KONDISI | DINAS PERKIM KOTA TANGERANG </title>

@endsection

@section('content')
<section class="section">
     <div class="section-header">
          <h1>Survey Kondisi</h1>
          <div class="section-header-breadcrumb">
               <div class="breadcrumb-item active"><a href="#">Transaksi</a></div>
               <div class="breadcrumb-item"><a href="{{ route('survey') }}">Survey</a></div>
               <div class="breadcrumb-item">Kondisi</div>
          </div>
     </div>
     <h2 class="section-title">
          <a href="{{ url('survey/detail/'.$survey->id) }}" title="Kembali" class="btn btn-icon btn-sm btn-warning rounded-circle icon-back">
               <i class="fas fa-arrow-circle-left"></i>
          </a> 
          Data Survey Kondisi
     </h2>
     <p class="section-lead" style="margin-top:0;line-height:0;"><b>Klasifikasi : </b> {{ ucwords($survey->klasifikasi) }} </p>
     <p class="section-lead"><b> Nama Objek : </b>{{ ucwords($survey->klasifikasi) }}</p>
     <div class="section-body">
          <div class="row">
               <div class="col-12">
                    <div class="card">
                         <div class="card-header">
                              <h4>
                                   Data Kondisi
                              </h4>
                              <div class="card-header-form">
                                   <a data-collapse="#mycard-collapse" class="btn btn-icon btn-info" href="#"><i class="fas fa-minus"></i></a>
                              </div>
                         </div>
                         <div class="collapse show" id="mycard-collapse" style="">
                              <div class="card-body p-0">
                                   <div style="padding: 30px;">
                                        <div class="row">
                                             <div class="col-md-12">
                                                  <div class="form-group row mb-3 mt-3">
                                                       <div class="col-md-6 row">
                                                            <label class="col-form-label col-md-6">
                                                                 <strong>Pencarian: </strong>
                                                            </label>
                                                            <div class="col-md-6">
                                                                 <select class="form-control select2 tahun">
                                                                      @for($i=(date('Y')-2); $i<=date('Y')+2; $i++)
                                                                           <option value="{{$i}}" {{ $tahun== $i ? 'selected' : '' }}>{{$i}}</option>
                                                                      @endfor
                                                                 </select>
                                                            </div>
                                                       </div>
                                                  </div>
                                                  <div class="form-group row mb-3 mt-3">
                                                       <div class="col-md-6">
                                                            
                                                       </div>
                                                       <div class="col-md-6 text-md-right">
                                                            <button class="btn btn-icon btn-sm btn-dark tambah_kondisi" type="button" title="Tambah Data">
                                                                 <i class="fas fa-plus"></i>
                                                            </button>
                                                            <button type="button" class="refresh btn btn-icon btn-sm btn-success" title="Muat Ulang">
                                                                 <i class="fas fa-sync-alt"></i>
                                                            </button>
                                                       </div>
                                                  </div>
                                                  <div class="table-responsive">
                                                       <table id="table-kondisi" class="table table-bordered table-hover">
                                                            <thead>
                                                                 <tr>
                                                                      <th style="text-align: center;" width="50px;">No</th>
                                                                      <th style="text-align: center;">Jenis</th>
                                                                      <th style="text-align: center;">Kondisi</th>
                                                                      <th style="text-align: center;">Foto Kondisi</th>
                                                                      <th style="text-align: center;">Luas / Jumlah</th>
                                                                      <th style="text-align: center;">Foto Luas</th>
                                                                      <th style="text-align: center;">Aksi</th>
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
     @include('pages.kondisi.modal')
@endsection

@section('script')
     @include('pages.kondisi.script')
@endsection