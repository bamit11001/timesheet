<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\SocialLink;

class CompanySocialLink extends Model
{
     protected $table = "company_social_links";

   /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'company_id', 'social_link_id', 'link'];

        public function social_link()
        {
            return $this->belongsTo('App\Models\SocialLink');
        }
        
     
}
