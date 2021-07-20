<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\Survey;
use App\Models\Klasifikasi;
use Auth;

class DashboardController extends Controller
{
     public function __construct()
     {
          $this->middleware('auth');
     }

     public function index()
     {
          $user     = User::count();
          $kecamatan = Kecamatan::count();
          $kelurahan = Kelurahan::count();
          $survey   = Survey::with('klasi');
          $klasifikasi = Klasifikasi::orderBy('nama','ASC')->get();

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

          return view('pages.dashboard.index')->with('user',$user)
          ->with('kecamatan',$kecamatan)
          ->with('kelurahan',$kelurahan)
          ->with('data',$data)
          ->with('survey',$survey->count());
     }
}
