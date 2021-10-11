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
use Str;
use Image;

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
                         $data = $row->nama;
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
                                        <a data-toggle='modal' class='zoom' data-id='".url('show-image/jenis-ruangan/'.$row->foto)."' data-title='".$row->nama."' href='#foto-modal'>
                                             <div class='gallery-item' data-title='".$row->nama."' style='background-image:url(".url('show-image/jenis-ruangan/'.$row->foto).")'></div>
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
                    $data = new Pembangunan;
                    $data->id                = Uuid::uuid4()->getHex();
                    $data->created_at        = now();
                    $data->id_survey             = $request->input('id_survey');
                    $data->tahun             = $request->input('tahun');
                    $data->luas              = $request->input('luas');
                    $data->jml_lantai        = $request->input('jml_lantai');
                    $data->luas_halaman      = $request->input('luas_halaman');
                    $data->panjang_pagar     = $request->input('panjang_pagar');
                    $data->panjang_saluran   = $request->input('panjang_saluran');
                    $data->id_halaman        = $request->input('id_halaman');
                    $data->id_saluran        = $request->input('id_saluran');
                    $data->id_pagar          = $request->input('id_pagar');
                    $data->save();

                    foreach($request->input('id_jenis_ruangan') as $key => $val)
                    {
                         $id = Uuid::uuid4()->getHex();
                         $ruangan                    = new PembangunanRuangan();
                         $ruangan->id                = $id;
                         $ruangan->id_survey         = $request->input('id_survey');;
                         $ruangan->id_pembangunan    = $data->id;
                         $ruangan->nama  = $val;
                         $ruangan->jml_ruangan       = $request->input('jml_ruangan')[$key];
                         $ruangan->luas              = $request->input('luas_ruangan')[$key];

                         if(isset($request->file('foto')[$key]))
                         {
                              $file = $request->file('foto')[$key];
                              $file_ext = $file->getClientOriginalExtension();
                              $filename = strtolower(str_replace(' ','_',$data->id)).'_'.Str::random(7).'.'.$file_ext;

                              $img = Image::make($file->path());
                              $img->resize(600, null, function ($constraint) {
                                   $constraint->aspectRatio();
                              })->save(storage_path('app/public/jenis-ruangan').'/'. $filename);
                              //$file->storeAs('jenis-ruangan', $filename);
                              $ruangan->foto    = $filename;
                         }

                         $ruangan->created_at        = now();
                         $save = $ruangan->save();
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
                    $data = Pembangunan::find($request->input('id_pembangunan'));
                    $data->updated_at        = now();
                    $data->tahun             = $request->input('tahun');
                    $data->luas              = $request->input('luas');
                    $data->jml_lantai        = $request->input('jml_lantai');
                    $data->luas_halaman      = $request->input('luas_halaman');
                    $data->panjang_pagar     = $request->input('panjang_pagar');
                    $data->panjang_saluran   = $request->input('panjang_saluran');
                    $data->id_halaman        = $request->input('id_halaman');
                    $data->id_saluran        = $request->input('id_saluran');
                    $data->id_pagar          = $request->input('id_pagar');
                    $data->save();

                    PembangunanRuangan::where('id_pembangunan',$request->input('id_pembangunan'))->delete();
                    foreach($request->input('id_jenis_ruangan') as $key => $val)
                    {
                         $id = Uuid::uuid4()->getHex();
                         $ruangan                    = new PembangunanRuangan();
                         $ruangan->id                = $id;
                         $ruangan->id_survey         = $request->input('id_survey');;
                         $ruangan->id_pembangunan    = $data->id;
                         $ruangan->nama  = $val;
                         $ruangan->jml_ruangan       = $request->input('jml_ruangan')[$key];
                         $ruangan->luas              = $request->input('luas_ruangan')[$key];

                         if(isset($request->file('foto')[$key]))
                         {
                              $file = $request->file('foto')[$key];
                              $file_ext = $file->getClientOriginalExtension();
                              $filename = strtolower(str_replace(' ','_',$id)).'_'.Str::random(7).'.'.$file_ext;

                              $img = Image::make($file->path());
                              $img->resize(600, null, function ($constraint) {
                                   $constraint->aspectRatio();
                              })->save(storage_path('app/public/jenis-ruangan').'/'. $filename);
                              //$file->storeAs('jenis-ruangan', $filename);
                              $ruangan->foto    = $filename;
                         }else{
                              $ruangan->foto    = $request->input('foto_lama')[$key];
                         }

                         $ruangan->created_at        = now();
                         $save = $ruangan->save();
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
          $data = Pembangunan::with(['ruangan'])->findOrFail($id);
          return response()->json($data);
     }

}

