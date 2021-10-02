<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ruangan extends Model
{
    use SoftDeletes;

    public $incrementing = false;

    protected $primaryKey = 'id';

    protected $keyType = 'string';

    protected $table = 'master_ruangan';

    function klasifikasi()
    {
        return $this->belongsTo('App\Models\Klasifikasi','id_klasifikasi');
    }
}