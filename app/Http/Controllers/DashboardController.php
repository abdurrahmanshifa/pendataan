<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\Survey;

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
          $survey   = Survey::count();
          
          return view('pages.dashboard.index')->with('user',$user)
          ->with('kecamatan',$kecamatan)
          ->with('kelurahan',$kelurahan)
          ->with('survey',$survey);
     }
}
