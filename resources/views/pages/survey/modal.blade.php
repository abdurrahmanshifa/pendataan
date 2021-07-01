<div class="modal fade" role="dialog" id="modal_form" data-backdrop="static">
     <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
               <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle"></h5>
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
               </div>
               <form role="form" id="form_data" name="form_data">
               @csrf
                    <div class="modal-body">
                         <div class="form-group row mb-4">
                              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Klasifikasi <span class="text-danger">*</span></label>
                              <div class="col-sm-12 col-md-9">
                                   <input type="hidden" name="id">
                                   <input class="form-control" type="text" name="klasifikasi">
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
                              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Alamat</label>
                              <div class="col-sm-12 col-md-9">
                                   <textarea name="alamat" class="form-control" rows="100"></textarea>
                                   <span class="help form-control-label"></span>
                              </div>
                         </div>
                         <div class="form-group row mb-4">
                              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Latitude</label>
                              <div class="col-sm-12 col-md-9">
                                   <input type="text" class="form-control" name="lat">
                                   <span class="help form-control-label"></span>
                              </div>
                         </div>
                         <div class="form-group row mb-4">
                              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Longtidue</label>
                              <div class="col-sm-12 col-md-9">
                                   <input type="text" class="form-control" name="long">
                                   <span class="help form-control-label"></span>
                              </div>
                         </div>
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