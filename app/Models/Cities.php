<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cities extends Model
{
    protected $table="cities";
    // public function area()
    // {
    //     return $this->hasMany('App\Area');
    // }
    public function cities()
    {
        return $this->hasMany('App\User');
    }
    
}
