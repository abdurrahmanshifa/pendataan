<div class="modal fade" tabindex="-1" role="dialog" id="modal_form" data-backdrop="static">
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
                              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Jenis Bangunan</label>
                              <div class="col-sm-12 col-md-9">
                                   <select name="keterangan" class="form-control select2" id="">
                                        <option value="Bangunan Kesehatan">Bangunan Kesehatan</option>
                                        <option value="Bangunan Pendidikan">Bangunan Pendidikan</option>
                                        <option value="Bangunan Olahraga">Bangunan Olahraga</option>
                                        <option value="Bangunan Pemerintah">Bangunan Pemerintah</option>
                                   </select>
                                   <span class="help form-control-label"></span>
                              </div>
                         </div> 
                         <div class="form-group row mb-4">
                              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama <span class="text-danger">*</span></label>
                              <div class="col-sm-12 col-md-9">
                                   <input type="hidden" name="id">
                                   <input class="form-control" type="text" name="nama">
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