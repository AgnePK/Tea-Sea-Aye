<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'location'];


    //this stores function says that each tea can be in many stores. many stores have many teas. its N:M
    public function teas()
    {
        return $this->belongsToMany(Tea::class)->withTimeStamps();
    }
}
