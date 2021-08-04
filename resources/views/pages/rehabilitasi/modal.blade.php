<div class="modal fade" role="dialog" id="modal_rehabilitasi" data-backdrop="static">
     <div class="modal-dialog modal-xl" role="document">
          <div class="modal-content">
               <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle"></h5>
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
               </div>
               <form role="form" id="form_rehabilitasi" name="form_rehabilitasi" enctype="multipart/form-data">
               @csrf
                    <div class="modal-body">
                         <div class="row">
                              <div class="col-md-6">
                                   <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-4 col-lg-4">Tahun <span class="text-danger">*</span></label>
                                        <div class="col-sm-12 col-md-5">
                                             <input type="hidden" name="id_rehabilitasi">
                                             <input type="hidden" name="id_survey" value="{{ $data->id }}">
                                             <input class="form-control" type="text" name="tahun">
                                             <span class="help form-control-label"></span>
                                        </div>
                                   </div>
                              </div>
                              <div class="col-md-6">
                                   <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-4 col-lg-4">Sumber Anggaran<span class="text-danger">*</span></label>
                                        <div class="col-sm-12 col-md-5">
                                             <input type="text" class="form-control" name="sumber_anggaran">
                                             <span class="help form-control-label"></span>
                                        </div>
                                   </div>
                              </div>
                         </div>
                         <div class="row">
                              <div class="col-md-4">
                                   <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">
                                             Lainnya
                                        </label>
                                        <div class="col-sm-12 col-md-5">
                                             <button type="button" class="btn btn-icon btn-info addButton_rehab" title="Tambah Lainnya">
                                                  <i class="fas fa-plus"></i>
                                             </button>
                                             <button type="button"  class="btn btn-icon btn-warning removeButton_rehab" title="Hapus Lainnya">
                                                  <i class="fas fa-minus"></i>
                                             </button>
                                        </div>
                                   </div>
                              </div>
                         </div>
                         <div class="row">
                              <div class="col-md-4">
                                   <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama<span class="text-danger">*</span></label>
                                        <div class="col-sm-12 col-md-9">
                                             <input type="text" name="nama[]" class="form-control" value="Dinding" readonly>
                                             <span class="help form-control-label"></span>
                                        </div>
                                   </div>
                              </div>
                              <div class="col-md-4">
                                   <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Luas <span class="text-danger">*</span></label>
                                        <div class="col-sm-12 col-md-9">
                                             <input type="text" class="form-control" name="luas[]" required>
                                             <span class="help form-control-label"></span>
                                        </div>
                                   </div>
                              </div>
                              <div class="col-md-4">
                                   <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Foto <span class="text-danger">*</span></label>
                                        <div class="col-sm-12 col-md-9">
                                             <input type="file" required accept="image/x-png,image/gif,image/jpeg" class="form-control" name="foto[]">
                                             <span class="help form-control-label"></span>
                                             <p><label class="help-text form-control-label">* Maksimal File 2 Mb</label></p>
                                        </div>
                                   </div>
                              </div>
                              <div class="col-md-4">
                                   <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama<span class="text-danger">*</span></label>
                                        <div class="col-sm-12 col-md-9">
                                             <input type="text" name="nama[]" class="form-control" value="Lantai" readonly>
                                             <span class="help form-control-label"></span>
                                        </div>
                                   </div>
                              </div>
                              <div class="col-md-4">
                                   <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Luas <span class="text-danger">*</span></label>
                                        <div class="col-sm-12 col-md-9">
                                             <input type="text" class="form-control" name="luas[]" required>
                                             <span class="help form-control-label"></span>
                                        </div>
                                   </div>
                              </div>
                              <div class="col-md-4">
                                   <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Foto <span class="text-danger">*</span></label>
                                        <div class="col-sm-12 col-md-9">
                                             <input type="file" required accept="image/x-png,image/gif,image/jpeg" class="form-control" name="foto[]">
                                             <span class="help form-control-label"></span>
                                             <p><label class="help-text form-control-label">* Maksimal File 2 Mb</label></p>
                                        </div>
                                   </div>
                              </div>
                              <div class="col-md-4">
                                   <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama<span class="text-danger">*</span></label>
                                        <div class="col-sm-12 col-md-9">
                                             <input type="text" name="nama[]" class="form-control" value="Plafond" readonly>
                                             <span class="help form-control-label"></span>
                                        </div>
                                   </div>
                              </div>
                              <div class="col-md-4">
                                   <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Luas <span class="text-danger">*</span></label>
                                        <div class="col-sm-12 col-md-9">
                                             <input type="text" class="form-control" name="luas[]" required>
                                             <span class="help form-control-label"></span>
                                        </div>
                                   </div>
                              </div>
                              <div class="col-md-4">
                                   <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Foto <span class="text-danger">*</span></label>
                                        <div class="col-sm-12 col-md-9">
                                             <input type="file" required accept="image/x-png,image/gif,image/jpeg" class="form-control" name="foto[]">
                                             <span class="help form-control-label"></span>
                                             <p><label class="help-text form-control-label">* Maksimal File 2 Mb</label></p>
                                        </div>
                                   </div>
                              </div>
                              <div class="col-md-4">
                                   <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama<span class="text-danger">*</span></label>
                                        <div class="col-sm-12 col-md-9">
                                             <input type="text" name="nama[]" class="form-control" value="Kusen" readonly>
                                             <span class="help form-control-label"></span>
                                        </div>
                                   </div>
                              </div>
                              <div class="col-md-4">
                                   <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Luas <span class="text-danger">*</span></label>
                                        <div class="col-sm-12 col-md-9">
                                             <input type="text" class="form-control" name="luas[]" required>
                                             <span class="help form-control-label"></span>
                                        </div>
                                   </div>
                              </div>
                              <div class="col-md-4">
                                   <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Foto <span class="text-danger">*</span></label>
                                        <div class="col-sm-12 col-md-9">
                                             <input type="file" required accept="image/x-png,image/gif,image/jpeg" class="form-control" name="foto[]">
                                             <span class="help form-control-label"></span>
                                             <p><label class="help-text form-control-label">* Maksimal File 2 Mb</label></p>
                                        </div>
                                   </div>
                              </div>
                              <div class="col-md-4">
                                   <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama<span class="text-danger">*</span></label>
                                        <div class="col-sm-12 col-md-9">
                                             <input type="text" name="nama[]" class="form-control" value="Atap" readonly>
                                             <span class="help form-control-label"></span>
                                        </div>
                                   </div>
                              </div>
                              <div class="col-md-4">
                                   <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Luas <span class="text-danger">*</span></label>
                                        <div class="col-sm-12 col-md-9">
                                             <input type="text" class="form-control" name="luas[]" required>
                                             <span class="help form-control-label"></span>
                                        </div>
                                   </div>
                              </div>
                              <div class="col-md-4">
                                   <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Foto <span class="text-danger">*</span></label>
                                        <div class="col-sm-12 col-md-9">
                                             <input type="file" required accept="image/x-png,image/gif,image/jpeg" class="form-control" name="foto[]">
                                             <span class="help form-control-label"></span>
                                             <p><label class="help-text form-control-label">* Maksimal File 2 Mb</label></p>
                                        </div>
                                   </div>
                              </div>
                         </div>
                         <div class="row lain_rehab TextBoxesGroup_rehab">

                         </div>
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                         <button type="submit" id="btn_rehabilitasi_t" class="btn btn-dark">
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

<div class="modal fade" role="dialog" id="modal_rehabilitasi_ubah" data-backdrop="static">
     <div class="modal-dialog modal-xl" role="document">
          <div class="modal-content">
               <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle"></h5>
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
               </div>
               <form role="form" id="form_rehabilitasi_ubah" name="form_rehabilitasi_ubah" enctype="multipart/form-data">
               @csrf
                    <div class="modal-body">
                         <div class="row">
                              <div class="col-md-6">
                                   <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-4 col-lg-4">Tahun <span class="text-danger">*</span></label>
                                        <div class="col-sm-12 col-md-5">
                                             <input type="hidden" name="id_rehabilitasi">
                                             <input type="hidden" name="id_survey" value="{{ $data->id }}">
                                             <input class="form-control" type="text" name="tahun" readonly>
                                             <span class="help form-control-label"></span>
                                        </div>
                                   </div>
                              </div>
                              <div class="col-md-6">
                                   <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-4 col-lg-4">Sumber Anggaran<span class="text-danger">*</span></label>
                                        <div class="col-sm-12 col-md-5">
                                             <input type="text" class="form-control" name="sumber_anggaran">
                                             <span class="help form-control-label"></span>
                                        </div>
                                   </div>
                              </div>
                         </div>
                         <div class="row">
                              <div class="col-md-4">
                                   <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">
                                             Lainnya
                                        </label>
                                        <div class="col-sm-12 col-md-5">
                                             <button type="button" class="btn btn-icon btn-info addButton_rehab" title="Tambah Lainnya">
                                                  <i class="fas fa-plus"></i>
                                             </button>
                                             <button type="button"  class="btn btn-icon btn-warning removeButton_rehab" title="Hapus Lainnya">
                                                  <i class="fas fa-minus"></i>
                                             </button>
                                        </div>
                                   </div>
                              </div>
                         </div>
                         <div class="row lain_rehab TextBoxesGroup_rehab">

                         </div>
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                         <button type="submit" id="btn_rehabilitasi_u" class="btn btn-dark">
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