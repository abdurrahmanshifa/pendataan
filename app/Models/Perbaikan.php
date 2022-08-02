<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Perbaikan extends Model
{
    use SoftDeletes;

    public $incrementing = false;

    protected $primaryKey = 'id';

    protected $keyType = 'string';

    protected $table = 't_perbaikan';

     function kondisi()
     {
          return $this->BelongsTo('App\Models\Kondisi','id_kondisi');
     }

}