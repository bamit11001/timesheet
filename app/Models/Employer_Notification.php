<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employer_Notification extends Model
{
    protected $table = "employer_notification";
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
