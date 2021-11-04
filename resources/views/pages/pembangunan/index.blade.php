<div class="card-header">
     <h4>
          Survey Pembangunan
     </h4>
     <div class="card-header-action">
          @if(Auth::user()->group != 2)
               @if($data->pembangunan != null)
                    <a href="javascript:void(0);" onclick="ubah_pembangunan('{{$data->pembangunan->id}}')" class="btn btn-icon btn-lg btn-success text-white" title="Ubah Data">
                         <i class="fas fa-edit"></i> Ubah
                    </a>
               @else
                    <a href="javascript:void(0);" onclick="tambah_pembangunan()" class="btn btn-icon btn-lg btn-dark" title="Tambah Data">
                         <i class="fas fa-plus"></i> Tambah
                    </a>
               @endif
          @endif
          <a data-collapse="#mycard-collapse" class="btn btn-icon btn-lg btn-info" href="#"><i class="fas fa-minus"></i></a>
     </div>
</div>
<div class="collapse show" id="mycard-collapse" style="">
     <div class="card-body p-0">
          <div style="padding: 30px;">
               <div class="row">
                    <div class="col-md-4">
                         <div class="form-group row mb-1">
                              <label class="col-form-label col-md-5 col-lg-5">
                                   <strong> Tahun </strong>
                              </label>
                              <label class="col-form-label col-md-1 col-lg-1">
                                   <strong> : </strong>
                              </label>
                              <label class="col-form-label col-md-6 col-lg-6">
                                   {{ (isset($data->pembangunan->tahun) ?$data->pembangunan->tahun:'-') }}
                              </label>
                         </div>
                         <div class="form-group row mb-1">
                              <label class="col-form-label col-md-5 col-lg-5">
                                   <strong> Luas </strong>
                              </label>
                              <label class="col-form-label col-md-1 col-lg-1">
                                   <strong> : </strong>
                              </label>
                              <label class="col-form-label col-md-6 col-lg-6">
                              {{ (isset($data->pembangunan->luas) ?$data->pembangunan->luas:'-') }}
                              </label>
                         </div>
                         <div class="form-group row mb-1">
                              <label class="col-form-label col-md-5 col-lg-5">
                                   <strong> Jumlah Lantai </strong>
                              </label>
                              <label class="col-form-label col-md-1 col-lg-1">
                                   <strong> : </strong>
                              </label>
                              <label class="col-form-label col-md-6 col-lg-6">
                              {{ (isset($data->pembangunan->jml_lantai) ?$data->pembangunan->jml_lantai:'-') }}
                              </label>
                         </div>
                    </div>
                    <div class="col-md-4">
                         <div class="form-group row mb-1">
                              <label class="col-form-label col-md-5 col-lg-5">
                                   <strong> Halaman </strong>
                              </label>
                              <label class="col-form-label col-md-1 col-lg-1">
                                   <strong> : </strong>
                              </label>
                              <label class="col-form-label col-md-6 col-lg-6">
                              {{ (isset($data->pembangunan->halaman) ?$data->pembangunan->halaman->nama:'-') }}
                              </label>
                         </div>
                         <div class="form-group row mb-1">
                              <label class="col-form-label col-md-5 col-lg-5">
                                   <strong> Pagar </strong>
                              </label>
                              <label class="col-form-label col-md-1 col-lg-1">
                                   <strong> : </strong>
                              </label>
                              <label class="col-form-label col-md-6 col-lg-6">
                              {{ (isset($data->pembangunan->pagar) ?$data->pembangunan->pagar->nama:'-') }}
                              </label>
                         </div>
                         <div class="form-group row mb-1">
                              <label class="col-form-label col-md-5 col-lg-5">
                                   <strong> Saluran </strong>
                              </label>
                              <label class="col-form-label col-md-1 col-lg-1">
                                   <strong> : </strong>
                              </label>
                              <label class="col-form-label col-md-6 col-lg-6">
                              {{ (isset($data->pembangunan->saluran) ?$data->pembangunan->saluran->nama:'-') }}
                              </label>
                         </div>
                    </div>
                    <div class="col-md-4">
                         <div class="form-group row mb-1">
                              <label class="col-form-label col-md-5 col-lg-5">
                                   <strong> Luas Halaman </strong>
                              </label>
                              <label class="col-form-label col-md-1 col-lg-1">
                                   <strong> : </strong>
                              </label>
                              <label class="col-form-label col-md-6 col-lg-6">
                              {{ (isset($data->pembangunan->luas_halaman) ?$data->pembangunan->luas_halaman:'-') }} m <sup>2</sup>
                              </label>
                         </div>
                         <div class="form-group row mb-1">
                              <label class="col-form-label col-md-5 col-lg-5">
                                   <strong> Panjang Pagar </strong>
                              </label>
                              <label class="col-form-label col-md-1 col-lg-1">
                                   <strong> : </strong>
                              </label>
                              <label class="col-form-label col-md-6 col-lg-6">
                              {{ (isset($data->pembangunan->panjang_pagar) ?$data->pembangunan->panjang_pagar:'-') }} m <sup>2</sup>
                              </label>
                         </div>
                         <div class="form-group row mb-1">
                              <label class="col-form-label col-md-5 col-lg-5">
                                   <strong> Panjang Saluran </strong>
                              </label>
                              <label class="col-form-label col-md-1 col-lg-1">
                                   <strong> : </strong>
                              </label>
                              <label class="col-form-label col-md-6 col-lg-6">
                              {{ (isset($data->pembangunan->panjang_saluran) ?$data->pembangunan->panjang_saluran:'-') }} m <sup>2</sup>
                              </label>
                         </div>
                    </div>
                    <div class="col-md-12">
                         <div class="form-group row mb-1 mt-3">
                              <label class="col-form-label col-md-12">
                                   <strong> Jenis Ruangan </strong>
                              </label>
                         </div>
                         <div class="table-responsive">
                              <table id="table-jenis-ruangan" class="table table-bordered table-hover">
                                   <thead>
                                        <tr>
                                             <th style="text-align: center;" width="50px;">No</th>
                                             <th style="text-align: center;">Ruangan</th>
                                             <th style="text-align: center;" width="150px">Jumlah Ruangan</th>
                                             <th style="text-align: center;" width="150px">Luas</th>
                                             <th style="text-align: center;width:100px;">Foto</th>
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