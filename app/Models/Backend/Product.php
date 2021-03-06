<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use softDeletes;
    protected $table = "products";
    protected $fillable = [
        "name", "slug","image","price","insurrance","deposit","km","additional","engine",
        "seat","capacity","range","gear","consumption","status","featured","district_id","brand_id",
        "category_id","partner_id"
    ];
    protected $primaryKey = 'id';

    public function category(){
        return $this->belongsTo('App\Models\Backend\Category','category_id');
    }
    public function user(){
        return $this->belongsTo('App\Models\User', 'partner_id');
    }

    public function brand(){
        return $this->belongsTo('App\Models\Backend\Brand','brand_id');
    }

    public function district(){
        return $this->belongsTo('App\Models\Backend\District','district_id');
    }

    public function orderdetails(){
        return $this->hasMany('App\Models\Frontend\OrderDetails', 'product_id');
    }

    public function city(){
        return $this->belongsTo('App\Models\Backend\City');
    }

    public function galaxy(){
        return $this->hasOne('App\Models\Backend\Galaxy');
    }

    public function timeorder(){
        return $this->hasOne('App\Models\Frontend\TimeOrder');
    }

}
