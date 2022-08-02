<div class="modal fade" role="dialog" id="modal_form" data-backdrop="static">
     <div class="modal-dialog modal-xl" role="document">
          <div class="modal-content">
               <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle"></h5>
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
               </div>
               <form role="form" id="form_data" name="form_data" enctype="multipart/form-data">
               @csrf
                    <div class="modal-body">
                         <div class="form-group row mb-4">
                              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Klasifikasi <span class="text-danger">*</span></label>
                              <div class="col-sm-12 col-md-9">
                                   <input type="hidden" name="id">
                                   <select name="klasifikasi" class="form-control select2">
                                        <option value="">--Pilih Klasifikasi--</option>
                                        @foreach($klasifikasi as $val)
                                             <option value="{{$val->id}}">{{$val->nama}}</option>
                                        @endforeach
                                   </select>
                                   <input type="hidden" name="id_klasifikasi">
                                   <span class="help form-control-label"></span>
                              </div>
                         </div>
                         <div class="form-group row mb-4">
                              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama Objek <span class="text-danger">*</span></label>
                              <div class="col-sm-12 col-md-9">
                                   <input type="text" class="form-control" name="nama_objek">
                                   <span class="help form-control-label"></span>
                              </div>
                         </div>
                         <div class="form-group row mb-4">
                              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Kecamatan <span class="text-danger">*</span></label>
                              <div class="col-sm-12 col-md-9">
                                   <select name="id_kec" class="form-control select2 id_kec" id="">
                                        <option value="">-- Pilih Kecamatan --</option>
                                        @foreach($kecamatan as $val)
                                             <option value="{{ $val->id }}">{{ $val->nama_kec }}</option>
                                        @endforeach
                                   </select>
                                   <input type="hidden" name="kecamatan">
                                   <span class="help form-control-label"></span>
                              </div>
                         </div>
                         <div class="form-group row mb-4">
                              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Kelurahan <span class="text-danger">*</span></label>
                              <div class="col-sm-12 col-md-9">
                                   <select name="id_kel" class="form-control select2">
                                        <option value="">-- Pilih Kelurahan --</option>
                                   </select>
                                   <input type="hidden" name="kelurahan">
                                   <span class="help form-control-label"></span>
                              </div>
                         </div>
                         <div class="form-group row mb-4">
                              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Alamat <span class="text-danger">*</span></label>
                              <div class="col-sm-12 col-md-9">
                                   <textarea name="alamat" class="form-control" rows="100"></textarea>
                                   <span class="help form-control-label"></span>
                              </div>
                         </div>
                         <div class="form-group row mb-4">
                              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Lokasi <span class="text-danger">*</span></label>
                              <div class="col-sm-12 col-md-9">
                                   <div id="main-map"></div>
                              </div>
                         </div>
                         <div class="form-group row mb-4">
                              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Latitude <span class="text-danger">*</span></label>
                              <div class="col-sm-12 col-md-9">
                                   <input type="text" class="form-control" name="lat">
                                   <span class="help form-control-label"></span>
                              </div>
                         </div>
                         <div class="form-group row mb-4">
                              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Longtidue <span class="text-danger">*</span></label>
                              <div class="col-sm-12 col-md-9">
                                   <input type="text" class="form-control" name="long">
                                   <span class="help form-control-label"></span>
                              </div>
                         </div>
                         {{-- 
                         <div class="form-group row mb-4">
                              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                              <div class="col-sm-12 col-md-9">
                                   <button class="btn btn-info" type="button" onclick="getLocation()">
                                        Klik untuk Dapatkan Latitude & Longtidue
                                   </button>
                              </div>
                         </div>
                         --}}
                         <div class="form-group row mb-4">
                              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Status Lahan <span class="text-danger">*</span></label>
                              <div class="col-sm-12 col-md-9">
                                   <select name="id_status_lahan" class="form-control select2">
                                        @foreach($status_lahan as $val)
                                             <option value="{{ $val->id }}">{{ $val->nama }}</option>
                                        @endforeach
                                   </select>
                                   <span class="help form-control-label"></span>
                              </div>
                         </div>
                         <div class="form-group row mb-4">
                              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Foto <span class="text-danger">*</span></label>
                              <div class="col-sm-12 col-md-9">
                                   <input type="file" accept="image/x-png,image/gif,image/jpeg" class="form-control" name="foto">
                                   <span class="help form-control-label"></span>
                                   <span class="help-text form-control-label"><p>*Hanya Untuk JPG / PNG, Maksimal 2 Mb</p></span>
                              </div>
                         </div>
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                         <button type="submit" id="btn" class="btn btn-dark">
                              Simpan
                         </button>
                         <button type="button" class="btn btn-danger" data-dismiss="modal">
                              Batal
                         </button>
                    </div>
               </form>
          </div>
     </div>
</div>

<div class="modal fade" role="dialog" id="foto-modal" data-backdrop="static">
     <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
               <div class="modal-header">
                    <h5>
                         Detail Foto
                    </h5>
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
               </div>
               <div class="modal-body">
                    <div class="col-md-12">
                         <img id="bookId" src="" alt="" class="img" style="width:100%">
                         <br><br>
                         <h5 id="img-title" class="text-center">
                         </h5>
                    </div>
               </div>
          </div>
     </div>
</div>