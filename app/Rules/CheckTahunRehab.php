<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Rehabilitasi;

class CheckTahunRehab implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    protected $extraParam;

    public function __construct($param)
    {
        $this->extraParam = $param;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $jml = Rehabilitasi::where('id_survey',$this->extraParam)->where('tahun',$value)->count();
        if($jml == 0)
        {
            return true;
        }else{
            return false;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Tahun untuk rehabilitasi sudah terdaftar';
    }
}
