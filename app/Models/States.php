<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class States extends Model
{
    protected $table="states";
    public function user()
    {
        return $this->hasMany('App\Models\User', 'state_id');
    }
    
}
