<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RangkaAtap extends Model
{
    use SoftDeletes;

    public $incrementing = false;

    protected $primaryKey = 'id';

    protected $keyType = 'string';

    protected $table = 'master_rangka_atap';

}