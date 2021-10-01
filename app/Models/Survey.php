<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Survey extends Model
{
    use SoftDeletes;

    public $incrementing = false;

    protected $primaryKey = 'id';

    protected $keyType = 'string';

    protected $table = 't_survey';

     function statusLahan()
     {
          return $this->belongsTo('App\Models\StatusLahan','id_status_lahan');
     }

     function kecamatan()
     {
          return $this->belongsTo('App\Models\Kecamatan','id_kec');

     }

     function kelurahan()
     {
          return $this->belongsTo('App\Models\Kelurahan','id_kel');
     }

     function klasi()
     {
          return $this->belongsTo('App\Models\Klasifikasi','klasifikasi');
     }

     function pembangunan()
     {
          return $this->HasOne('App\Models\Pembangunan','id_survey');
     }

     function user()
     {
          return $this->belongsTo('App\Models\User','id_created');
     }

}