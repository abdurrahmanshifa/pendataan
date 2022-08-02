<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Survey;
use App\Models\SitePlan;
use App\Helpers\DateHelper;
use DataTables;
use Validator;
use Str;
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
                         'foto'             => 'required|max:50000',
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
                              $filename = strtolower(str_replace(' ','_',$check->id)).'_'.Str::random(10).'.'.$file_ext;
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
                              $filename = strtolower(str_replace(' ','_',$id)).'_'.Str::random(10).'.'.$file_ext;
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

          if ($validator->errors()->has('foto')):
               $data['input_error'][] = 'foto';
               $data['error_string'][] = $validator->errors()->first('foto');
               $data['status'] = false;
          endif;

          return $data;
     }
}

