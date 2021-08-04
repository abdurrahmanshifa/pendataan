<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function displayFile($dir,$filename)
    {
        $filename=$dir.'/'. $filename;
        return response()->file(storage_path('app/public').'/'.$filename);
    }
    
    public function showImage($folder,$filename)
    {
        return response()->file(storage_path('app/public/'.$folder.'/'.$filename));
    }

    public function displayFiles($dir1,$filename)
    {
        $filename=$dir1.'/'. $filename;
        return response()->file(storage_path('app/public').'/'.$filename);
    }
}
