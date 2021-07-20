<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Survey;
use App\Models\Rehabilitasi;
use App\Models\RehabilitasiDetail;
use App\Helpers\DateHelper;
use Illuminate\Support\Facades\Hash;
use DataTables;
use Validator;
use Ramsey\Uuid\Uuid;
use App\Rules\CheckTahunRehab;

class RehabilitasiController extends Controller
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
                         'tahun'             => ['required','numeric',new CheckTahunRehab($request->input('id_survey'))],
                         'sumber_anggaran'   => 'required',
                    ],
                    [
                         'tahun.required'              => 'Tahun tidak boleh kosong!',
                         'tahun.numeric'          => 'Tahun harus angka!',
                         'sumber_anggaran.required'    => 'Sumber anggaran tidak boleh kosong!',
                    ]
               );
               
          
               if ($validator->passes()) {
                    $check = Rehabilitasi::where('id_survey',$request->input('id_survey'))->count();
                    
                    $data                    = new Rehabilitasi();
                    $data->id                = Uuid::uuid4()->getHex();
                    $data->id_survey         = $request->input('id_survey');
                    $data->tahun             = $request->input('tahun');
                    $data->urutan            = $check + 1;
                    $data->sumber_anggaran   = $request->input('sumber_anggaran');
                    $data->created_at        = now();
                    $data->save();
                    
                    foreach($request->input('nama') as $key => $val)
                    {
                         $detail = new RehabilitasiDetail();
                         $id                 = Uuid::uuid4()->getHex();
                         $detail->id         = $id;
                         $detail->id_survey  = $request->input('id_survey');
                         $detail->id_rehabilitasi  = $data->id;
                         $detail->nama       = $val;
                         if(isset($request->input('luas')[$key]))
                         {
                              $detail->luas             = $request->input('luas')[$key];
                         }
                         if(isset($request->file('foto')[$key]))
                         {
                              $file = $request->file('foto')[$key];
                              $file_ext = $file->getClientOriginalExtension();
                              $filename = strtolower(str_replace(' ','_',$id)).'_'.time().'.'.$file_ext;
                              $file->storeAs('rehabilitasi-detail', $filename);
                              $detail->foto    = $filename;
                         }
                         $detail->created_at        = now();
                         $detail->urutan            = $key+1;
                         $save = $detail->save();
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

               $data = $this->_validate($validator);
               return response()->json($data);

          }
     }

     public function ubah(Request $request)
     {
          if($request->input())
          {
               $validator = Validator::make($request->all(), [
                    'tahun'             => ['required','numeric'],
                    'sumber_anggaran'   => 'required',
               ],
               [
                    'tahun.required'              => 'Tahun tidak boleh kosong!',
                    'tahun.numeric'          => 'Tahun harus angka!',
                    'sumber_anggaran.required'    => 'Sumber anggaran tidak boleh kosong!',
               ]
               );
          
               if ($validator->passes()) {
                    $data                    = Rehabilitasi::find($request->input('id_rehabilitasi'));
                    $data->tahun             = $request->input('tahun');
                    $data->sumber_anggaran   = $request->input('sumber_anggaran');
                    $data->updated_at        = now();
                    $data->save();

                    RehabilitasiDetail::where('id_rehabilitasi',$request->input('id_rehabilitasi'))->delete();
                    foreach($request->input('nama') as $key => $val)
                    {
                         $detail = new RehabilitasiDetail();
                         $id                 = Uuid::uuid4()->getHex();
                         $detail->id         = $id;
                         $detail->id_survey  = $request->input('id_survey');
                         $detail->id_rehabilitasi  = $data->id;
                         $detail->nama       = $val;
                         if(isset($request->input('luas')[$key]))
                         {
                              $detail->luas             = $request->input('luas')[$key];
                         }
                         if(isset($request->file('foto')[$key]))
                         {
                              $file = $request->file('foto')[$key];
                              $file_ext = $file->getClientOriginalExtension();
                              $filename = strtolower(str_replace(' ','_',$id)).'_'.time().'.'.$file_ext;
                              $file->storeAs('rehabilitasi-detail', $filename);
                              $detail->foto    = $filename;
                         }
                         else{
                              $detail->foto    = $request->input('foto_lama')[$key];
                         }
                         $detail->created_at        = now();
                         $detail->urutan            = $key+1;
                         $save = $detail->save();
                    }
                    
                    if($save){
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

               $data = $this->_validate($validator);
               return response()->json($data);

          }
     }

     public function data($id)
     {
          $data = Rehabilitasi::with(['rehabilitasiDetail' => function($query) {
               $query->orderBy('urutan','ASC');
          }])->where('id', $id)->first();
          return response()->json($data);
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

          if ($validator->errors()->has('sumber_anggaran')):
               $data['input_error'][] = 'sumber_anggaran';
               $data['error_string'][] = $validator->errors()->first('sumber_anggaran');
               $data['status'] = false;
          endif;

          if ($validator->errors()->has('nama_lain')):
               $data['input_error'][] = 'nama_lain';
               $data['error_string'][] = $validator->errors()->first('nama_lain');
               $data['status'] = false;
          endif;

          if ($validator->errors()->has('luas')):
               $data['input_error'][] = 'luas';
               $data['error_string'][] = $validator->errors()->first('luas');
               $data['status'] = false;
          endif;

          return $data;
     }

     public function rehabilitasi_detail(Request $request)
     {
          if ($request->ajax()) {
               $id = $_GET['filter']['id_rehabilitasi'];
               $data = RehabilitasiDetail::where('id_rehabilitasi',$id)->orderBy('urutan', 'asc')->get();
               
               return Datatables::of($data)
                    ->addIndexColumn()
                    ->editColumn('media', function($row) {
                         if($row->foto != null):
                              $data = "
                                   <div class='gallery gallery-md text-center'>
                                        <a data-toggle='modal' class='zoom' data-id='".url("show-image/rehabilitasi-detail/".$row->foto)."' data-title='".$row->nama."' href='#foto-modal'>
                                             <div class='gallery-item' data-title='".$row->nama."' style='background-image:url(".url('show-image/rehabilitasi-detail/'.$row->foto).")'></div>
                                        </a>
                                   </div>
                              ";
                         else:
                              $data = '-';
                         endif;

                         return $data;
                    })
                    ->editColumn('luas', function ($row) {
                         $data = $row->luas.' m<sup>2</sup>';
 
                         return $data;
                     })
                    ->editColumn('aksi', function ($row) {
                        $data = '
                              <a title="Ubah Data" class="btn btn-success btn-sm" onclick="ubah_rehabilitasi(\''.$row->id_rehabilitasi.'\')"> <i class="fas fa-edit text-white"></i></a>
                              <a title="Hapus Data" class="btn btn-danger btn-sm" onclick="hapus_rehabilitasi(\''.$row->id.'\')"> <i class="fas fa-trash-alt text-white"></i></a>
                         ';

                        return $data;
                    })
                    ->escapeColumns([])
                    ->make(true);
          }
     }

     public function hapus_detail(Request $request , $id)
     {
          $data = RehabilitasiDetail::find($id);
          if($data->delete()){
               $msg = array(
                    'success' => true, 
                    'message' => 'Data berhasil dihapus!',
                    'status' => TRUE
               );
               return response()->json($msg);
          }else{
               $msg = array(
                    'success' => false, 
                    'message' => 'Data gagal dihapus!',
                    'status' => TRUE
               );
               return response()->json($msg);
          }
     }
}