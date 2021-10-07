<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\Survey;
use App\Models\Klasifikasi;
use App\Models\Pembangunan;
use App\Models\StatusLahan;
use Auth;
use DataTables;
use App\Models\Kondisi;

class DashboardController extends Controller
{
     public function __construct()
     {
          $this->middleware('auth');
     }

     public function index(Request $request)
     {
          if ($request->ajax()) {
               $data = Survey::with(['statuslahan','kecamatan','kelurahan','klasi','pembangunan'])->orderBy('created_at','desc');
               if(Auth::user()->group != 1)
               {
                    $data = $data->where('id_created',Auth::user()->id)->get();
               }else{
                    $data = $data->get();
               }
               //echo json_encode($data);
               //exit();
               return Datatables::of($data)
                    ->addIndexColumn()
                    ->editColumn('klasifikasi', function($row) {
                         $data = '<strong>Klasifikasi : '.(isset($row->klasi->nama)?$row->klasi->nama:'-').'</strong><p> <small>Objek : '.$row->nama_objek.'</small></p>';
                         return $data;
                    })
                    ->editColumn('detail', function($row) {
                         $data = '
                              <a href="'.url('survey/detail/'.$row->id).'" title="Detail Data" class="btn btn-warning btn-sm"> <i class="fas fa-eye text-white"></i></a>
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
                    ->editColumn('pembangunan', function($row) {
                         $data = '<strong>Tahun : '.(isset($row->pembangunan->tahun)?$row->pembangunan->tahun:'-').'</strong><p> <strong>Luas : '.(isset($row->pembangunan->luas)?$row->pembangunan->luas:'-').'</strong></p>';
                         return $data;
                    })
                    ->editColumn('titik_lokasi', function($row) {
                         $data = 'Latitude : '.$row->lat.'<br> Longtidue : '.$row->long;
                         return  ucwords(strtolower($data));
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
          $user     = User::count();
          $kecamatan = Kecamatan::count();
          $kelurahan = Kelurahan::count();
          $survey   = Survey::with('klasi');
          $klasifikasi = Klasifikasi::orderBy('nama','ASC')->get();
          $kecamatans = Kecamatan::orderBy('nama_kec','ASC')->get();
          $pembangunan = Pembangunan::all();
          $status_lahan = StatusLahan::all();

          if(Auth::user()->group != 1){
               $survey = Survey::with('klasi')->where('id_created',Auth::user()->id);
          }
          
          $data = array();
          foreach($klasifikasi as $key => $val){
               $data[$key]['klasifikasi'] = $val->nama;
               if (Auth::user()->group != 1) {
                   $jml =  Survey::where('klasifikasi', $val->id)->where('id_created',Auth::user()->id)->count();
               }else{
                   $jml =  Survey::where('klasifikasi', $val->id)->count();
               }
               $data[$key]['jml'] = $jml;
          }
          $data_kec = array();
          foreach($kecamatans as $key => $val){
               $data_kec[$key]['id_kec'] = $val->nama_kec;
               if (Auth::user()->group != 1) {
                   $jml =  Survey::where('id_kec', $val->id)->where('id_created',Auth::user()->id)->count();
               }else{
                   $jml =  Survey::where('id_kec', $val->id)->count();
               }
               $data_kec[$key]['jml'] = $jml;
          }
// echo json_encode($data);
// exit();

          return view('pages.dashboard.index',[
               'surveys'=>Survey::all()
          ])->with('user',$user)
          ->with('kecamatan',$kecamatan)
          ->with('kelurahan',$kelurahan)
          ->with('data',$data)
          ->with('data_kec',$data_kec)
          ->with('pembangunan',$pembangunan)
          ->with('status_lahan',$status_lahan)
          ->with('survey',$survey->count());
     }
}
