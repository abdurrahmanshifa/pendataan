<div class="modal fade" role="dialog" id="modal_pembangunan" data-backdrop="static">
     <div class="modal-dialog modal-xl" role="document">
          <div class="modal-content">
               <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle"></h5>
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
               </div>
               <form role="form" id="form_pembangunan" name="form_pembangunan" enctype="multipart/form-data">
               @csrf
                    <div class="modal-body">
                         <div class="row">
                              <div class="col-md-4">
                                   <div class="form-group row mb-4">
                                        <label class="col-form-label col-12 col-md-5 col-lg-5">
                                             <strong> Tahun </strong> <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-sm-12 col-md-7">
                                             <input type="hidden" name="id_pembangunan">
                                             <input type="hidden" name="id_survey" value="{{ $data->id }}">
                                             <input class="form-control" type="text" name="tahun">
                                             <span class="help form-control-label"></span>
                                        </div>
                                   </div>
                                   <div class="form-group row mb-4">
                                        <label class="col-form-label col-12 col-md-5 col-lg-5">
                                             <strong> Luas </strong> <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-sm-12 col-md-7">
                                             <input type="text" class="form-control" name="luas">
                                             <span class="help form-control-label"></span>
                                        </div>
                                   </div>
                                   <div class="form-group row mb-4">
                                        <label class="col-form-label col-12 col-md-5 col-lg-5">
                                             <strong> Jumlah Lantai </strong> <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-sm-12 col-md-7">
                                             <input type="text" class="form-control" name="jml_lantai">
                                             <span class="help form-control-label"></span>
                                        </div>
                                   </div>
                              </div>
                              <div class="col-md-4">
                                   <div class="form-group row mb-4">
                                        <label class="col-form-label col-12 col-md-5 col-lg-5">
                                             <strong> Halaman </strong>
                                        </label>
                                        <div class="col-sm-12 col-md-7">
                                             <select name="id_halaman" class="form-control select2">
                                                  @foreach($halaman as $val)
                                                       <option value="{{ $val->id }}">{{ $val->nama }}</option>
                                                  @endforeach
                                             </select>
                                             <span class="help form-control-label"></span>
                                        </div>
                                   </div>
                                   <div class="form-group row mb-4">
                                        <label class="col-form-label col-12 col-md-5 col-lg-5">
                                             <strong> Saluran </strong>
                                        </label>
                                        <div class="col-sm-12 col-md-7">
                                             <select name="id_saluran" class="form-control select2">
                                                  @foreach($saluran as $val)
                                                       <option value="{{ $val->id }}">{{ $val->nama }}</option>
                                                  @endforeach
                                             </select>
                                             <span class="help form-control-label"></span>
                                        </div>
                                   </div>
                                   <div class="form-group row mb-4">
                                        <label class="col-form-label col-12 col-md-5 col-lg-5">
                                             <strong> Pagar </strong>
                                        </label>
                                        <div class="col-sm-12 col-md-7">
                                             <select name="id_pagar" class="form-control select2">
                                                  @foreach($pagar as $val)
                                                       <option value="{{ $val->id }}">{{ $val->nama }}</option>
                                                  @endforeach
                                             </select>
                                             <span class="help form-control-label"></span>
                                        </div>
                                   </div>
                              </div>
                              <div class="col-md-4">
                                   <div class="form-group row mb-4">
                                        <label class="col-form-label col-12 col-md-5 col-lg-5">
                                             <strong> Luas Halaman </strong> <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-sm-12 col-md-7">
                                             <input value="" type="text" class="form-control" name="luas_halaman">
                                             <span class="help form-control-label"></span>
                                        </div>
                                   </div>
                                   <div class="form-group row mb-4">
                                        <label class="col-form-label col-12 col-md-5 col-lg-5">
                                             <strong> Panjang Saluran </strong> <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-sm-12 col-md-7">
                                             <input type="text" value="" class="form-control" name="panjang_saluran">
                                             <span class="help form-control-label"></span>
                                        </div>
                                   </div>
                                   <div class="form-group row mb-4">
                                        <label class="col-form-label col-12 col-md-5 col-lg-5">
                                             <strong> Panjang Pagar </strong> <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-sm-12 col-md-7">
                                             <input type="text" value="" class="form-control" name="panjang_pagar">
                                             <span class="help form-control-label"></span>
                                        </div>
                                   </div>
                              </div>
                         </div>
                         <div class="row">
                              <div class="col-md-4">
                                   <div class="form-group row mb-4">
                                        <label class="col-form-label col-12 col-md-5 col-lg-5">
                                             Lainnya
                                        </label>
                                        <div class="col-sm-12 col-md-5">
                                             <button type="button" class="btn btn-icon btn-info" id="addButton_ruangan" title="Tambah Lainnya">
                                                  <i class="fas fa-plus"></i>
                                             </button>
                                             <button type="button"  class="btn btn-icon btn-warning" id="removeButton_ruangan" title="Hapus Lainnya">
                                                  <i class="fas fa-minus"></i>
                                             </button>
                                        </div>
                                   </div>
                              </div>
                         </div>
                         {{-- 
                         <div class="row">
                              <div class="col-md-4">
                                   <div class="form-group row mb-4">
                                        <label class="col-form-label col-12 col-md-5 col-lg-5">Jenis Ruangan <span class="text-danger">*</span></label>
                                        <div class="col-sm-12 col-md-7">
                                             <input type="text" class="form-control" name="id_jenis_ruangan[]">
                                             <span class="help form-control-label"></span>
                                        </div>
                                   </div>
                              </div>
                              <div class="col-md-4">
                                   <div class="form-group row mb-4">
                                        <label class="col-form-label col-12 col-md-5 col-lg-5">Jumlah Ruangan <span class="text-danger">*</span></label>
                                        <div class="col-sm-12 col-md-7">
                                             <input type="text" class="form-control" name="jml_ruangan[]">
                                             <span class="help form-control-label"></span>
                                        </div>
                                   </div>
                              </div>
                              <div class="col-md-4">
                                   <div class="form-group row mb-4">
                                        <label class="col-form-label col-12 col-md-5 col-lg-5">Luas <span class="text-danger">*</span></label>
                                        <div class="col-sm-12 col-md-7">
                                             <input type="text" class="form-control" name="luas_ruangan[]">
                                             <span class="help form-control-label"></span>
                                        </div>
                                   </div>
                              </div>
                              <div class="col-md-4">
                                   <div class="form-group row mb-4">
                                        <label class="col-form-label col-12 col-md-5 col-lg-5">Foto <span class="text-danger">*</span></label>
                                        <div class="col-sm-12 col-md-7">
                                             <input type="file" accept="image/x-png,image/gif,image/jpeg" required class="form-control" name="foto[]">
                                             <span class="help form-control-label"></span>
                                        </div>
                                   </div>
                              </div>
                         </div>
                         --}}
                         <div class="row lain_ruangan" id="TextBoxesGroup_ruangan">

                         </div>
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                         <button type="submit" id="btn-pembangunan" class="btn btn-dark">
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