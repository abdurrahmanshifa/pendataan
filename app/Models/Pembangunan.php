<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pembangunan extends Model
{
    use SoftDeletes;

    public $incrementing = false;

    protected $primaryKey = 'id';

    protected $keyType = 'string';

    protected $table = 't_pembangunan';

     function survey()
     {
          return $this->BelongsTo('App\Models\Survey','id_survey');
     }

     function halaman()
     {
          return $this->BelongsTo('App\Models\Halaman','id_halaman');
     }

     function pagar()
     {
          return $this->BelongsTo('App\Models\Pagar','id_pagar');
     }

     function saluran()
     {
          return $this->BelongsTo('App\Models\Saluran','id_saluran');
     }

     function ruangan()
     {
          return $this->hasOne('App\Models\PembangunanRuangan','id_pembangunan');
     }

}