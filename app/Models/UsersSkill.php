<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsersSkill extends Model
{
    protected $table = "users_skill";


    protected $fillable = [
        'user_id', 'skill_id'
    ];

    public function skills()
    {
        return $this->belongsTo('App\Models\Skills', 'skill_id');
    }
    
}
