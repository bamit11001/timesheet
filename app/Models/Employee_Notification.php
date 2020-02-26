<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee_Notification extends Model
{
    protected $table = "employee_notification";
    protected $dates = ['deleted_at'];
	
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'company_id', 'notification_type', 'message', ' status ', 'deleted_at', 'created_at', 'updated_at'
    ];
}
