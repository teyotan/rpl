<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RawMaterial extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Check if the threshold is null
     *
     * @param  int  $value
     * @return void
     */
    public function setThresholdAttribute($value)
    {
        $this->attributes['threshold'] = $value ?: null;
    }

    /**
     * Set the unit to all lowercase
     *
     * @param  int  $value
     * @return void
     */
    public function setUnitAttribute($value)
    {
        $temp = $value;

        if(!(ctype_upper($value[0]) && ctype_lower($value[1]))){
           $temp = strtolower($value);
        }

        $this->attributes['unit'] = $temp;
    }

    /**
     * Set the name to Uppercase for the first letter
     *
     * @param  int  $value
     * @return void
     */
    public function setMaterialNameAttribute($value)
    {
        $this->attributes['material_name'] = ucwords(strtolower($value));
    }
}
