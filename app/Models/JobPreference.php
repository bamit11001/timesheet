<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobPreference extends Model
{
    //
    protected $table = "job_preference";

    protected $fillable = [
        'user_id','location','industry','job_type'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    

}
