<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Survey;
use App\Models\Spesifikasi;
use App\Helpers\DateHelper;
use Illuminate\Support\Facades\Hash;
use DataTables;
use Validator;
use App\Models\Kondisi;
use Ramsey\Uuid\Uuid;

class KondisiController extends Controller
{
     public function __construct()
     {
          $this->middleware('auth');
     }

     public function index(Request $request,$id)
     {
          if ($request->ajax()) {
               $data = Kondisi::where('id_survey',$id)->where('tahun',date('Y'))->orderBy('urutan','asc')->get();  
               
               return Datatables::of($data)
                    ->addIndexColumn()
                    ->editColumn('media', function($row) {
                         if($row->foto_kondisi != null):
                              $data = "
                                   <div class='gallery gallery-md text-center'>
                                        <a data-toggle='modal' class='open-spesifikasi' data-id='".$row->foto_kondisi."' data-title='".$row->nama."<br>".$row->kondisi."' href='#foto-modal'>
                                             <div class='gallery-item' data-title='".$row->nama."' style='background-image:url(".url('show-image/spesifikasi/'.$row->foto_kondisi).")'></div>
                                        </a>
                                   </div>
                              ";
                         else:
                              $data = '-';
                         endif;

                         return $data;
                    })
                    ->editColumn('aksi', function($row) {
                         $data = '
                              <a title="Ubah Data" class="btn btn-success btn-sm" onclick="ubah_spesifikasi(\''.$row->id.'\')"> <i class="fas fa-edit text-white"></i></a>
                         ';

                         return $data;
                    })
                    ->editColumn('kondisi', function($row) {
                         if($row->kondisi != null):
                              $data = $row->kondisi;
                         else:
                              $data = '-';
                         endif;

                         return $data;
                    })
                    ->escapeColumns([])
                    ->make(true);
          }
          
     }

     public function simpan(Request $request)
     {
          if($request->input())
          {
               foreach($request->input('nama') as $key => $val)
               {
                    $data = new Spesifikasi();
                    $id                      = Uuid::uuid4()->getHex();
                    $data->id                = $id;
                    $data->id_survey         = $request->input('id_survey');
                    $data->nama              = $val;
                    if(isset($request->input('jenis')[$key]))
                    {
                         $data->jenis             = $request->input('jenis')[$key];
                    }
                    
                    if(isset($request->file('foto')[$key]))
                    {
                         $file = $request->file('foto')[$key];
                         $file_ext = $file->getClientOriginalExtension();
                         $filename = strtolower(str_replace(' ','_',$id)).'_'.time().'.'.$file_ext;
                         $file->storeAs('spesifikasi', $filename);
                         $data->foto    = $filename;
                    }
                    $data->urutan            = $key+1;
                   
                    
                    $data->created_at        = now();
                    $save = $data->save();
               }
               
               if($save){
                    $msg = array(
                         'success' => true, 
                         'message' => 'Data berhasil disimpan!',
                         'status' => TRUE
                    );
                    return response()->json($msg);
               }else{
                    $msg = array(
                         'success' => false, 
                         'message' => 'Data gagal disimpan!',
                         'status' => TRUE
                    );
                    return response()->json($msg);
               }

          }
     }

     public function simpan_lain(Request $request)
     {
          if($request->input())
          {
               $jml = Spesifikasi::where('id_survey',$request->input('id_survey'))->count();

               foreach($request->input('nama') as $key => $val)
               {
                    $data = new Spesifikasi();
                    $id                      = Uuid::uuid4()->getHex();
                    $data->id                = $id;
                    $data->id_survey         = $request->input('id_survey');
                    $data->nama              = $val;
                    if(isset($request->input('jenis')[$key]))
                    {
                         $data->jenis             = $request->input('jenis')[$key];
                    }
                    
                    if(isset($request->file('foto')[$key]))
                    {
                         $file = $request->file('foto')[$key];
                         $file_ext = $file->getClientOriginalExtension();
                         $filename = strtolower(str_replace(' ','_',$id)).'_'.time().'.'.$file_ext;
                         $file->storeAs('spesifikasi', $filename);
                         $data->foto    = $filename;
                    }
                    $data->urutan            = $jml+=1;
                   
                    
                    $data->created_at        = now();
                    $save = $data->save();
               }
               
               if($save){
                    $msg = array(
                         'success' => true, 
                         'message' => 'Data berhasil disimpan!',
                         'status' => TRUE
                    );
                    return response()->json($msg);
               }else{
                    $msg = array(
                         'success' => false, 
                         'message' => 'Data gagal disimpan!',
                         'status' => TRUE
                    );
                    return response()->json($msg);
               }

          }
     }

     public function ubah(Request $request)
     {
          if($request->input())
          {
               $data             = Spesifikasi::find($request->input('id_spesifikasi'));
               $data->nama       = $request->input('nama');
               $data->jenis        = $request->input('jenis');
               if($request->hasFile('foto'))
               {
                    $file = $request->file('foto');
                    $file_ext = $file->getClientOriginalExtension();
                    $filename = strtolower(str_replace(' ','_',$request->input('id_spesifikasi'))).'_'.time().'.'.$file_ext;
                    $file->storeAs('spesifikasi', $filename);
                    $data->foto    = $filename;
               }

               $data->updated_at = now();

               if($data->save()){
                    $msg = array(
                         'success' => true, 
                         'message' => 'Data berhasil diubah!',
                         'status' => TRUE
                    );
                    return response()->json($msg);
               }else{
                    $msg = array(
                         'success' => false, 
                         'message' => 'Data gagal diubah!',
                         'status' => TRUE
                    );
                    return response()->json($msg);
               }

          }
     }


     private function _validate($validator){
          $data = array();
          $data['error_string'] = array();
          $data['input_error'] = array();

          if ($validator->errors()->has('tahun')):
               $data['input_error'][] = 'tahun';
               $data['error_string'][] = $validator->errors()->first('tahun');
               $data['status'] = false;
          endif;
     
          if ($validator->errors()->has('jml_lantai')):
               $data['input_error'][] = 'jml_lantai';
               $data['error_string'][] = $validator->errors()->first('jml_lantai');
               $data['status'] = false;
          endif;

          if ($validator->errors()->has('luas_halaman')):
               $data['input_error'][] = 'luas_halaman';
               $data['error_string'][] = $validator->errors()->first('luas_halaman');
               $data['status'] = false;
          endif;

          if ($validator->errors()->has('panjang_saluran')):
               $data['input_error'][] = 'panjang_saluran';
               $data['error_string'][] = $validator->errors()->first('panjang_saluran');
               $data['status'] = false;
          endif;

          if ($validator->errors()->has('panjang_pagar')):
               $data['input_error'][] = 'panjang_pagar';
               $data['error_string'][] = $validator->errors()->first('panjang_pagar');
               $data['status'] = false;
          endif;

          if ($validator->errors()->has('jml_ruangan')):
               $data['input_error'][] = 'jml_ruangan';
               $data['error_string'][] = $validator->errors()->first('jml_ruangan');
               $data['status'] = false;
          endif;

          if ($validator->errors()->has('luas')):
               $data['input_error'][] = 'luas';
               $data['error_string'][] = $validator->errors()->first('luas');
               $data['status'] = false;
          endif;

          return $data;
     }

     public function data($id)
     {
          $data = Spesifikasi::find($id);
          $type = $data->nama;
          switch ($type) {
               case 'Dinding':
                    $dinding = Dinding::get();
                    $result['nama'] = '
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">
                         Dinding
                         <input type="hidden" name="id_spesifikasi" value="'.$data->id.'">
                         <input type="hidden" name="nama" value="Dinding">
                    </label>';
                    $result['type'] = '
                         <select name="jenis" class="select2 form-control">
                              <option value="">-- Pilih Salah Satu --</option>';
                              foreach($dinding as $val):
                                  $result['type'] .= ' <option '.($val->nama == $data->jenis?'selected':'').' value="'.$val->nama.'">'. $val->nama.'</option>';
                              endforeach;
                    $result['type'] .= '</select><span class="help form-control-label"></span>';
               break;
               case 'Lantai':
                    $lantai = Lantai::get();
                    $result['nama'] = '
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">
                         Lantai
                         <input type="hidden" name="id_spesifikasi" value="'.$data->id.'">
                         <input type="hidden" name="nama" value="Lantai">
                    </label>';
                    $result['type'] = '
                         <select name="jenis" class="select2 form-control">
                              <option value="">-- Pilih Salah Satu --</option>';
                              foreach($lantai as $val):
                                  $result['type'] .= ' <option '.($val->nama == $data->jenis?'selected':'').' value="'.$val->nama.'">'. $val->nama.'</option>';
                              endforeach;
                    $result['type'] .= '</select><span class="help form-control-label"></span>';
               break;
               case 'Plafond':
                    $plafond = Plafond::get();
                    $result['nama'] = '
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">
                         Plafond
                         <input type="hidden" name="id_spesifikasi" value="'.$data->id.'">
                         <input type="hidden" name="nama" value="Plafond">
                    </label>';
                    $result['type'] = '
                         <select name="jenis" class="select2 form-control">
                              <option value="">-- Pilih Salah Satu --</option>';
                              foreach($plafond as $val):
                                  $result['type'] .= ' <option '.($val->nama == $data->jenis?'selected':'').' value="'.$val->nama.'">'. $val->nama.'</option>';
                              endforeach;
                    $result['type'] .= '</select><span class="help form-control-label"></span>';
               break;
               case 'Kusen':
                    $kusen = Kusen::get();
                    $result['nama'] = '
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">
                         Kusen
                         <input type="hidden" name="id_spesifikasi" value="'.$data->id.'">
                         <input type="hidden" name="nama" value="Kusen">
                    </label>';
                    $result['type'] = '
                         <select name="jenis" class="select2 form-control">
                              <option value="">-- Pilih Salah Satu --</option>';
                              foreach($kusen as $val):
                                  $result['type'] .= ' <option '.($val->nama == $data->jenis?'selected':'').' value="'.$val->nama.'">'. $val->nama.'</option>';
                              endforeach;
                    $result['type'] .= '</select><span class="help form-control-label"></span>';
               break;
               case 'Atap':
                    $atap = Atap::get();
                    $result['nama'] = '
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">
                         Atap
                         <input type="hidden" name="id_spesifikasi" value="'.$data->id.'">
                         <input type="hidden" name="nama" value="Atap">
                    </label>';
                    $result['type'] = '
                         <select name="jenis" class="select2 form-control">
                              <option value="">-- Pilih Salah Satu --</option>';
                              foreach($atap as $val):
                                  $result['type'] .= ' <option '.($val->nama == $data->jenis?'selected':'').' value="'.$val->nama.'">'. $val->nama.'</option>';
                              endforeach;
                    $result['type'] .= '</select><span class="help form-control-label"></span>';
               break;
               case 'Rangka Atap':
                    $lantai = RangkaAtap::get();
                    $result['nama'] = '
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">
                         Rangka Atap
                         <input type="hidden" name="id_spesifikasi" value="'.$data->id.'">
                         <input type="hidden" name="nama" value="Rangka Atap">
                    </label>';
                    $result['type'] = '
                         <select name="jenis" class="select2 form-control">
                              <option value="">-- Pilih Salah Satu --</option>';
                              foreach($lantai as $val):
                                  $result['type'] .= ' <option '.($val->nama == $data->jenis?'selected':'').' value="'.$val->nama.'">'. $val->nama.'</option>';
                              endforeach;
                    $result['type'] .= '</select><span class="help form-control-label"></span>';
               break;
               default:
                    $result['nama'] = '
                    <div class="col-sm-12">
                         <input type="hidden" name="id_spesifikasi" value="'.$data->id.'">
                         <input type="text" name="nama" class="form-control" placeholder="Nama" value="'.$data->nama.'">
                    </div>
                    ';
                    $result['type'] = '<input type="text" name="jenis" class="form-control" placeholder="Jenis" value="'.$data->jenis.'">';
                    $result['type'] .= '<span class="help form-control-label"></span>';
               break;
          }
          return response()->json($result);
     }
}
