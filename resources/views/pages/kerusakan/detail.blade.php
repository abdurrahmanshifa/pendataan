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
               <div class="breadcrumb-item"><a href="{{ route('kerusakan') }}">Kerusakan</a></div>
               <div class="breadcrumb-item">{{ ucwords($data->klasi->nama) }}</div>
               <div class="breadcrumb-item">{{ ucwords($data->nama_objek) }}</div>
          </div>
     </div>
     <h2 class="section-title">
          <a href="{{ route('kerusakan') }}" title="Kembali" class="btn btn-icon btn-sm btn-warning rounded-circle icon-back">
               <i class="fas fa-arrow-circle-left"></i>
          </a> 
          Klasifikasi : {{ ucwords($data->klasi->nama) }}
     </h2>
     <p class="section-lead">Nama Objek : {{ ucwords($data->nama_objek) }}</p>
     <div class="section-body">
          <div class="row">
               <div class="col-6">
                    <div class="card">
                         <div class="card-header">
                              <h4>
                                   Detail
                              </h4>
                              <div class="card-header-form">
                                   <a data-collapse="#mycard-collapse1" class="btn btn-icon btn-info" href="#"><i class="fas fa-minus"></i></a>
                              </div>
                         </div>
                         <div class="collapse show" id="mycard-collapse1" style="">
                              <div class="card-body p-0">
                                   <div class="form-group row mb-4">
                                        <label class="col-form-label pl-5 text-md-left col-md-3">
                                             Klasifikasi
                                        </label>
                                        <label class="col-form-label text-md-center col-md-1">
                                             :
                                        </label>
                                        <label class="col-form-label text-md-left col-md-8">
                                             {{$data->klasi->nama}}
                                        </label>
                                   </div>
                                   <div class="form-group row mb-4">
                                        <label class="col-form-label pl-5 text-md-left col-md-3">
                                             Nama Objek
                                        </label>
                                        <label class="col-form-label text-md-center col-md-1">
                                             :
                                        </label>
                                        <label class="col-form-label text-md-left col-md-8">
                                             {{$data->nama_objek}}
                                        </label>
                                   </div>
                                   <div class="form-group row mb-4">
                                        <label class="col-form-label pl-5 text-md-left col-md-3">
                                             Kecamatan
                                        </label>
                                        <label class="col-form-label text-md-center col-md-1">
                                             :
                                        </label>
                                        <label class="col-form-label text-md-left col-md-8">
                                             {{$data->kecamatan->nama_kec}}
                                        </label>
                                   </div>
                                   <div class="form-group row mb-4">
                                        <label class="col-form-label pl-5 text-md-left col-md-3">
                                             Kelurahan
                                        </label>
                                        <label class="col-form-label text-md-center col-md-1">
                                             :
                                        </label>
                                        <label class="col-form-label text-md-left col-md-8">
                                             {{$data->kelurahan->nama_kel}}
                                        </label>
                                   </div>
                                   <div class="form-group row mb-4">
                                        <label class="col-form-label pl-5 text-md-left col-md-3">
                                             Alamat
                                        </label>
                                        <label class="col-form-label text-md-center col-md-1">
                                             :
                                        </label>
                                        <label class="col-form-label text-md-left col-md-8">
                                             {{$data->alamat}}
                                        </label>
                                   </div>
                                   <div class="form-group row mb-4">
                                        <label class="col-form-label pl-5 text-md-left col-md-3">
                                             Status Lahan
                                        </label>
                                        <label class="col-form-label text-md-center col-md-1">
                                             :
                                        </label>
                                        <label class="col-form-label text-md-left col-md-8">
                                             {{$data->statuslahan->nama}}
                                        </label>
                                   </div>
                                   <div class="form-group row mb-4">
                                        <label class="col-form-label pl-5 text-md-left col-md-3">
                                             Foto
                                        </label>
                                        <label class="col-form-label text-md-center col-md-1">
                                             :
                                        </label>
                                        <div class="col-md-8">
                                             <div class='gallery gallery-md'>
                                                  <a data-toggle='modal' class='open-AddBookDialog' data-id='{{ url('show-image/survey/'.$data->foto) }}' data-title='{{$data->nama_objek}}' href='#foto-modal'>
                                                       <img src="{{ url('show-image/survey/'.$data->foto) }}" style="height:200px;" alt="">
                                                  </a>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
               <div class="col-6">
                    <div class="card">
                         <div class="card-header">
                              <h4>
                                   Bangunan
                              </h4>
                              <div class="card-header-form">
                                   <a data-collapse="#mycard-collapse2" class="btn btn-icon btn-info" href="#"><i class="fas fa-minus"></i></a>
                              </div>
                         </div>
                         <div class="collapse show" id="mycard-collapse2" style="">
                              <div class="card-body p-0">
                                   <div class="form-group row mb-4">
                                        <label class="col-form-label pl-5 text-md-left col-md-3">
                                             Tahun
                                        </label>
                                        <label class="col-form-label text-md-center col-md-1">
                                             :
                                        </label>
                                        <label class="col-form-label text-md-left col-md-8">
                                             {{$data->pembangunan->tahun}}
                                        </label>
                                   </div>
                                   <div class="form-group row mb-4">
                                        <label class="col-form-label pl-5 text-md-left col-md-3">
                                             Luas
                                        </label>
                                        <label class="col-form-label text-md-center col-md-1">
                                             :
                                        </label>
                                        <label class="col-form-label text-md-left col-md-8">
                                             {{$data->pembangunan->luas}}
                                        </label>
                                   </div>
                                   <div class="form-group row mb-4">
                                        <label class="col-form-label pl-5 text-md-left col-md-3">
                                             Jumlah Lantai
                                        </label>
                                        <label class="col-form-label text-md-center col-md-1">
                                             :
                                        </label>
                                        <label class="col-form-label text-md-left col-md-8">
                                             {{$data->pembangunan->jml_lantai}}
                                        </label>
                                   </div>
                                   <div class="form-group row mb-4">
                                        <label class="col-form-label pl-5 text-md-left col-md-3">
                                             Halaman
                                        </label>
                                        <label class="col-form-label text-md-center col-md-1">
                                             :
                                        </label>
                                        <label class="col-form-label text-md-left col-md-8">
                                             {{$data->pembangunan->halaman->nama}}
                                        </label>
                                   </div>
                                   <div class="form-group row mb-4">
                                        <label class="col-form-label pl-5 text-md-left col-md-3">
                                             Pagar
                                        </label>
                                        <label class="col-form-label text-md-center col-md-1">
                                             :
                                        </label>
                                        <label class="col-form-label text-md-left col-md-8">
                                             {{$data->pembangunan->pagar->nama}}
                                        </label>
                                   </div>
                                   <div class="form-group row mb-4">
                                        <label class="col-form-label pl-5 text-md-left col-md-3">
                                             Saluran
                                        </label>
                                        <label class="col-form-label text-md-center col-md-1">
                                             :
                                        </label>
                                        <label class="col-form-label text-md-left col-md-8">
                                             {{$data->pembangunan->saluran->nama}}
                                        </label>
                                   </div>
                                   <div class="form-group row mb-4">
                                        <label class="col-form-label pl-5 text-md-left col-md-3">
                                             Luas Halaman
                                        </label>
                                        <label class="col-form-label text-md-center col-md-1">
                                             :
                                        </label>
                                        <label class="col-form-label text-md-left col-md-8">
                                             {{$data->pembangunan->luas_halaman}}
                                        </label>
                                   </div>
                                   <div class="form-group row mb-4">
                                        <label class="col-form-label pl-5 text-md-left col-md-3">
                                             Panjang Pagar
                                        </label>
                                        <label class="col-form-label text-md-center col-md-1">
                                             :
                                        </label>
                                        <label class="col-form-label text-md-left col-md-8">
                                             {{$data->pembangunan->panjang_pagar}}
                                        </label>
                                   </div>
                                   <div class="form-group row mb-4">
                                        <label class="col-form-label pl-5 text-md-left col-md-3">
                                             Panjang Saluran
                                        </label>
                                        <label class="col-form-label text-md-center col-md-1">
                                             :
                                        </label>
                                        <label class="col-form-label text-md-left col-md-8">
                                             {{$data->pembangunan->panjang_saluran}}
                                        </label>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
               <div class="col-12">
               <div class="card">
                         <div class="card-header">
                              <h4>
                                   Kondisi
                              </h4>
                              <div class="card-header-form">
                                   <a data-collapse="#mycard-collapse2" class="btn btn-icon btn-info" href="#"><i class="fas fa-minus"></i></a>
                              </div>
                         </div>
                         <div class="collapse show" id="mycard-collapse2" style="">
                              <div class="card-body p-0">
                                   <div style="padding: 30px;">
                                        <div class="row">
                                             <div class="col-md-12">
                                                  <div class="form-group row mb-3 mt-3">
                                                       <div class="col-md-5 row">
                                                            <label class="col-form-label col-md-4">
                                                                 <strong>Pencarian: </strong>
                                                            </label>
                                                            <div class="col-md-8">
                                                                 <select class="form-control select2 tahun">
                                                                      @foreach($kondisi_tahun as $val)
                                                                           <option value="{{$val->tahun}}" {{ date('Y')== $val->tahun ? 'selected' : '' }}>{{$val->tahun}}</option>
                                                                      @endforeach
                                                                 </select>
                                                            </div>
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
                                                                      <th style="text-align: center;">Keterangan</th>
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
     @include('pages.kerusakan.detail-modal')
@endsection

@section('script')
     @include('pages.kerusakan.detail-script')
@endsection