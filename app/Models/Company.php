<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\CompanySocialLink;

class Company extends Model
{
    protected $table = "company";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'nature_of_business', 'about', 'no_of_employee', 'address', 'hour_type'];

     public function company_social_links()
     {
         return $this->hasMany('App\Models\CompanySocialLink', 'company_id');
     }
     public function company_contact()
     {
         return $this->hasMany('App\Models\CompanyContact', 'company_id');
     }
     public function company_timing()
     {
         return $this->hasMany('App\Models\CompanyTiming', 'company_id');
     }

     
    

}
