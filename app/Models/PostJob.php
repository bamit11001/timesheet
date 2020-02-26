<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class PostJob extends Model
{
    use SoftDeletes;
	protected $table = "post_job";
	protected $dates = ['deleted_at'];
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'company_id', 'title', 'company_address', 'job_type', 'salary_range_from', 'salary_range_to', 'salary_range_per', 'min_experience', 'max_experience', 'min_experience_type', 'max_experience_type', 'openings', 'qualification_required', 'qualification_type', 'receive_email', 'job_summary', 'responsibility', 'skills', 'benefits', 'deleted_at'
    ];

    public function jobapplied()
    {
        return $this->hasMany('App\Models\JobApplied');
    }
    public function cities()
    {
        return $this->belongsTo('App\Models\Cities', 'city_id');
    }
    public function states()
    {
        return $this->belongsTo('App\Models\States');
    }
    public function countries()
    {
        return $this->belongsTo('App\Models\Countries');
    }
    public function company()
    {
        return $this->belongsTo('App\Models\Company');
    }

    public function scopeSearch($query, $q)
    {
        if ($q == null) return $query;
        return $query
                ->where('title', 'LIKE', "%{$q}%")
                ->orWhere('job_type', 'LIKE', "%{$q}%");
    }

    
}
