<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Model
{
    public static function getuserData(){
        $value=DB::table('find_job')->orderBy('id', 'asc')->get();
        return $value;
      }
      

}
