<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Users_Qualification extends Model
{
    //
    protected $table = "users_qualification";

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    

}
