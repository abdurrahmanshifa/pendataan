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