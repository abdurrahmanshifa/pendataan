<div class="card-header">
     <h4>
          Rehabilitasi
     </h4>
     <div class="card-header-action">
          <button class="btn btn-icon btn-lg btn-dark tambah_rehabilitasi" type="button" title="Simpan Data">
               <i class="fas fa-plus"></i> Tambah
          </button>
          @if($rehabilitasi != null)
               <button type="button" title="Ubah Data" class="btn-ubah-rehabilitasi btn btn-success btn-icon btn-lg" onclick="ubah_rehabilitasi('{{ $rehabilitasi[0]->id }}')">
                    <i class="fas fa-edit"></i> Ubah
               </button>
          @endif
          <a data-collapse="#rehabilitasi" class="btn btn-icon btn-lg btn-info" href="#"><i class="fas fa-minus"></i></a>
     </div>
</div>
<div class="collapse show" id="rehabilitasi" style="">
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
                                        <select class="cari_rehabilitasi select2 form-control">
                                             <option value="-">--Pilih Rehabilitasi--</option>
                                             @foreach($rehabilitasi as $key => $val)
                                                  <option {{ ($key == 0?'selected':'') }} value="{{ $val->id }}">
                                                       Rehabilitasi Ke {{$val->urutan}} Tahun {{$val->tahun}}
                                                  </option>
                                             @endforeach
                                        </select>
                                   </div>
                              </div>
                         </div>
                         <div class="table-responsive">
                              <table id="table-rehabilitasi" class="table table-bordered table-hover">
                                   <thead>
                                        <tr>
                                             <th style="text-align: center;" width="50px;">No</th>
                                             <th style="text-align: center;">Nama</th>
                                             <th style="text-align: center;" width="150px">Luas</th>
                                             <th style="text-align: center;width:100px;">Foto</th>
                                             <th style="text-align: center;width:100px;">Aksi</th>
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