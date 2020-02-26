<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Messages extends Model
{
    use SoftDeletes;
    protected $table = "messages";
    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
    */
    protected $fillable = [
        'user_id', 'company_id', 'sent_by', 'message', 'file','status', 'created_at', 'updated_at', 'deleted_at'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function employers()
    {
        return $this->belongsTo('App\Models\Employer');
    }
    public function company()
    {
        return $this->belongsTo('App\Models\Company');
    }
}
