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

    protected $fillable = ["name", "brand_id", "description", "price", "tea_img", "location"];

    //this brand function shows that each Tea has a brand, its a 1:M. Many brands can have many teas but each tea is owned by 1 brand.
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    //this stores function says that each tea can be in manuy stores. many stores have many teas. its my N:M
    public function stores()
    {
        return $this->belongsToMany(Store::class)->withTimestamps();
    }

    //These functions lets me interact with the columns inside those 2 tables in the DB.
}
