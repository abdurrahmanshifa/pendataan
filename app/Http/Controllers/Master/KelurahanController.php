<?php

namespace App\Http\Controllers\Master;
use App\Http\Controllers\Controller;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use DataTables;

use Illuminate\Http\Request;

class KelurahanController extends Controller
{
     public function __construct()
     {
          $this->middleware('auth');
     }

     public function index(Request $request)
     {
          if ($request->ajax()) {
               $data = Kelurahan::with('kecamatan')->orderBy('id_kec','asc')->orderBy('nama_kel','asc')->get();
               return Datatables::of($data)
                    ->addIndexColumn()
                    ->editColumn('kecamatan', function($row) {
                         $data = $row->kecamatan->nama_kec;
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
          return view('pages.kelurahan.index');
     }
}
