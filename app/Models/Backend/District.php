<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class District extends Model
{
    use HasFactory;
    use softDeletes;
    protected $table = "districts";
    protected $fillable = [
        "name", "slug", "location","status","city_id"
    ];
    protected $primaryKey = 'id';

    public function city(){
        return $this->belongsTo('App\Models\Backend\City');
    }

    public function product(){
        return $this->hasOne('App\Models\Backend\Product');
    }
}
