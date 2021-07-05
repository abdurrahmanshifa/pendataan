<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Survey;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\StatusLahan;
use App\Models\Pembangunan;
use App\Models\Ruangan;
use App\Models\SitePlan;
use App\Models\Halaman;
use App\Models\Pagar;
use App\Models\Saluran;
use App\Models\PembangunanRuangan;
use App\Helpers\DateHelper;
use Illuminate\Support\Facades\Hash;
use DataTables;
use Validator;
use Ramsey\Uuid\Uuid;

class SitePlanController extends Controller
{
     public function __construct()
     {
          $this->middleware('auth');
     }

     public function simpan(Request $request)
     {
          if($request->input())
          {
               $validator = Validator::make($request->all(), [
                         'foto'             => 'mimes:jpeg,jpg,png,gif|required|max:10000',
                    ],
               );
               
          
               if ($validator->passes()) {
                    $check = SitePlan::where('id_survey',$request->input('id_survey'))->first();

                    if(isset($check->foto))
                    {
                         $data = SitePlan::find($check->id);
                         if($request->hasFile('foto'))
                         {
                              $file = $request->file('foto');
                              $file_ext = $file->getClientOriginalExtension();
                              $filename = strtolower(str_replace(' ','_',$check->id)).'_'.time().'.'.$file_ext;
                              $file->storeAs('site-plan', $filename);
                              $data->foto    = $filename;
                         }
                         $data->updated_at        = now();
                    }else{
                         $id = Uuid::uuid4()->getHex();
                         $data                    = new SitePlan();
                         $data->id                = $id;
                         $data->id_survey         = $request->input('id_survey');
                         if($request->hasFile('foto'))
                         {
                              $file = $request->file('foto');
                              $file_ext = $file->getClientOriginalExtension();
                              $filename = strtolower(str_replace(' ','_',$id)).'_'.time().'.'.$file_ext;
                              $file->storeAs('site-plan', $filename);
                              $data->foto    = $filename;
                         }
                         $data->created_at   = now();
                    }
                    
                    if($data->save()){
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

               $data = $this->_validate($validator);
               return response()->json($data);

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
}
