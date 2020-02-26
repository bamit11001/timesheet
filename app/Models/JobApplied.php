<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobApplied extends Model
{
    use SoftDeletes;
    protected $table = "job_applied";
    protected $dates = ['deleted_at'];
	
    /**
     * The attributes that are mass assignable.
     *
     * @var array
    */
    protected $fillable = [
        'company_id', 'user_id', 'post_job_id', 'interview_start', 'interview_end', 'interview_type', 'interview_venue', 'message', 'interviewer_email', 'status'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function post_job()
    {
        return $this->belongsTo('App\Models\PostJob');
    }

    public function scopeSearch($query, $q)
    {
        if ($q['q'] == null && $q['job'] == null) return $query;
        if(isset($q['q']) && $q['q'] != null) $query->where('status', 'LIKE', "%{$q['q']}%");
        if(isset($q['job']) &&  $q['job'] != null) $query->where('post_job_id', 'LIKE', "%{$q['job']}%");
        return $query;
    }
}
