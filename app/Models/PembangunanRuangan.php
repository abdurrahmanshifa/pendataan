<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PembangunanRuangan extends Model
{
     use SoftDeletes;

     public $incrementing = false;

     protected $primaryKey = 'id';

     protected $keyType = 'string';

     protected $table = 't_pembangunan_ruangan';

     function ruangan()
     {
          return $this->belongsTo('App\Models\Ruangan','id_jenis_ruangan');
     }
}