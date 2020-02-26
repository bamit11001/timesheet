<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Users_Company extends Model
{

    protected $table='users_company';

    protected $fillable = [
        'user_id','designation','company','salary_lakh', 'salary_thousand','salary_period','is_current','currently_working', 'joined_on', 'left_on','notice_period'
    ];
}
