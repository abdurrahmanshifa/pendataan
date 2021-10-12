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
use App\Models\Perbaikan;
use App\Models\SurveyValidasi;
use App\Models\Satuan;
use App\Helpers\DateHelper;
use Illuminate\Support\Facades\Hash;
use DataTables;
use Validator;
use Ramsey\Uuid\Uuid;
use Auth;
use Str;
use Image;


class KerusakanController extends Controller
{
     public function __construct()
     {
          $this->middleware('auth');
     }

     public function index(Request $request)
     {
          if ($request->ajax()) {
               $tahun = $_GET['filter']['tahun'];
               $data = Survey::with(['statuslahan','kecamatan','kelurahan','klasi','perbaikan.kondisi',
                    'pembangunan'=> function ($query) use ($tahun){
                         if($tahun != ''){
                              $query->where('tahun', $tahun);
                         }
                    },
                    'kondisi' => function ($query) {
                         $query->where('kondisi', 'Ada Kerusakaan');
                    }
               ])->orderBy('id_kec','asc')->orderBy('id_kel','asc');
               
               if($_GET['filter']['kec'] != ''){
                    $data = $data->where('id_kec',$_GET['filter']['kec']);
               }

               if($_GET['filter']['kel'] != ''){
                    $data = $data->where('id_kel',$_GET['filter']['kel']);
               }

               if($_GET['filter']['kla'] != ''){
                    $data = $data->where('klasifikasi',$_GET['filter']['kla']);
               }

               if(Auth::user()->group != 1)
               {
                    $data = $data->where('id_created',Auth::user()->id)->get();
               }else{
                    $data = $data->get();
               }
               $result = array();
               $i=0;
               foreach($data as $idx => $itm)
               {
                    if(isset($itm->pembangunan->id) AND !$itm->kondisi->isEmpty())
                    {
                         $result[$i] = $itm;
                         $i++;
                    }
                    
               }
               // echo json_encode($result);
               // exit();
               return Datatables::of($result)
                    ->addIndexColumn()
                    // ->editColumn('kelengkapan', function($row) {
                    //      $persen = 0;

                    //      $kondisi = Kondisi::where('id_survey',$row->id)->count();
                    //      $persen = $persen + $this->check15($kondisi);

                    //      $pembangunan = Pembangunan::where('id_survey',$row->id)->count();
                    //      $persen = $persen + $this->check10($pembangunan);

                    //      $pembangunanDetail = PembangunanRuangan::where('id_survey',$row->id)->count();
                    //      $persen = $persen + $this->check10($pembangunanDetail);

                    //      $Rehabilitasi = Rehabilitasi::where('id_survey',$row->id)->count();
                    //      $persen = $persen + $this->check10($Rehabilitasi);

                    //      $RehabilitasiDetail = RehabilitasiDetail::where('id_survey',$row->id)->count();
                    //      $persen = $persen + $this->check10($RehabilitasiDetail);

                    //      $sitePlan = SitePlan::where('id_survey',$row->id)->count();
                    //      $persen = $persen + $this->check15($sitePlan);

                    //      $spesifikasi = Spesifikasi::where('id_survey',$row->id)->count();
                    //      $persen = $persen + $this->check15($spesifikasi);

                    //      $validasi = SurveyValidasi::where('id_survey',$row->id)->count();
                    //      $persen = $persen + $this->check15($validasi);

                    //      if($persen <= 40)
                    //      {
                    //           $status = 'bg-danger';
                    //      }else if($persen <= 70)
                    //      {
                    //           $status = 'bg-warning';
                    //      }else{
                    //           $status = 'bg-success';
                    //      }
                    //      if($persen == 0)
                    //      {
                    //           $jarak = 100;
                    //      }else{
                    //           $jarak = $persen;
                    //      }
                    //      $data = '
                    //           <div class="progress mb-3">
                    //                <div class="progress-bar '.$status.'" role="progressbar" data-width="'.$persen.'%" aria-valuenow="'.$persen.'" aria-valuemin="0" aria-valuemax="100" style="width:'.$jarak.'%">'.$persen.'%</div>
                    //           </div>
                    //      ';

                    //      return $data;
                    // })
                    ->editColumn('aksi', function($row) {
                         $data = '
                              <a href="'.url('kerusakan/detail/'.$row->id).'" title="Detail Data" class="btn btn-warning btn-sm"> <i class="fas fa-eye text-white"></i></a>
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
                    ->editColumn('klasifikasi', function($row) {
                         $data = '<strong>Klasifikasi : '.(isset($row->klasi->nama)?$row->klasi->nama:'-').'</strong><p> <small>Objek : '.$row->nama_objek.'</small></p>';
                         return $data;
                    })
                    ->editColumn('pembangunan', function($row) {
                         $data = '<strong>Tahun : '.(isset($row->pembangunan->tahun)?$row->pembangunan->tahun:'-').'</strong><p> <strong>Luas : '.(isset($row->pembangunan->luas)?$row->pembangunan->luas:'-').'</strong></p>';
                         return $data;
                    })
                    ->editColumn('kerusakan', function($row) {
                         $data = '';
                         foreach($row->kondisi as $val)
                         {
                              $data .= ucwords(strtolower($val->nama)).' - '.$val->luas.'<br>';
                         }
                         return $data;
                    })
                    ->editColumn('perbaikan', function($row) {
                         $data = '';
                         foreach($row->perbaikan as $val)
                         {
                              $data .= ucwords(strtolower($val->kondisi->nama)).' - '.$val->luas.' '.$val->satuan.'<br>';
                         }
                         return $data;
                    })
                    ->editColumn('media', function($row) {
                         if($row->foto != null):
                              $data = "
                                   <div class='gallery gallery-md text-center'>
                                        <a data-toggle='modal' class='open-AddBookDialog' data-id='".url('show-image/survey/'.$row->foto)."' data-title='".$row->nama_objek."' href='#foto-modal'>
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

          return view('pages.kerusakan.index')->with('kecamatan',$kecamatan)->with('status_lahan',$statuslahan)->with('klasifikasi',$klasifikasi);
     }

     public function detail(Request $request, $id)
     {
          if ($request->ajax()) {
               if(isset($_GET['filter']['tahun']))
               {
                    $tahun = $_GET['filter']['tahun'];
               }else{
                    $tahun = date('Y');
               }
               $data = Kondisi::where('id_survey',$id)->where('kondisi', 'Ada Kerusakaan')->where('tahun',$tahun)->orderBy('urutan','asc')->get();  
               
               return Datatables::of($data)
                    ->addIndexColumn()
                    ->editColumn('foto_kondisi', function($row) {
                         if($row->foto_kondisi != null):
                              $data = "
                                   <div class='gallery gallery-md text-center'>
                                        <a data-toggle='modal' class='open-AddBookDialog' data-id='".url('show-image/kondisi/'.$row->foto_kondisi)."' data-title='".$row->nama."<br> Kondisi : ".$row->kondisi."' href='#foto-modal'>
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
                                        <a data-toggle='modal' class='open-AddBookDialog' data-id='".url('show-image/luas-kondisi/'.$row->foto_luas)."' data-title='".$row->nama."<br> Luas : ".$row->luas."' href='#foto-modal'>
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
                              <a title="Perbaiki" class="btn btn-success btn-sm" onclick="ubah_kondisi(\''.$row->id_survey.'\',\''.$row->tahun.'\')"> <i class="fas fa-tools text-white"></i></a>
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
          $data = Survey::with(['klasi','kecamatan','kelurahan','statusLahan','pembangunan.halaman','pembangunan.pagar','pembangunan.saluran',
               'kondisi' => function ($query) {
                    $query->where('kondisi', 'Ada Kerusakaan');
               }
          ])->findOrFail($id);
          $kondisi_tahun = Kondisi::select('tahun')->distinct()->where('id_survey',$id)->get(); 
          $satuan = Satuan::get();
          // echo json_encode($data);
          // exit();  
          return view('pages.kerusakan.detail',compact('data','kondisi_tahun','satuan'));
     }

     public function data($id)
     {
          $data = Perbaikan::where('id', $id)->first();
          return response()->json($data);
     }

     public function riwayat(Request $request,$id)
     {
         if ($request->ajax()) {
             $tahun = $_GET['filter']['tahun'];

             $data = Perbaikan::with(['kondisi'])->where('id_survey',$id)->orderBy('created_at', 'asc')->get();

             return Datatables::of($data)
                    ->addIndexColumn()
                    ->editColumn('aksi', function ($row) {
                        $data = '
                              <a title="Ubah Data" class="btn btn-success btn-sm" onclick="ubah(\''.$row->id.'\')"> <i class="fas fa-edit text-white"></i></a>
                              <a title="Hapus Data" class="btn btn-danger btn-sm" onclick="hapus(\''.$row->id.'\')"> <i class="fas fa-trash-alt text-white"></i></a>
                         ';

                        return $data;
                    })
                    ->editColumn('jenis', function ($row) {
                        return  $row->kondisi->nama;
                    })
                    ->editColumn('tahun', function ($row) {
                        $data = $row->tahun;
                        return $data;
                    })
                    ->editColumn('luas', function ($row) {
                        $data = $row->luas.' '.$row->satuan;
                        return $data;
                    })
                    ->editColumn('media', function ($row) {
                        if ($row->foto_perbaikan != null):
                              $data = "
                                   <div class='gallery gallery-md text-center'>
                                        <a data-toggle='modal' class='open-AddBookDialog' data-id='".url('show-image/perbaikan/'.$row->foto_perbaikan)."' data-title='".$row->kondisi->nama."' href='#foto-modal'>
                                             <div class='gallery-item' data-title='".$row->kondisi->nama."' style='background-image:url(".url('show-image/perbaikan/'.$row->foto_perbaikan).")'></div>
                                        </a>
                                   </div>
                              "; else:
                              $data = '-';
                        endif;

                        return $data;
                    })
                    ->escapeColumns([])
                    ->make(true);
         }
     }

     public function simpan(Request $request)
     {
          if($request->input('id_perbaikan')){
               $data                    = Perbaikan::find($request->input('id_perbaikan'));
               $data->tahun             = $request->input('tahun_edit');
               $data->id_kondisi        =  $request->input('jenis_edit');;
               $data->satuan            = $request->input('satuan_edit');
               $data->luas             = $request->input('luas_edit');
               
               if($request->hasFile('foto_kondisi_edit'))
               {
                    $file = $request->file('foto_kondisi_edit');
                    $file_ext = $file->getClientOriginalExtension();
                    $filename = strtolower(str_replace(' ','_',$request->input('id_perbaikan'))).'_'.Str::random(10).'.'.$file_ext;
                    $img = Image::make($file->path());
                    $img->resize(600, null, function ($constraint) {
                         $constraint->aspectRatio();
                    })->save(storage_path('app/public/perbaikan').'/'. $filename);
                    //$file->storeAs('kondisi', $filename);
                    $data->foto_perbaikan    = $filename;
               }

               $data->updated_at        = now();
               $save = $data->save();

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

          if($request->input())
          {
               $validator = Validator::make($request->all(), [
                         'tahun'  => 'required',
                         'luas'  => 'required',
                    ],
                    [
                         'tahun.required'   => 'Tahun tidak boleh kosong!',
                         'luas.required'   => 'Luas tidak boleh kosong!',
                    ]
               );
               
          
               if ($validator->passes()) {
                    foreach($request->input('jenis') as $key => $val)
                    {
                         $data = new Perbaikan();
                         $id                      = Uuid::uuid4()->getHex();
                         $data->id                = $id;
                         $data->id_survey         = $request->input('id_survey');
                         $data->tahun             = $request->input('tahun')[$key];
                         $data->id_kondisi        = $val;
                         $data->satuan            = $request->input('satuan')[$key];
                         $data->luas             = $request->input('luas')[$key];
                         
                         if(isset($request->file('foto_kondisi')[$key]))
                         {
                              $file = $request->file('foto_kondisi')[$key];
                              $file_ext = $file->getClientOriginalExtension();
                              $filename = strtolower(str_replace(' ','_',$id)).'_'.Str::random(10).'.'.$file_ext;
                              $img = Image::make($file->path());
                              $img->resize(600, null, function ($constraint) {
                                   $constraint->aspectRatio();
                              })->save(storage_path('app/public/perbaikan').'/'. $filename);
                              //$file->storeAs('kondisi', $filename);
                              $data->foto_perbaikan    = $filename;
                         }

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

     public function hapus(Request $request , $id)
     {
          $data = Perbaikan::find($id);
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

          if ($validator->errors()->has('tahun')):
               $data['input_error'][] = 'tahun';
               $data['error_string'][] = $validator->errors()->first('tahun');
               $data['status'] = false;
          endif;

          if ($validator->errors()->has('luas')):
               $data['input_error'][] = 'luas';
               $data['error_string'][] = $validator->errors()->first('luas');
               $data['status'] = false;
          endif;

          return $data;
     }
}
