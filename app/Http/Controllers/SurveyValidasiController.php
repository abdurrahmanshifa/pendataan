<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SurveyValidasi;
use App\Helpers\DateHelper;
use Illuminate\Support\Facades\Hash;
use DataTables;
use Validator;
use Ramsey\Uuid\Uuid;
use Str;

class SurveyValidasiController extends Controller
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
                         'foto'             => 'required|max:50000',
                    ],
               );
               
          
               if ($validator->passes()) {
                    $check = SurveyValidasi::where('id_survey',$request->input('id_survey'))->first();

                    if(isset($check->foto))
                    {
                         $data = SurveyValidasi::find($check->id);
                         if($request->hasFile('foto'))
                         {
                              $file = $request->file('foto');
                              $file_ext = $file->getClientOriginalExtension();
                              $filename = $check->id.'_'.Str::random(10).'.'.$file_ext;
                              $file->storeAs('survey-validasi', $filename);
                              $data->berkas    = $filename;
                         }
                         $data->updated_at        = now();
                    }else{
                         $id = Uuid::uuid4()->getHex();
                         $data                    = new SurveyValidasi();
                         $data->id                = $id;
                         $data->id_survey         = $request->input('id_survey');
                         if($request->hasFile('foto'))
                         {
                              $file = $request->file('foto');
                              $file_ext = $file->getClientOriginalExtension();
                              $filename = $id.'_'.Str::random(10).'.'.$file_ext;
                              $file->storeAs('survey-validasi', $filename);
                              $data->berkas    = $filename;
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

          if ($validator->errors()->has('foto')):
               $data['input_error'][] = 'foto';
               $data['error_string'][] = $validator->errors()->first('foto');
               $data['status'] = false;
          endif;

          return $data;
     }
}
