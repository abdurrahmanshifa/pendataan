<?php
namespace App\Http\Controllers\Master;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Klasifikasi;
use DataTables;
use Validator;
use Ramsey\Uuid\Uuid;

class KlasifikasiController extends Controller
{
     public function __construct()
     {
          $this->middleware('auth');
     }

     public function index(Request $request)
     {
          if ($request->ajax()) {
               $data = Klasifikasi::orderBy('created_at','desc')->get();
               return Datatables::of($data)
                    ->addIndexColumn()
                    ->editColumn('aksi', function($row) {
                         $data = '
                              <a title="Ubah Data" class="btn btn-success btn-sm" onclick="ubah(\''.$row->id.'\')"> <i class="fas fa-edit text-white"></i></a>
                              <a title="Hapus Data" class="btn btn-danger btn-sm" onclick="hapus(\''.$row->id.'\')"> <i class="fas fa-trash-alt text-white"></i></a>
                         ';

                         return $data;
                    })
                    ->escapeColumns([])
                    ->make(true);
          }
          return view('pages.klasifikasi.index');
     }

     public function simpan(Request $request)
     {
          if($request->input())
          {
               $validator = Validator::make($request->all(), [
                         'nama' => 'required',
                    ],
                    [
                         'nama.required' => 'Nama tidak boleh kosong!',
                    ]
               );
               
          
               if ($validator->passes()) {
                    $data = new Klasifikasi();
                    $data->id = Uuid::uuid4()->getHex();
                    $data->nama = $request->input('nama');
                    $data->keterangan = $request->input('keterangan');
                    $data->created_at = now();
                    
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
                         'nama' => 'required',
                    ],
                    [
                         'nama.required' => 'Nama tidak boleh kosong!',
                    ]
               );
          
               if ($validator->passes()) {
                    $data = Klasifikasi::find($request->input('id'));
                    $data->nama = $request->input('nama');
                    $data->keterangan = $request->input('keterangan');
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
          $data = Klasifikasi::where('id', $id)->first();
          return response()->json($data);
     }

     public function hapus(Request $request , $id)
     {
          $data = Klasifikasi::find($id);
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

          if ($validator->errors()->has('nama')):
               $data['input_error'][] = 'nama';
               $data['error_string'][] = $validator->errors()->first('nama');
               $data['status'] = false;
          endif;

          return $data;
     }

}
