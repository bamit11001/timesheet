<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Countries extends Model
{
   

    protected $table="countries";
    
    public function user()
    {
        return $this->hasMany('App\User');
    }
}
