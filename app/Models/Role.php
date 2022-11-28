<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    //lets us get specific roles and show all the users
    public function users()
        {
            return $this->belongToMany('App\Models\User', 'user_role');
        }
}
