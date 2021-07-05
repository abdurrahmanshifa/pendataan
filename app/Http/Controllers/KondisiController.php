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
               if(isset($_GET['filter']['tahun']))
               {
                    $tahun = $_GET['filter']['tahun'];
               }else{
                    $tahun = date('Y');
               }
               $data = Kondisi::where('id_survey',$id)->where('tahun',$tahun)->orderBy('urutan','asc')->get();  
               
               return Datatables::of($data)
                    ->addIndexColumn()
                    ->editColumn('foto_kondisi', function($row) {
                         if($row->foto_kondisi != null):
                              $data = "
                                   <div class='gallery gallery-md text-center'>
                                        <a data-toggle='modal' class='open-kondisi' data-id='".$row->foto_kondisi."' data-title='".$row->nama."<br>".$row->kondisi."' href='#foto-modal'>
                                             <div class='gallery-item' data-title='".$row->nama."' style='background-image:url(".url('show-image/kondisi/'.$row->foto_kondisi).")'></div>
                                        </a>
                                   </div>
                              ";
                         else:
                              $data = '-';
                         endif;

                         return $data;
                    })
                    ->editColumn('foto_luas', function($row) {
                         if($row->foto_luas != null):
                              $data = "
                                   <div class='gallery gallery-md text-center'>
                                        <a data-toggle='modal' class='open-luas' data-id='".$row->foto_luas."' data-title='".$row->nama."<br>".$row->luas."' href='#foto-modal'>
                                             <div class='gallery-item' data-title='".$row->nama."' style='background-image:url(".url('show-image/luas-kondisi/'.$row->foto_luas).")'></div>
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
                              <a title="Ubah Data" class="btn btn-success btn-sm" onclick="ubah(\''.$row->id.'\')"> <i class="fas fa-edit text-white"></i></a>
                              <a title="Hapus Data" class="btn btn-danger btn-sm" onclick="hapus(\''.$row->id.'\')"> <i class="fas fa-trash text-white"></i></a>
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
          $survey   = Survey::find($id);
          $tahun    = date('Y'); 
          return view('pages.kondisi.index')->with('survey',$survey)->with('tahun',$tahun);
          
     }

     public function simpan(Request $request)
     {
          if($request->input())
          {
               $validator = Validator::make($request->all(), [
                         'tahun'  => 'required',
                    ],
                    [
                         'tahun.required'   => 'Tahun tidak boleh kosong!',
                    ]
               );
               
          
               if ($validator->passes()) {
                    
                    $jml = Kondisi::where('id_survey',$request->input('id_survey'))->where('tahun',$request->input('tahun'))->orderBy('urutan','desc')->first();

                    foreach($request->input('nama') as $key => $val)
                    {
                         $data = new Kondisi();
                         $id                      = Uuid::uuid4()->getHex();
                         $data->id                = $id;
                         $data->tahun             = $request->input('tahun');
                         $data->id_survey         = $request->input('id_survey');
                         $data->nama              = $val;
                         if(isset($request->input('kondisi')[$key]))
                         {
                              $data->kondisi             = $request->input('kondisi')[$key];
                         }
                         
                         if(isset($request->file('foto_kondisi')[$key]))
                         {
                              $file = $request->file('foto_kondisi')[$key];
                              $file_ext = $file->getClientOriginalExtension();
                              $filename = strtolower(str_replace(' ','_',$id)).'_'.time().'.'.$file_ext;
                              $file->storeAs('kondisi', $filename);
                              $data->foto_kondisi    = $filename;
                         }

                         if(isset($request->input('luas')[$key]))
                         {
                              $data->luas             = $request->input('luas')[$key];
                         }

                         if(isset($request->file('foto_luas')[$key]))
                         {
                              $file = $request->file('foto_luas')[$key];
                              $file_ext = $file->getClientOriginalExtension();
                              $filename = strtolower(str_replace(' ','_',$id)).'_'.time().'.'.$file_ext;
                              $file->storeAs('luas-kondisi', $filename);
                              $data->foto_luas    = $filename;
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

               $data = $this->_validate($validator);
               return response()->json($data);

          }
     }

     public function ubah(Request $request)
     {
          if($request->input())
          {
               $data             = Kondisi::find($request->input('id_kondisi'));
               $data->nama       = $request->input('nama_ubah');
               $data->kondisi        = $request->input('kondisi_ubah');
               $data->luas        = $request->input('luas_ubah');
               if($request->hasFile('foto_kondisi_ubah'))
               {
                    $file = $request->file('foto_kondisi_ubah');
                    $file_ext = $file->getClientOriginalExtension();
                    $filename = strtolower(str_replace(' ','_',$request->input('id_kondisi'))).'_'.time().'.'.$file_ext;
                    $file->storeAs('kondisi', $filename);
                    $data->foto_kondisi    = $filename;
               }

               if($request->hasFile('foto_luas_ubah'))
               {
                    $file = $request->file('foto_luas_ubah');
                    $file_ext = $file->getClientOriginalExtension();
                    $filename = strtolower(str_replace(' ','_',$request->input('id_kondisi'))).'_'.time().'.'.$file_ext;
                    $file->storeAs('luas-kondisi', $filename);
                    $data->foto_luas    = $filename;
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

     public function hapus(Request $request , $id)
     {
          $data = Kondisi::find($id);
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


     public function data($id)
     {
          $data = Kondisi::where('id', $id)->first();
          return response()->json($data);
     }

     private function _validate($validator){
          $data = array();
          $data['error_string'] = array();
          $data['input_error'] = array();

          if ($validator->errors()->has('tahun')):
               $data['input_error'][] = 'pilih_tahun';
               $data['error_string'][] = $validator->errors()->first('tahun');
               $data['status'] = false;
          endif;

          return $data;
     }

}
