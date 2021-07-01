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
     <p class="section-lead" style="margin-top:0;line-height:0;"><b>Klasifikasi : </b> {{ ucwords($data->survey->klasifikasi) }} </p>
     <p class="section-lead"><b> Nama Objek : </b>{{ ucwords($data->survey->klasifikasi) }}</p>
     <div class="section-body">
          <div class="row">
               <div class="col-12">
                    <div class="card">
                         <form id="form_pembangunan" name="form_pembangunan">
                         @csrf
                         <div class="card-header">
                              <h4>
                                   
                              </h4>
                              <div class="card-header-form">
                                   <button type="submit" class="btn btn-sm btn-dark" id="btn-input">
                                        <i class="fas fa-save"></i> Simpan
                                   </button>
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
                                                            <strong> Tahun </strong> <span class="text-danger">*</span>
                                                       </label>
                                                       <div class="col-sm-12 col-md-7">
                                                            <input type="hidden" name="id" value="{{ $data->id }}">
                                                            <input type="text" class="form-control" name="tahun" value="{{ (isset($data->tahun) ? $data->tahun:'')  }}">
                                                            <span class="help form-control-label"></span>
                                                       </div>
                                                  </div>
                                                  <div class="form-group row mb-4">
                                                       <label class="col-form-label col-md-5 col-lg-5">
                                                            <strong> Luas </strong> <span class="text-danger">*</span>
                                                       </label>
                                                       <div class="col-sm-12 col-md-7">
                                                            <input type="text" class="form-control" name="luas" value="{{ (isset($data->luas) ? $data->luas:'')  }}">
                                                            <span class="help form-control-label"></span>
                                                       </div>
                                                  </div>
                                                  <div class="form-group row mb-4">
                                                       <label class="col-form-label col-md-5 col-lg-5">
                                                            <strong> Jumlah Lantai </strong> <span class="text-danger">*</span>
                                                       </label>
                                                       <div class="col-sm-12 col-md-7">
                                                            <input type="text" class="form-control" name="jml_lantai" value="{{ (isset($data->jml_lantai) ? $data->jml_lantai:'')  }}">
                                                            <span class="help form-control-label"></span>
                                                       </div>
                                                  </div>
                                             </div>
                                             <div class="col-md-4">
                                                  <div class="form-group row mb-4">
                                                       <label class="col-form-label col-md-5 col-lg-5">
                                                            <strong> Halaman </strong>
                                                       </label>
                                                       <div class="col-sm-12 col-md-7">
                                                            <select name="id_halaman" class="form-control select2">
                                                                 @foreach($halaman as $val)
                                                                      <option {{ @($data->id_halaman == $val->id ? 'selected':'')  }} value="{{ $val->id }}">{{ $val->nama }}</option>
                                                                 @endforeach
                                                            </select>
                                                            <span class="help form-control-label"></span>
                                                       </div>
                                                  </div>
                                                  <div class="form-group row mb-4">
                                                       <label class="col-form-label col-md-5 col-lg-5">
                                                            <strong> Saluran </strong>
                                                       </label>
                                                       <div class="col-sm-12 col-md-7">
                                                            <select name="id_saluran" class="form-control select2">
                                                                 @foreach($saluran as $val)
                                                                      <option {{ @($data->id_saluran == $val->id ? 'selected':'')  }} value="{{ $val->id }}">{{ $val->nama }}</option>
                                                                 @endforeach
                                                            </select>
                                                            <span class="help form-control-label"></span>
                                                       </div>
                                                  </div>
                                                  <div class="form-group row mb-4">
                                                       <label class="col-form-label col-md-5 col-lg-5">
                                                            <strong> Pagar </strong>
                                                       </label>
                                                       <div class="col-sm-12 col-md-7">
                                                            <select name="id_pagar" class="form-control select2">
                                                                 @foreach($pagar as $val)
                                                                      <option {{ @($data->id_pagar == $val->id ? 'selected':'')  }} value="{{ $val->id }}">{{ $val->nama }}</option>
                                                                 @endforeach
                                                            </select>
                                                            <span class="help form-control-label"></span>
                                                       </div>
                                                  </div>
                                             </div>
                                             <div class="col-md-4">
                                                  <div class="form-group row mb-4">
                                                       <label class="col-form-label col-md-5 col-lg-5">
                                                            <strong> Luas Halaman </strong> <span class="text-danger">*</span>
                                                       </label>
                                                       <div class="col-sm-12 col-md-7">
                                                            <input value="{{ (isset($data->luas_halaman) ? $data->luas_halaman:'')  }}" type="text" class="form-control" name="luas_halaman">
                                                            <span class="help form-control-label"></span>
                                                       </div>
                                                  </div>
                                                  <div class="form-group row mb-4">
                                                       <label class="col-form-label col-md-5 col-lg-5">
                                                            <strong> Panjang Saluran </strong> <span class="text-danger">*</span>
                                                       </label>
                                                       <div class="col-sm-12 col-md-7">
                                                            <input type="text" value="{{ (isset($data->panjang_saluran) ? $data->panjang_saluran:'')  }}" class="form-control" name="panjang_saluran">
                                                            <span class="help form-control-label"></span>
                                                       </div>
                                                  </div>
                                                  <div class="form-group row mb-4">
                                                       <label class="col-form-label col-md-5 col-lg-5">
                                                            <strong> Panjang Pagar </strong> <span class="text-danger">*</span>
                                                       </label>
                                                       <div class="col-sm-12 col-md-7">
                                                            <input type="text" value="{{ (isset($data->panjang_pagar) ? $data->panjang_pagar:'')  }}" class="form-control" name="panjang_pagar">
                                                            <span class="help form-control-label"></span>
                                                       </div>
                                                  </div>
                                             </div>
                                             <div class="col-md-12">
                                                  <div class="form-group row mb-3 mt-3">
                                                       <label class="col-form-label col-md-6">
                                                            <strong> Jenis Ruangan</strong>
                                                       </label>
                                                       <div class="col-md-6 text-md-right">
                                                            <button class="btn btn-icon btn-sm btn-dark tambah" type="button" title="Tambah Jenis Ruangan">
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
                                                                      <th style="text-align: center;" width="150px">Jumlah Ruangan</th>
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
                         </form>
                    </div>
               </div>
          </div>
     </div>
</section>
@endsection

@section('modal')
     @include('pages.pembangunan.modal')
@endsection

@section('script')
     @include('pages.pembangunan.script')
@endsection