<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'address'];

    //Each brand has many teas, but each tea can only have 1 brand attached to it.
    public function teas()
    {
        return $this->hasMany(Tea::class);
    }
}
