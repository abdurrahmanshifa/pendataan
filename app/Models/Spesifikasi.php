<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Spesifikasi extends Model
{
    use SoftDeletes;

    public $incrementing = false;

    protected $primaryKey = 'id';

    protected $keyType = 'string';

    protected $table = 't_spesifikasi_bangunan';

    public function survey()
    {
        return $this->BelongsTo('App\Models\Survey', 'id_survey');
    }
}