<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tea extends Model
{
    use HasFactory;

    protected $guarded = [];

    // public function getRouteKeyName()
    // {
    //     return 'uuid';
    // }

    protected $fillable = ["name", "brand", "description", "price", "tea_img", "location"];

    public function brand()
    {
        return $this->belongsTo(Brands::class);
    }
}
