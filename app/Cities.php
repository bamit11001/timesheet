<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cities extends Model
{
    protected $table="cities";
    
    public function cities()
    {
        return $this->hasMany('App\User'); 
    }
}
