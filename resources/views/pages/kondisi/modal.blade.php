<div class="modal fade" role="dialog" id="modal_kondisi" data-backdrop="static">
     <div class="modal-dialog modal-xl" role="document">
          <div class="modal-content">
               <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle"></h5>
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
               </div>
               <form role="form" id="form_kondisi" name="form_kondisi" enctype="multipart/form-data">
               @csrf
                    <div class="modal-body">
                         <div class="form-group row mb-4">
                              <div class="col-md-6">
                                   <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">
                                             Tahun <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-sm-12 col-md-9">
                                             <input type="hidden" name="id_kondisi">
                                             <input type="hidden" name="id_survey" value="{{ $data->id }}">
                                             <select class="form-control select2" name="tahun">
                                                  <option value="">Pilih Tahun</option>
                                                  @for($i=(date('Y')-2); $i<=date('Y')+2; $i++)
                                                       <option value="{{$i}}">{{$i}}</option>
                                                  @endfor
                                             </select>
                                             <input class="form-control" type="hidden" name="pilih_tahun">
                                             <span class="help form-control-label"></span>
                                        </div>
                                   </div>
                              </div>
                         </div>
                         <div class="form-group row mb-4">
                              <div class="col-md-6">
                                   <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Lainnya</label>
                                        <div class="col-sm-12 col-md-9">
                                             <button type="button" class="btn btn-icon btn-info" id="addButton_kondisi" title="Tambah Lainnya">
                                                  <i class="fas fa-plus"></i>
                                             </button>
                                             <button type="button"  class="btn btn-icon btn-warning" id="removeButton_kondisi" title="Hapus Lainnya">
                                                  <i class="fas fa-minus"></i>
                                             </button>
                                        </div>
                                   </div>
                              </div>
                         </div>
                         <div class="lainnya" id="TextBoxesGroup_kondisi">
                              <div id="TextBoxDiv_kondisi1">
                                   <div class="row input">
                                        <div class="col-md-7">
                                             <div class="form-group row mb-4">
                                                  <div class="col-sm-4 col-md-4">
                                                       <input type="text" name="nama[]" class="form-control" placeholder="Kondisi">
                                                  </div>
                                                  <div class="col-md-4">
                                                       <select name="kondisi[]" class="form-control">
                                                            <option value="Baik">Baik</option>
                                                            <option value="Ada Kerusakaan">Ada Kerusakan</option>
                                                       </select>
                                                       <span class="help form-control-label"></span>
                                                  </div>
                                                  <div class="col-md-4">
                                                       <input type="file" accept="image/x-png,image/gif,image/jpeg" class="form-control" name="foto_kondisi[]">
                                                       <span class="help form-control-label"></span>
                                                  </div>
                                             </div>
                                        </div>
                                        <div class="col-md-5">
                                             <div class="form-group row mb-4">
                                                  <div class="col-sm-6 col-md-6">
                                                       <input type="text" name="luas[]" class="form-control" placeholder="Luas / Jumlah">
                                                  </div>
                                                  <div class="col-md-6">
                                                       <input type="file" accept="image/x-png,image/gif,image/jpeg" class="form-control" name="foto_luas[]">
                                                       <span class="help form-control-label"></span>
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                         <button type="submit" id="" class="btn btn-dark">
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
