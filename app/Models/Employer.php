<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\EmployerResetPasswordNotification;


class Employer extends Authenticatable
{
    use Notifiable;
    protected $guard = 'employer';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'phone', 'password', 'is_owner',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Add a mutator to ensure hashed passwords
    */

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }


    public function sendPasswordResetNotification($token)
      {
          $this->notify(new EmployerResetPasswordNotification($token));
      }
    public function company(){
        return $this->belongsTo('App\Models\Company');
    }
}
