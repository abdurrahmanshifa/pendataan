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
use App\Models\Halaman;
use App\Models\Pagar;
use App\Models\Saluran;
use App\Models\PembangunanRuangan;
use App\Helpers\DateHelper;
use Illuminate\Support\Facades\Hash;
use DataTables;
use Validator;
use Ramsey\Uuid\Uuid;

class PembangunanController extends Controller
{
     public function __construct()
     {
          $this->middleware('auth');
     }

     public function index(Request $request,$id)
     {
          if ($request->ajax()) {
               $pembangunan = Pembangunan::select('id','id_survey')->find($id);
               if($pembangunan != null)
               {
                    $data = PembangunanRuangan::where('id_pembangunan',$pembangunan->id)->where('id_survey',$pembangunan->id_survey)
                    ->with(['ruangan'])->orderBy('created_at','desc')->get();     
               }else{
                    $data = array();
               }
               
               return Datatables::of($data)
                    ->addIndexColumn()
                    ->editColumn('ruangan', function($row) {
                         $data = $row->ruangan->nama;
                         return $data;
                    })
                    ->editColumn('luas_ruangan', function($row) {
                         if($row->luas != null)
                         {
                              $data = $row->luas.' m <sup>2</sup>';
                         }else{
                              $data = '-';
                         }
                         return $data;
                    })
                    ->editColumn('media', function($row) {
                         if($row->foto != null):
                              $data = "
                                   <div class='gallery gallery-md text-center'>
                                        <a data-toggle='modal' class='open-AddBookDialog' data-id='".$row->foto."' data-title='".$row->ruangan->nama."' href='#foto-modal'>
                                             <div class='gallery-item' data-title='".$row->ruangan->nama."' style='background-image:url(".url('show-image/jenis-ruangan/'.$row->foto).")'></div>
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
                              <a title="Hapus Data" class="btn btn-danger btn-sm" onclick="hapus(\''.$row->id.'\')"> <i class="fas fa-trash-alt text-white"></i></a>
                         ';

                         return $data;
                    })
                    ->escapeColumns([])
                    ->make(true);
          }
          $data = Pembangunan::with('survey')->where('id_survey',$id)->first();
          if(!$data)
          {
               $pembangunan = New Pembangunan;
               $pembangunan->id = Uuid::uuid4()->getHex();
               $pembangunan->id_survey = $id;
               $pembangunan->created_at = now();
               $pembangunan->save();

               $data = Pembangunan::with('survey')->where('id',$pembangunan->id)->first();
          }
          
          $halaman  = Halaman::get();
          $pagar    = Pagar::get();
          $saluran  = Saluran::get();
          $ruangan  = Ruangan::get();
          return view('pages.pembangunan.index')->with('ruangan',$ruangan)
          ->with('data',$data)
          ->with('halaman',$halaman)
          ->with('pagar',$pagar)
          ->with('saluran',$saluran);
     }

     public function simpan(Request $request)
     {
          if($request->input())
          {
               $validator = Validator::make($request->all(), [
                         'tahun'             => 'required|numeric',
                         'luas'              => 'required|numeric',
                         'jml_lantai'        => 'required|numeric',
                         'luas_halaman'      => 'required|numeric',
                         'panjang_saluran'   => 'required|numeric',
                         'panjang_pagar'     => 'required|numeric'
                    ],
                    [
                         'tahun.required'         => 'Tahun tidak boleh kosong!',
                         'luas.required'          => 'Luas tidak boleh kosong!',
                         'jml_lantai.required'    => 'Jumlah lantai tidak boleh kosong!',
                         'tahun.numeric'          => 'Tahun harus angka!',
                         'luas.numeric'           => 'Luas harus angka!',
                         'jml_lantai.numeric'     => 'Jumlah lantai harus angka!',
                         'luas_halaman.required'  => 'Luas halaman tidak boleh kosong!',
                         'panjang_saluran.required'=> 'Panjang saluran tidak boleh kosong!',
                         'panjang_pagar.required'  => 'Panjang pagar tidak boleh kosong!',
                         'luas_halaman.numeric'  => 'Luas halaman harus angka!',
                         'panjang_saluran.numeric'=> 'Panjang saluran harus angka!',
                         'panjang_pagar.numeric'  => 'Panjang pagar harus angka!',
                         
                    ]
               );
               
          
               if ($validator->passes()) {
                    $data = Pembangunan::find($request->input('id'));

                    $data->tahun       = $request->input('tahun');
                    $data->luas        = $request->input('luas');
                    $data->jml_lantai        = $request->input('jml_lantai');
                    $data->luas_halaman      = $request->input('luas_halaman');
                    $data->panjang_pagar     = $request->input('panjang_pagar');
                    $data->panjang_saluran     = $request->input('panjang_saluran');
                    $data->id_halaman        = $request->input('id_halaman');
                    $data->id_saluran        = $request->input('id_saluran');
                    $data->id_pagar          = $request->input('id_pagar');
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

     public function detail($id)
     {
          $data = Survey::with(['pembangunan'])->findOrFail($id);
          return view('pages.survey.detail')->with('data',$data);
     }

     public function ruangan_simpan(Request $request){
          if($request->input())
          {
               $validator = Validator::make($request->all(), [
                         'jml_ruangan'  => 'required|numeric',
                         'luas'         => 'required',
                    ],
                    [
                         'jml_ruangan.required'   => 'Jumlah ruangan tidak boleh kosong!',
                         'jml_ruangan.numeric'    => 'Jumlah ruangan harus angka!',
                         'luas.required'          => 'Luas ruangan tidak boleh kosong!',
                    ]
               );
               
          
               if ($validator->passes()) {
                    $data                    = new PembangunanRuangan();
                    $data->id                = Uuid::uuid4()->getHex();
                    $data->id_survey         = $request->input('id_survey');
                    $data->id_pembangunan    = $request->input('id_pembangunan');
                    $data->id_jenis_ruangan  = $request->input('id_jenis_ruangan');
                    $data->jml_ruangan       = $request->input('jml_ruangan');
                    $data->luas              = $request->input('luas');

                    if($request->hasFile('foto'))
                    {
                         $file = $request->file('foto');
                         $file_ext = $file->getClientOriginalExtension();
                         $filename = strtolower(str_replace(' ','_',$request->input('id_pembangunan'))).'_'.time().'.'.$file_ext;
                         $file->storeAs('jenis-ruangan', $filename);
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
     public function ruangan_ubah(Request $request){
          if($request->input())
          {
               $validator = Validator::make($request->all(), [
                         'jml_ruangan'  => 'required|numeric',
                         'luas'         => 'required',
                    ],
                    [
                         'jml_ruangan.required'   => 'Jumlah ruangan tidak boleh kosong!',
                         'jml_ruangan.numeric'    => 'Jumlah ruangan harus angka!',
                         'luas.required'          => 'Luas ruangan tidak boleh kosong!',
                    ]
               );
               
          
               if ($validator->passes()) {
                    $data                    = PembangunanRuangan::find($request->input('id'));
                    $data->id_jenis_ruangan  = $request->input('id_jenis_ruangan');
                    $data->jml_ruangan       = $request->input('jml_ruangan');
                    $data->luas              = $request->input('luas');

                    if($request->hasFile('foto'))
                    {
                         $file = $request->file('foto');
                         $file_ext = $file->getClientOriginalExtension();
                         $filename = strtolower(str_replace(' ','_',$request->input('id_pembangunan'))).'_'.time().'.'.$file_ext;
                         $file->storeAs('jenis-ruangan', $filename);
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

     public function ruangan_data($id)
     {
          $data = PembangunanRuangan::where('id', $id)->first();
          return response()->json($data);
     }

     public function ruangan_hapus(Request $request , $id)
     {
          $data = PembangunanRuangan::find($id);
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
