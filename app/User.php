<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','slug','email','status', 'password','country','username','mobile', 'address', 'city','state','refno','group_name' ,'register','candidate_name','country','qualification','university','job_experience','previous_company_name','contact_details','company_address','skills','working_hours','preferred_job_location','job_profile','name_of_company','nature_of_business','company_turnover','number_of_employees','working_days','min_salary','max_salary','current_salary','created_at','profile_img','updated_at',
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
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];  
     protected $table='users';

    public function users_skill()
    {
        return $this->hasMany('App\Models\UsersSkill');
    }

    public function job_preference()
    {
        return $this->hasOne('App\Models\JobPreference');
    }

    public function users_qualification()
    {
        return $this->hasMany('App\Models\Users_Qualification');
    }

    public function users_company()
    {
        return $this->hasMany('App\Models\Users_Company');
    }
}
