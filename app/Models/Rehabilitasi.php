<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rehabilitasi extends Model
{
    use SoftDeletes;

    public $incrementing = false;

    protected $primaryKey = 'id';

    protected $keyType = 'string';

    protected $table = 't_rehabilitasi';

    function survey()
    {
        return $this->BelongsTo('App\Models\Survey','id_survey');
    }

    function rehabilitasiDetail()
    {
        return $this->HasMany('App\Models\RehabilitasiDetail','id_rehabilitasi');
    }
}