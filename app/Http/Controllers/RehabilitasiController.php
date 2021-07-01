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

class RehabilitasiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

     public function index(Request $request, $id)
     {
          if ($request->ajax()) {
               $data = Rehabilitasi::where('id_survey',$id)->orderBy('created_at', 'asc')->get();
               
               return Datatables::of($data)
                    ->addIndexColumn()
                    ->editColumn('nama', function ($row) {
                        $data = 'Rehabilitasi Ke '.$row->urutan;
                        return $data;
                    })
                    ->editColumn('aksi', function ($row) {
                        $data = '
                              <a title="Lihat Data" class="btn btn-warning btn-sm" href="'.route('rehabilitasi',['id' => $row->id]).'"> 
                                   <i class="fas fa-eye text-white"></i>
                              </a>
                              <a title="Ubah Data" class="btn btn-success btn-sm" onclick="ubah_rehabilitasi(\''.$row->id.'\')"> <i class="fas fa-edit text-white"></i></a>
                              <a title="Hapus Data" class="btn btn-danger btn-sm" onclick="hapus_rehabilitasi(\''.$row->id.'\')"> <i class="fas fa-trash-alt text-white"></i></a>
                         ';

                        return $data;
                    })
                    ->escapeColumns([])
                    ->make(true);
          }

          $data = Rehabilitasi::with('survey')->findOrFail($id);

          return view('pages.rehabilitasi.index')->with('data', $data);
     }

     public function simpan(Request $request)
     {
          if($request->input())
          {
               $validator = Validator::make($request->all(), [
                         'tahun'             => 'required',
                         'sumber_anggaran'   => 'required',
                    ],
                    [
                         'tahun.required'              => 'Tahun tidak boleh kosong!',
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
                    'tahun'             => 'required',
                    'sumber_anggaran'   => 'required',
               ],
               [
                    'tahun.required'              => 'Tahun tidak boleh kosong!',
                    'sumber_anggaran.required'    => 'Sumber anggaran tidak boleh kosong!',
               ]
          );
          
               if ($validator->passes()) {
                    $data                    = Rehabilitasi::find($request->input('id_rehabilitasi'));
                    $data->tahun             = $request->input('tahun');
                    $data->sumber_anggaran   = $request->input('sumber_anggaran');
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
          $data = Rehabilitasi::where('id', $id)->first();
          return response()->json($data);
     }

     public function hapus(Request $request , $id)
     {
          $data = Rehabilitasi::find($id);
          if($data->delete()){
               RehabilitasiDetail::where('id_rehabilitasi',$id)->delete();

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

     public function rehabilitasi_detail(Request $request, $id)
     {
          if ($request->ajax()) {
               $data = RehabilitasiDetail::where('id_rehabilitasi',$id)->orderBy('created_at', 'asc')->get();
               
               return Datatables::of($data)
                    ->addIndexColumn()
                    ->editColumn('media', function($row) {
                         if($row->foto != null):
                              $data = "
                                   <div class='gallery gallery-md text-center'>
                                        <a data-toggle='modal' class='open-AddBookDialog' data-id='".$row->foto."' data-title='".$row->nama."' href='#foto-modal'>
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
                              <a title="Ubah Data" class="btn btn-success btn-sm" onclick="ubah(\''.$row->id.'\')"> <i class="fas fa-edit text-white"></i></a>
                              <a title="Hapus Data" class="btn btn-danger btn-sm" onclick="hapus(\''.$row->id.'\')"> <i class="fas fa-trash-alt text-white"></i></a>
                         ';

                        return $data;
                    })
                    ->escapeColumns([])
                    ->make(true);
          }
     }
     
     public function simpan_detail(Request $request){
          if($request->input())
          {
               $validator = Validator::make($request->all(), [
                         'nama'    => 'required',
                         'luas'         => 'required',
                         'nama_lain'    => 'required_if:nama,==,lain',
                    ],
                    [
                         'luas.required'          => 'Luas tidak boleh kosong!',
                         'nama_lain.required_if'     => 'Nama tidak boleh kosong!',
                    ]
               );
               
          
               if ($validator->passes()) {
                    $data                    = new RehabilitasiDetail();
                    $data->id                = Uuid::uuid4()->getHex();
                    $data->id_survey         = $request->input('id_survey');
                    $data->id_rehabilitasi   = $request->input('id_rehabilitasi');
                    if($request->input('nama') == 'lain')
                    {
                         $data->nama  = $request->input('nama_lain');
                    }else{
                         $data->nama  = $request->input('nama');
                    }
                    $data->luas              = $request->input('luas');

                    if($request->hasFile('foto'))
                    {
                         $file = $request->file('foto');
                         $file_ext = $file->getClientOriginalExtension();
                         $filename = strtolower(str_replace(' ','_',$request->input('id_rehabilitasi'))).'_'.time().'.'.$file_ext;
                         $file->storeAs('rehabilitasi-detail', $filename);
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
     public function ubah_detail(Request $request){
          if($request->input())
          {
               $validator = Validator::make($request->all(), [
                         'nama'    => 'required',
                         'luas'         => 'required',
                         'nama_lain'    => 'required_if:nama,==,lain',
                    ],
                    [
                         'luas.required'          => 'Luas tidak boleh kosong!',
                         'nama_lain.required_if'     => 'Nama tidak boleh kosong!',
                    ]
               );
               
          
               if ($validator->passes()) {
                    $data                    = RehabilitasiDetail::find($request->input('id'));
                    if($request->input('nama') == 'lain')
                    {
                         $data->nama  = $request->input('nama_lain');
                    }else{
                         $data->nama  = $request->input('nama');
                    }
                    $data->luas              = $request->input('luas');

                    if($request->hasFile('foto'))
                    {
                         $file = $request->file('foto');
                         $file_ext = $file->getClientOriginalExtension();
                         $filename = strtolower(str_replace(' ','_',$request->input('id_rehabilitasi'))).'_'.time().'.'.$file_ext;
                         $file->storeAs('rehabilitasi-detail', $filename);
                         $data->foto    = $filename;
                    }
                    $data->updated_at        = now();
                    
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

     public function data_detail($id)
     {
          $data = RehabilitasiDetail::where('id', $id)->first();
          return response()->json($data);
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