<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Qualification extends Model
{
        /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'qualification';

    protected $fillable = [
        'Name', 'status'
    ];
}
