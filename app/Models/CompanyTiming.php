<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyTiming extends Model
{
   protected $table = "company_timing";

   /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'company_id', 'day', 'open_at', 'close_at', 'is_working_day', 'status'];
}
