<div class="card-header">
     <h4>
          Spesifikasi Bangunan
     </h4>
     <div class="card-header-action">
          @if($spesifikai->count() == 0)
          <button class="btn btn-icon btn-lg btn-dark tambah_spesifikasi" type="button" title="Tambah Data">
               <i class="fas fa-plus"></i> Tambah Data
          </button>
          @else 
               <button class="btn btn-icon btn-lg btn-info tambah_spesifikasi_lain" type="button" title="Tambah Data">
                    <i class="fas fa-plus"></i> Tambah Data Lainnya
               </button>
          @endif
          <a data-collapse="#spesifikasi" class="btn btn-icon btn-lg btn-info" href="#"><i class="fas fa-minus"></i></a>
     </div>
</div>
<div class="collapse show" id="spesifikasi" style="">
     <div class="card-body p-0">
          <div style="padding: 30px;">
               <div class="row">
                    <div class="col-md-12">
                         <div class="table-responsive">
                              <table id="table-spesifikasi" class="table table-bordered ">
                                   <thead>
                                        <tr>
                                             <th style="text-align: center;" width="50px;">No</th>
                                             <th style="text-align: center;">Jenis</th>
                                             <th style="text-align: center;">Detail</th>
                                             <th style="text-align: center;">Foto</th>
                                             <th style="text-align: center;">Aksi</th>
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