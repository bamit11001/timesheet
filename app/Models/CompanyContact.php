<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyContact extends Model
{
    protected $table = "company_contact";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'comapny_id', 'contact', 'is_primary'];

}
