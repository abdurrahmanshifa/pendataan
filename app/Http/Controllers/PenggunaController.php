<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Helpers\DateHelper;
use Illuminate\Support\Facades\Hash;
use DataTables;
use Validator;

class PenggunaController extends Controller
{
     public function __construct()
     {
          $this->middleware('auth');
     }

     public function index(Request $request)
     {
          if ($request->ajax()) {
               $data = User::orderBy('created_at','desc')->get();
               return Datatables::of($data)
                    ->addIndexColumn()
                    ->editColumn('aksi', function($row) {
                         $data = '
                              <a title="Ubah Data" class="btn btn-success btn-sm" onclick="ubah(\''.$row->id.'\')"> <i class="fas fa-edit text-white"></i></a>
                              <a title="Hapus Data" class="btn btn-danger btn-sm" onclick="hapus(\''.$row->id.'\')"> <i class="fas fa-trash-alt text-white"></i></a>
                         ';

                         return $data;
                    })
                    ->editColumn('last_login', function($row) {
                         if($row->last_login_at != null)
                         {
                              $data = DateHelper::tglIndTime($row->last_login_at);
                         }else{
                              $data = '-';
                         }

                         return $data;
                    })
                    ->editColumn('group', function($row) {
                         if($row->group == 0)
                         {
                              $data = '<span class="badge badge-info">Surveyor</span>';
                         }elseif($row->group == 2)
                         {
                              $data = '<span class="badge badge-warning">Dinas</span>';
                         }else{
                              $data = '<span class="badge badge-primary">Administrator</span>';
                         }

                         return $data;
                    })
                    ->escapeColumns([])
                    ->make(true);
          }
          return view('pages.pengguna.index');
     }

     public function simpan(Request $request)
     {
          if($request->input())
          {
               $validator = Validator::make($request->all(), [
                         'nama' => 'required',
                         'email'     => 'required|email|unique:users,email,'.$request->input('id'),
                         'password'  => 'required',
                    ],
                    [
                         'nama.required' => 'Nama tidak boleh kosong!',
                         'email.required'    => 'Alamat email tidak boleh kosong!',
                         'email.email'       => 'Alamat email tidak sesuai!',
                         'email.unique'      => 'Alamat email sudah terdaftar di data kami!',
                         'password.required' => 'Password tidak boleh kosong!',
                    ]
               );
               
          
               if ($validator->passes()) {
                    $data = new User();
                    $data->name = $request->input('nama');
                    $data->email = $request->input('email');
                    $data->group = $request->input('group');
                    $data->password = Hash::make($request->input('password'));
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
                         'email'     => 'required|email|unique:users,email,'.$request->input('id'),
                    ],
                    [
                         'nama.required' => 'Nama tidak boleh kosong!',
                         'email.required'    => 'Alamat email tidak boleh kosong!',
                         'email.email'       => 'Alamat email tidak sesuai!',
                         'email.unique'      => 'Alamat email sudah terdaftar di data kami!',
                    ]
               );
          
               if ($validator->passes()) {
                    $data = User::find($request->input('id'));
                    $data->name = $request->input('nama');
                    $data->email = $request->input('email');
                    $data->group = $request->input('group');
                    if($request->input('password') != null)
                    {
                         $data->password = Hash::make($request->input('password'));
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
          $data = User::where('id', $id)->first();
          return response()->json($data);
     }

     public function hapus(Request $request , $id)
     {
          $data = User::find($id);
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

          if ($validator->errors()->has('email')):
               $data['input_error'][] = 'email';
               $data['error_string'][] = $validator->errors()->first('email');
               $data['status'] = false;
           endif;
     
           if ($validator->errors()->has('password')):
               $data['input_error'][] = 'password';
               $data['error_string'][] = $validator->errors()->first('password');
               $data['status'] = false;
           endif;

          return $data;
     }
}
