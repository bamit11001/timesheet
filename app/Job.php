<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    
    protected $fillable = [
        'id' => '',
        'jobtitle' => 'required',
        'c_address'  => 'required',
        'job_type'  => 'required',
        'salary_min'     => 'required',
        'salary_max'    => 'required',
        'anual'  => 'required',
        'min_exp_year'  => 'required',
        'designation'  => 'required',
        'exp_max_yer'  => 'required',
        'exp_preferred'  => 'required',
        'hiring'  => 'required',
        'edu_minmum'  => 'required',
        'edu_preferred'  => 'required',
        'email'  => 'required',
        'job_summary'  => 'required',
        'duties'  => 'required',
        'skills'  => 'required',
        'benifits'  => 'required',
    ];

    public $timestamps = false;
}
