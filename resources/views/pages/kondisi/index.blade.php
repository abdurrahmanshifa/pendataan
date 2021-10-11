<div class="card-header">
     <h4>
          Kondisi Tahun
     </h4>
     <div class="card-header-action">
          <a  href="javascript:void(0);" class="btn btn-icon btn-lg btn-dark tambah_kondisi" title="Tambah Kondisi">
               <i class="fas fa-plus"></i> Tambah Kondisi
          </a>
          <a data-collapse="#kondisi" class="btn btn-icon btn-lg btn-info" href="#"><i class="fas fa-minus"></i></a>
     </div>
</div>
<div class="collapse show" id="kondisi" style="">
     <div class="card-body p-0">
          <div style="padding: 30px;">
               <div class="row">
                    <div class="col-md-12">
                         <div class="form-group row mb-3 mt-3">
                              <div class="col-md-5 row">
                                   <label class="col-form-label col-md-4">
                                        <strong>Pencarian: </strong>
                                   </label>
                                   <div class="col-md-8">
                                        <select class="form-control select2 tahun">
                                             @for($i=(date('Y')-2); $i<=date('Y')+2; $i++)
                                                  <option value="{{$i}}" {{ date('Y')== $i ? 'selected' : '' }}>{{$i}}</option>
                                             @endfor
                                        </select>
                                   </div>
                              </div>
                         </div>
                         <div class="table-responsive">
                              <table id="table-kondisi" class="table table-bordered table-hover">
                                   <thead>
                                        <tr>
                                             <th style="text-align: center;" width="50px;">No</th>
                                             <th style="text-align: center;">Jenis</th>
                                             <th style="text-align: center;">Kondisi</th>
                                             <th style="text-align: center;">Foto Kondisi</th>
                                             <th style="text-align: center;">Luas / Jumlah</th>
                                             <th style="text-align: center;">Foto</th>
                                             <th style="text-align: center;" width="100px">Aksi</th>
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