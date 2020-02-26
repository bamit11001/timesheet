<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Countries extends Model
{
    protected $table="countries";
    public function states()
    {
        return $this->hasMany('App\Models\States', 'country_id');
    }
    
    
}
