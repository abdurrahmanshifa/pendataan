<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Survey;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\StatusLahan;
use App\Helpers\DateHelper;
use Illuminate\Support\Facades\Hash;
use DataTables;
use Validator;
use Ramsey\Uuid\Uuid;

class SurveyController extends Controller
{
     public function __construct()
     {
          $this->middleware('auth');
     }

     public function index(Request $request)
     {
          if ($request->ajax()) {
               $data = Survey::with(['statuslahan','kecamatan','kelurahan'])->orderBy('created_at','desc')->get();
               return Datatables::of($data)
                    ->addIndexColumn()
                    ->editColumn('aksi', function($row) {
                         $data = '
                              <a href="'.url('survey/detail/'.$row->id).'" title="Detail Data" class="btn btn-warning btn-sm"> <i class="fas fa-eye text-white"></i></a>
                              <a title="Ubah Data" class="btn btn-success btn-sm" onclick="ubah(\''.$row->id.'\')"> <i class="fas fa-edit text-white"></i></a>
                              <a title="Hapus Data" class="btn btn-danger btn-sm" onclick="hapus(\''.$row->id.'\')"> <i class="fas fa-trash-alt text-white"></i></a>
                         ';

                         return $data;
                    })
                    ->editColumn('lokasi', function($row) {
                         $data = 'KECAMATAN : '.$row->kecamatan->nama_kec.'<br> KELURAHAN : '.$row->kelurahan->nama_kel;
                         return  ucwords(strtolower($data));
                    })
                    ->editColumn('status_lahan', function($row) {
                         $data = $row->statuslahan->nama;
                         return $data;
                    })
                    ->editColumn('media', function($row) {
                         if($row->foto != null):
                              $data = "
                                   <div class='gallery gallery-md text-center'>
                                        <a data-toggle='modal' class='open-AddBookDialog' data-id='".$row->foto."' data-title='".$row->klasifikasi."' href='#foto-modal'>
                                             <div class='gallery-item' data-title='".$row->klasifikasi."' style='background-image:url(".url('show-image/survey/'.$row->foto).")'></div>
                                        </a>
                                   </div>
                              ";
                         else:
                              $data = '-';
                         endif;

                         return $data;
                    })
                    ->escapeColumns([])
                    ->make(true);
          }

          $kecamatan     = Kecamatan::orderBy('nama_kec','asc')->get();
          $statuslahan   = StatusLahan::orderBy('created_at','asc')->get();

          return view('pages.survey.index')->with('kecamatan',$kecamatan)->with('status_lahan',$statuslahan);
     }

     public function simpan(Request $request)
     {
          if($request->input())
          {
               $validator = Validator::make($request->all(), [
                         'klasifikasi'  => 'required',
                         'nama_objek'   => 'required',
                         'id_kec'       => 'required',
                         'id_kel'       => 'required',
                    ],
                    [
                         'klasifikasi.required'   => 'Klasifikasi tidak boleh kosong!',
                         'nama_objek.required'    => 'Nama Objek tidak boleh kosong!',
                         'id_kec.required'        => 'Kecamatan tidak boleh kosong!',
                         'id_kel.required'        => 'Kelurahan tidak boleh kosong!',
                    ]
               );
               
          
               if ($validator->passes()) {
                    $data                    = new Survey();
                    $data->id                = Uuid::uuid4()->getHex();
                    $data->klasifikasi       = $request->input('klasifikasi');
                    $data->nama_objek        = $request->input('nama_objek');
                    $data->id_kec            = $request->input('id_kec');
                    $data->id_kel            = $request->input('id_kel');
                    $data->alamat            = $request->input('alamat');
                    $data->lat               = $request->input('lat');
                    $data->long              = $request->input('long');
                    $data->id_status_lahan   = $request->input('id_status_lahan');

                    if($request->hasFile('foto'))
                    {
                         $file = $request->file('foto');
                         $file_ext = $file->getClientOriginalExtension();
                         $filename = strtolower(str_replace(' ','_',$request->input('klasifikasi'))).'_'.time().'.'.$file_ext;
                         $file->storeAs('survey', $filename);
                         $data->foto    = $filename;
                    }
                    $data->created_at        = now();
                    
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

     public function ubah(Request $request)
     {
          if($request->input())
          {
               $validator = Validator::make($request->all(), [
                         'klasifikasi'  => 'required',
                         'nama_objek'   => 'required',
                         'id_kec'       => 'required',
                         'id_kel'       => 'required',
                    ],
                    [
                         'klasifikasi.required'   => 'Klasifikasi tidak boleh kosong!',
                         'nama_objek.required'    => 'Nama Objek tidak boleh kosong!',
                         'id_kec.required'        => 'Kecamatan tidak boleh kosong!',
                         'id_kel.required'        => 'Kelurahan tidak boleh kosong!',
                    ]
               );
          
               if ($validator->passes()) {
                    $data                    = Survey::find($request->input('id'));
                    $data->klasifikasi       = $request->input('klasifikasi');
                    $data->nama_objek        = $request->input('nama_objek');
                    $data->id_kec            = $request->input('id_kec');
                    $data->id_kel            = $request->input('id_kel');
                    $data->alamat            = $request->input('alamat');
                    $data->lat               = $request->input('lat');
                    $data->long              = $request->input('long');
                    $data->id_status_lahan   = $request->input('id_status_lahan');
                    if($request->hasFile('foto'))
                    {
                         $file = $request->file('foto');
                         $file_ext = $file->getClientOriginalExtension();
                         $filename = strtolower(str_replace(' ','_',$request->input('klasifikasi'))).'_'.time().'.'.$file_ext;
                         $file->storeAs('survey', $filename);
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

               $data = $this->_validate($validator);
               return response()->json($data);

          }
     }

     public function data($id)
     {
          $data = Survey::where('id', $id)->first();
          return response()->json($data);
     }

     public function hapus(Request $request , $id)
     {
          $data = Survey::find($id);
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

     private function _validate($validator){
          $data = array();
          $data['error_string'] = array();
          $data['input_error'] = array();

          if ($validator->errors()->has('klasifikasi')):
               $data['input_error'][] = 'klasifikasi';
               $data['error_string'][] = $validator->errors()->first('klasifikasi');
               $data['status'] = false;
          endif;

          if ($validator->errors()->has('nama_objek')):
               $data['input_error'][] = 'nama_objek';
               $data['error_string'][] = $validator->errors()->first('nama_objek');
               $data['status'] = false;
           endif;
     
          if ($validator->errors()->has('id_kec')):
               $data['input_error'][] = 'kecamatan';
               $data['error_string'][] = $validator->errors()->first('id_kec');
               $data['status'] = false;
          endif;

          if ($validator->errors()->has('id_kel')):
               $data['input_error'][] = 'kelurahan';
               $data['error_string'][] = $validator->errors()->first('id_kel');
               $data['status'] = false;
          endif;

          return $data;
     }

     public function detail($id)
     {
          $data = Survey::with(['pembangunan.halaman','pembangunan.pagar','pembangunan.saluran'])->findOrFail($id);
          
          return view('pages.survey.detail')->with('data',$data);
     }
}
