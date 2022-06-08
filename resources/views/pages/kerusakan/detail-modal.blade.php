<div class="modal fade" role="dialog" id="modal_kondisi" data-backdrop="static">
     <div class="modal-dialog modal-xl" role="document">
          <div class="modal-content">
               <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle"></h5>
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
               </div>
               <form role="form" id="form_riwayat" name="form_riwayat" enctype="multipart/form-data">
               @csrf
                    <div class="modal-body">
                         <div class="table-responsive mb-5">
                              <table id="table-riwayat" class="table table-bordered table-hover" style="width:100%">
                                   <thead>
                                        <tr>
                                             <th style="text-align: center;" width="50px;">No</th>
                                             <th style="text-align: center;">Jenis</th>
                                             <th style="text-align: center;">Tahun</th>
                                             <th style="text-align: center;">Luas</th>
                                             <th style="text-align: center;">Foto Perbaikan</th>
                                             <th style="text-align: center;" width="100px">Aksi</th>
                                        </tr>
                                   </thead>
                                   <tbody>

                                   </tbody>
                              </table>
                         </div>
                         <div class="form-group row mb-4">
                              <div class="col-md-6">
                                   <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Perbaikan</label>
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
                         <input type="hidden" name="id_survey" value="{{ $data->id }}">
                         <div class="lainnya" id="TextBoxesGroup_kondisi">
                             
                         </div>
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                         <button type="submit" id="btn-kondisi" class="btn btn-dark">
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