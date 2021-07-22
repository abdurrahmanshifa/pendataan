<form role="form" id="form_site_plan" name="form_site_plan" enctype="multipart/form-data">
     @csrf
     <input type="hidden" name="id_survey" value="{{ $data->id }}">
          <div class="card-header">
               <h4>
                    Site Plan
               </h4>
               <div class="card-header-action">
                    <button class="btn btn-icon btn-lg btn-dark" id="btn_siteplan" type="submit" title="Tambah Data">
                         <i class="fas fa-save"></i> Simpan
                    </button>
                    <a data-collapse="#kondisi" class="btn btn-icon btn-lg btn-info" href="#"><i class="fas fa-minus"></i></a>
               </div>
          </div>
          <div class="collapse show" id="kondisi" style="">
               <div class="card-body p-0">
                    <div style="padding: 30px;">
                         <div class="row">
                              <div class="col-md-12">
                                   <div class="form-group row mb-1">
                                        <label class="col-form-label col-md-4 col-lg-4 text-center">
                                             <img src="{{ asset('stisla/img/news/img04.jpg') }}" class="img-thumbnail">
                                             @if(isset($sitePlan->foto))
                                             <a target="_blank" href="{{ url('show-file/site-plan/'.$sitePlan->foto) }}"> 
                                                  <i class="fas fa-file-download"></i> &nbsp;&nbsp; Unduh / Preview 
                                             </a>
                                             @endif
                                        </label>
                                   </div>
                                   <div class="form-group row mb-1">
                                        <div class="col-md-4 col-lg-4">
                                             <input type="file" class="form-control" name="foto">
                                             <span class="help form-control-label"></span>
                                             <p>
                                                  <label class="help-text form-control-label">* Maksimal File 5 Mb</label>
                                             </p>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </form>