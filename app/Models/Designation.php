<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Designation extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'designation';

    protected $fillable = [
        'name', 'status'
    ];
}
