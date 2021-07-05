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

<div class="modal fade" role="dialog" id="modal_rehabilitasi" data-backdrop="static">
     <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
               <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle"></h5>
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
               </div>
               <form role="form" id="form_rehabilitasi" name="form_rehabilitasi" enctype="multipart/form-data">
               @csrf
                    <div class="modal-body">
                         <div class="form-group row mb-4">
                              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Tahun <span class="text-danger">*</span></label>
                              <div class="col-sm-12 col-md-9">
                                   <input type="hidden" name="id_rehabilitasi">
                                   <input type="hidden" name="id_survey" value="{{ $data->id }}">
                                   <input class="form-control" type="text" name="tahun">
                                   <span class="help form-control-label"></span>
                              </div>
                         </div>
                         <div class="form-group row mb-4">
                              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Sumber Anggaran <span class="text-danger">*</span></label>
                              <div class="col-sm-12 col-md-9">
                                   <input type="text" class="form-control" name="sumber_anggaran">
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

<div class="modal fade" role="dialog" id="modal_spesifikasi" data-backdrop="static">
     <div class="modal-dialog modal-xl" role="document">
          <div class="modal-content">
               <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle"></h5>
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
               </div>
               <form role="form" id="form_spesifikasi" name="form_spesifikasi" enctype="multipart/form-data">
               @csrf
               <input type="hidden" name="id_survey" value="{{ $data->id }}">
                    <div class="modal-body">
                         <div class="row input">
                              <div class="col-md-6">
                                   <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">
                                             Dinding
                                             <input type="hidden" name="id_spesifikasi[]">
                                             <input type="hidden" name="nama[]" value="Dinding">
                                        </label>
                                        <div class="col-sm-12 col-md-9">
                                             
                                             <select name="jenis[]" class="select2 form-control">
                                                  <option value="">-- Pilih Salah Satu --</option>
                                                  @foreach($dinding as $val)
                                                       <option value="{{ $val->nama }}">{{ $val->nama }}</option>
                                                  @endforeach
                                             </select>
                                             <span class="help form-control-label"></span>
                                        </div>
                                   </div>
                              </div>
                              <div class="col-md-6">
                                   <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Media</label>
                                        <div class="col-sm-12 col-md-9">
                                             <input type="file" accept="image/x-png,image/gif,image/jpeg" class="form-control" name="foto[]">
                                             <span class="help form-control-label"></span>
                                        </div>
                                   </div>
                              </div>
                         </div>
                         <div class="row input">
                              <div class="col-md-6">
                                   <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">
                                             Lantai
                                             <input type="hidden" name="id_spesifikasi[]">
                                             <input type="hidden" name="nama[]" value="Lantai">
                                        </label>
                                        <div class="col-sm-12 col-md-9">
                                             <select name="jenis[]" class="select2 form-control">
                                                  <option value="">-- Pilih Salah Satu --</option>
                                                  @foreach($lantai as $val)
                                                       <option value="{{ $val->nama }}">{{ $val->nama }}</option>
                                                  @endforeach
                                             </select>
                                             <span class="help form-control-label"></span>
                                        </div>
                                   </div>
                              </div>
                              <div class="col-md-6">
                                   <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Media</label>
                                        <div class="col-sm-12 col-md-9">
                                             <input type="file" accept="image/x-png,image/gif,image/jpeg" class="form-control" name="foto[]">
                                             <span class="help form-control-label"></span>
                                        </div>
                                   </div>
                              </div>
                         </div>
                         <div class="row input">
                              <div class="col-md-6">
                                   <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">
                                             Plafond
                                             <input type="hidden" name="id_spesifikasi[]">
                                             <input type="hidden" name="nama[]" value="Plafond">
                                        </label>
                                        <div class="col-sm-12 col-md-9">
                                             <select name="jenis[]" class="select2 form-control">
                                                  <option value="">-- Pilih Salah Satu --</option>
                                                  @foreach($plafond as $val)
                                                       <option value="{{ $val->nama }}">{{ $val->nama }}</option>
                                                  @endforeach
                                             </select>
                                             <span class="help form-control-label"></span>
                                        </div>
                                   </div>
                              </div>
                              <div class="col-md-6">
                                   <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Media</label>
                                        <div class="col-sm-12 col-md-9">
                                             <input type="file" accept="image/x-png,image/gif,image/jpeg" class="form-control" name="foto[]">
                                             <span class="help form-control-label"></span>
                                        </div>
                                   </div>
                              </div>
                         </div>
                         <div class="row input">
                              <div class="col-md-6">
                                   <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">
                                             Kusen
                                             <input type="hidden" name="id_spesifikasi[]">
                                             <input type="hidden" name="nama[]" value="Kusen">
                                        </label>
                                        <div class="col-sm-12 col-md-9">
                                             <select name="jenis[]" class="select2 form-control">
                                                  <option value="">-- Pilih Salah Satu --</option>
                                                  @foreach($kusen as $val)
                                                       <option value="{{ $val->nama }}">{{ $val->nama }}</option>
                                                  @endforeach
                                             </select>
                                             <span class="help form-control-label"></span>
                                        </div>
                                   </div>
                              </div>
                              <div class="col-md-6">
                                   <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Media</label>
                                        <div class="col-sm-12 col-md-9">
                                             <input type="file" accept="image/x-png,image/gif,image/jpeg" class="form-control" name="foto[]">
                                             <span class="help form-control-label"></span>
                                        </div>
                                   </div>
                              </div>
                         </div>
                         <div class="row input">
                              <div class="col-md-6">
                                   <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">
                                             Atap
                                             <input type="hidden" name="id_spesifikasi[]">
                                             <input type="hidden" name="nama[]" value="Atap">
                                        </label>
                                        <div class="col-sm-12 col-md-9">
                                             <select name="jenis[]" class="select2 form-control">
                                             <option value="">-- Pilih Salah Satu --</option>
                                                  @foreach($atap as $val)
                                                       <option value="{{ $val->nama }}">{{ $val->nama }}</option>
                                                  @endforeach
                                             </select>
                                             <span class="help form-control-label"></span>
                                        </div>
                                   </div>
                              </div>
                              <div class="col-md-6">
                                   <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Media</label>
                                        <div class="col-sm-12 col-md-9">
                                             <input type="file" accept="image/x-png,image/gif,image/jpeg" class="form-control" name="foto[]">
                                             <span class="help form-control-label"></span>
                                        </div>
                                   </div>
                              </div>
                         </div>
                         <div class="row input">
                              <div class="col-md-6">
                                   <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">
                                             Rangka Atap
                                             <input type="hidden" name="id_spesifikasi[]">
                                             <input type="hidden" name="nama[]" value="Rangka Atap">
                                        </label>
                                        <div class="col-sm-12 col-md-9">
                                             <select name="jenis[]" class="select2 form-control">
                                                  <option value="">-- Pilih Salah Satu --</option>
                                                  @foreach($rangkaAtap as $val)
                                                       <option value="{{ $val->nama }}">{{ $val->nama }}</option>
                                                  @endforeach
                                             </select>
                                             <span class="help form-control-label"></span>
                                        </div>
                                   </div>
                              </div>
                              <div class="col-md-6">
                                   <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Media</label>
                                        <div class="col-sm-12 col-md-9">
                                             <input type="file" accept="image/x-png,image/gif,image/jpeg" class="form-control" name="foto[]">
                                             <span class="help form-control-label"></span>
                                        </div>
                                   </div>
                              </div>
                         </div>
                         <div class="row">
                              <div class="col-md-6">
                                   <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Lainnya</label>
                                        <div class="col-sm-12 col-md-9">
                                             <button type="button" class="btn btn-icon btn-info" id="addButton" title="Tambah Lainnya">
                                                  <i class="fas fa-plus"></i>
                                             </button>
                                             <button type="button"  class="btn btn-icon btn-warning" id="removeButton" title="Hapus Lainnya">
                                                  <i class="fas fa-minus"></i>
                                             </button>
                                        </div>
                                   </div>
                              </div>
                         </div>
                         <div class="lainnya" id="TextBoxesGroup">
                              
                         </div>
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                         <button type="submit" id="btn_spesifikasi" class="btn btn-dark">
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

<div class="modal fade" role="dialog" id="modal_spesifikasi_lain" data-backdrop="static">
     <div class="modal-dialog modal-xl" role="document">
          <div class="modal-content">
               <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle"></h5>
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
               </div>
               <form role="form" id="form_spesifikasi_lain" name="form_spesifikasi_lain" enctype="multipart/form-data">
               @csrf
               <input type="hidden" name="id_survey" value="{{ $data->id }}">
                    <div class="modal-body">
                         <div class="row">
                              <div class="col-md-6">
                                   <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Lainnya</label>
                                        <div class="col-sm-12 col-md-9">
                                             <button type="button" class="btn btn-icon btn-info" id="addButton_lain" title="Tambah Lainnya">
                                                  <i class="fas fa-plus"></i>
                                             </button>
                                             <button type="button"  class="btn btn-icon btn-warning" id="removeButton_lain" title="Hapus Lainnya">
                                                  <i class="fas fa-minus"></i>
                                             </button>
                                        </div>
                                   </div>
                              </div>
                         </div>
                         <div class="lainnya" id="TextBoxesGroup_lain">
                              <div id="TextBoxDiv_lain1">
                                   <div class="row input">
                                        <div class="col-md-6">
                                             <div class="form-group row mb-4">
                                                  <div class="col-sm-4 col-md-4">
                                                       <input type="hidden" name="id_spesifikasi[]">
                                                       <input type="text" name="nama[]" class="form-control" placeholder="Nama">
                                                  </div>
                                                  <div class="col-md-8">
                                                       <input type="text" name="jenis[]" class="form-control" placeholder="Jenis">
                                                       <span class="help form-control-label"></span>
                                                  </div>
                                             </div>
                                        </div>
                                        <div class="col-md-6">
                                             <div class="form-group row mb-4">
                                                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Media</label>
                                                  <div class="col-sm-12 col-md-9">
                                                       <input type="file" accept="image/x-png,image/gif,image/jpeg" class="form-control" name="foto[]">
                                                       <span class="help form-control-label"></span>
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                         <button type="submit" id="btn_spesifikasi_lain" class="btn btn-dark">
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

<div class="modal fade" role="dialog" id="modal_spesifikasi_ubah" data-backdrop="static">
     <div class="modal-dialog modal-xl" role="document">
          <div class="modal-content">
               <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle"></h5>
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
               </div>
               <form role="form" id="form_spesifikasi_ubah" name="form_spesifikasi_ubah" enctype="multipart/form-data">
               @csrf
               <input type="hidden" name="id_survey" value="{{ $data->id }}">
                    <div class="modal-body">
                         <div class="row input">
                              <div class="col-md-6">
                                   <div class="form-group row mb-4">
                                        <div class="nama_spesifikasi"></div>
                                        <div class="col-md-7 jenis_spesifikasi">
                                        
                                        </div>
                                   </div>
                              </div>
                              <div class="col-md-6">
                                   <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Media</label>
                                        <div class="col-sm-12 col-md-9">
                                             <input type="file" accept="image/x-png,image/gif,image/jpeg" class="form-control" name="foto">
                                             <span class="help form-control-label"></span>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                         <button type="submit" id="btn_spesifikasi_ubah" class="btn btn-dark">
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
