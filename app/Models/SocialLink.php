<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SocialLink extends Model
{
    //
    protected $table = "social_link";

    public function company_social_links()
    {
        return $this->hasMany('App\Models\CompanySocialLink');
    }

}
