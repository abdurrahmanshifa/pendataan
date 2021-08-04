<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Survey;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\Atap;
use App\Models\Dinding;
use App\Models\Kusen;
use App\Models\Lantai;
use App\Models\Plafond;
use App\Models\RangkaAtap;
use App\Models\StatusLahan;
use App\Models\SitePlan;
use App\Models\Halaman;
use App\Models\Pagar;
use App\Models\Saluran;
use App\Models\Kondisi;
use App\Models\Pembangunan;
use App\Models\PembangunanRuangan;
use App\Models\Rehabilitasi;
use App\Models\RehabilitasiDetail;
use App\Models\Spesifikasi;
use App\Models\Klasifikasi;
use App\Models\SurveyValidasi;
use App\Helpers\DateHelper;
use Illuminate\Support\Facades\Hash;
use DataTables;
use Validator;
use Ramsey\Uuid\Uuid;
use Auth;
use Str;
use Image;


class SurveyController extends Controller
{
     public function __construct()
     {
          $this->middleware('auth');
     }

     private function check15($jml)
     {
          if($jml != 0)
          {
               return 15;
          }else{
               return 0;
          }
     }

     private function check10($jml)
     {
          if($jml != 0)
          {
               return 10;
          }else{
               return 0;
          }
     }

     public function index(Request $request)
     {
          if ($request->ajax()) {
               $data = Survey::with(['statuslahan','kecamatan','kelurahan','klasi','user'])->orderBy('created_at','desc');
               if(Auth::user()->group != 1)
               {
                    $data = $data->where('id_created',Auth::user()->id)->get();
               }else{
                    $data = $data->get();
               }
               // echo json_encode($data);
               // exit();
               return Datatables::of($data)
                    ->addIndexColumn()
                    ->editColumn('ket', function($row) {
                         $data = '<strong>Klasifikasi : '.(isset($row->klasi->nama)?$row->klasi->nama:'-').'</strong><p> <small>Objek : '.$row->nama_objek.'</small></p>';
                         return $data;
                    })
                    ->editColumn('detail', function($row) {
                         $data = '
                              <a href="'.url('survey/detail/'.$row->id).'" title="Detail Data" class="btn btn-warning btn-sm"> <i class="fas fa-eye text-white"></i></a>
                         ';

                         return $data;
                    })
                    ->editColumn('kelengkapan', function($row) {
                         $persen = 0;

                         $kondisi = Kondisi::where('id_survey',$row->id)->count();
                         $persen = $persen + $this->check15($kondisi);

                         $pembangunan = Pembangunan::where('id_survey',$row->id)->count();
                         $persen = $persen + $this->check10($pembangunan);

                         $pembangunanDetail = PembangunanRuangan::where('id_survey',$row->id)->count();
                         $persen = $persen + $this->check10($pembangunanDetail);

                         $Rehabilitasi = Rehabilitasi::where('id_survey',$row->id)->count();
                         $persen = $persen + $this->check10($Rehabilitasi);

                         $RehabilitasiDetail = RehabilitasiDetail::where('id_survey',$row->id)->count();
                         $persen = $persen + $this->check10($RehabilitasiDetail);

                         $sitePlan = SitePlan::where('id_survey',$row->id)->count();
                         $persen = $persen + $this->check15($sitePlan);

                         $spesifikasi = Spesifikasi::where('id_survey',$row->id)->count();
                         $persen = $persen + $this->check15($spesifikasi);

                         $validasi = SurveyValidasi::where('id_survey',$row->id)->count();
                         $persen = $persen + $this->check15($validasi);

                         if($persen <= 40)
                         {
                              $status = 'bg-danger';
                         }else if($persen <= 70)
                         {
                              $status = 'bg-warning';
                         }else{
                              $status = 'bg-success';
                         }
                         if($persen == 0)
                         {
                              $jarak = 100;
                         }else{
                              $jarak = $persen;
                         }
                         $data = '
                              <div class="progress mb-3">
                                   <div class="progress-bar '.$status.'" role="progressbar" data-width="'.$persen.'%" aria-valuenow="'.$persen.'" aria-valuemin="0" aria-valuemax="100" style="width:'.$jarak.'%">'.$persen.'%</div>
                              </div>
                         ';

                         return $data;
                    })
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
                    ->editColumn('petugas', function($row) {
                         if(isset($row->user->name))
                         {
                              $data = "<span style='font-size:10px;' class='badge badge-primary'>".$row->user->name."</span>";
                         }else{
                              $data = "<span style='font-size:10px;' class='badge badge-danger'>-</span>";
                         }
                         return $data;
                    })
                    ->editColumn('klasifikasi', function($row) {
                         $data = '<strong>Klasifikasi : '.(isset($row->klasi->nama)?$row->klasi->nama:'-').'</strong><p> <small>Objek : '.$row->nama_objek.'</small></p>';
                         return $data;
                    })
                    ->editColumn('media', function($row) {
                         if($row->foto != null):
                              $data = "
                                   <div class='gallery gallery-md text-center'>
                                        <a data-toggle='modal' class='open-AddBookDialog' data-id='".$row->foto."' data-title='".$row->nama_objek."' href='#foto-modal'>
                                             <div class='gallery-item' data-title='".$row->nama_objek."' style='background-image:url(".url('show-image/survey/'.$row->foto).")'></div>
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

          $klasifikasi   = Klasifikasi::get();
          $kecamatan     = Kecamatan::orderBy('nama_kec','asc')->get();
          $statuslahan   = StatusLahan::orderBy('created_at','asc')->get();

          return view('pages.survey.index')->with('kecamatan',$kecamatan)->with('status_lahan',$statuslahan)->with('klasifikasi',$klasifikasi);
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
                         'alamat'       => 'required',
                         'lat'       => 'required',
                         'long'       => 'required',
                         'foto'       => 'required|mimes:jpeg,png|max:2048',
                    ],
                    [
                         'klasifikasi.required'   => 'Klasifikasi tidak boleh kosong!',
                         'nama_objek.required'    => 'Nama Objek tidak boleh kosong!',
                         'id_kec.required'        => 'Kecamatan tidak boleh kosong!',
                         'id_kel.required'        => 'Kelurahan tidak boleh kosong!',
                         'alamat.required'        => 'Alamat tidak boleh kosong!',
                         'lat.required'           => 'Latitude tidak boleh kosong!',
                         'long.required'          => 'Longtitude tidak boleh kosong!',
                         'foto.required'          => 'Foto tidak boleh kosong!',
                    ]
               );
               
          
               if ($validator->passes()) {
                    $id = Uuid::uuid4()->getHex();
                    $data                    = new Survey();
                    $data->id                = $id;
                    $data->klasifikasi       = $request->input('klasifikasi');
                    $data->nama_objek        = $request->input('nama_objek');
                    $data->id_kec            = $request->input('id_kec');
                    $data->id_kel            = $request->input('id_kel');
                    $data->alamat            = $request->input('alamat');
                    $data->lat               = $request->input('lat');
                    $data->long              = $request->input('long');
                    $data->id_status_lahan   = $request->input('id_status_lahan');
                    $data->id_created        = Auth::user()->id;

                    if($request->hasFile('foto'))
                    {
                         $file = $request->file('foto');
                         $file_ext = $file->getClientOriginalExtension();
                         $filename = $id.'_'.Str::random(10).'.'.$file_ext;
                         $img = Image::make($file->path());
                         $img->resize(600, null, function ($constraint) {
                              $constraint->aspectRatio();
                         })->save(storage_path('app/public/survey').'/'. $filename);
                         //$file->storeAs('survey', $filename);
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
                    $data->id_updated        = Auth::user()->id;

                    if($request->hasFile('foto'))
                    {
                         $file = $request->file('foto');
                         $file_ext = $file->getClientOriginalExtension();
                         $filename = $request->input('id').'_'.Str::random(10).'.'.$file_ext;
                         $img = Image::make($file->path());
                         $img->resize(600, null, function ($constraint) {
                              $constraint->aspectRatio();
                         })->save(storage_path('app/public/survey').'/'. $filename);
                         //$file->storeAs('survey', $filename);
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
               $data['input_error'][] = 'id_klasifikasi';
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

          if ($validator->errors()->has('alamat')):
               $data['input_error'][] = 'alamat';
               $data['error_string'][] = $validator->errors()->first('alamat');
               $data['status'] = false;
          endif;

          if ($validator->errors()->has('lat')):
               $data['input_error'][] = 'lat';
               $data['error_string'][] = $validator->errors()->first('lat');
               $data['status'] = false;
          endif;

          if ($validator->errors()->has('long')):
               $data['input_error'][] = 'long';
               $data['error_string'][] = $validator->errors()->first('long');
               $data['status'] = false;
          endif;

          if ($validator->errors()->has('foto')):
               $data['input_error'][] = 'foto';
               $data['error_string'][] = $validator->errors()->first('foto');
               $data['status'] = false;
          endif;

          return $data;
     }

     public function detail($id)
     {
          $data = Survey::with(['pembangunan.halaman','pembangunan.pagar','pembangunan.saluran','klasi'])->findOrFail($id);
          $atap = Atap::get();
          $dinding = Dinding::get();
          $kusen = Kusen::get();
          $lantai = Lantai::get();
          $plafond = Plafond::get();
          $halaman  = Halaman::get();
          $pagar    = Pagar::get();
          $saluran  = Saluran::get();
          $rangkaAtap = RangkaAtap::get();
          $rehabilitasi = Rehabilitasi::where('id_survey',$id)->get();
          $spesifikai = Spesifikasi::where('id_survey',$id)->get();
          $sitePlan =    SitePlan::where('id_survey',$id)->first();
          $validasi =    SurveyValidasi::where('id_survey',$id)->first();
          
          return view('pages.survey.detail',compact('data','atap','dinding','kusen','lantai','plafond','rangkaAtap','spesifikai','sitePlan','rehabilitasi','halaman','pagar','saluran','validasi'));
     }
}
