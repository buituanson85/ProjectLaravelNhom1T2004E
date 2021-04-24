<?php

namespace App\Models\Frontend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TimeOrder extends Model
{
    use HasFactory;
    use softDeletes;
    protected $table = "time_orders";

    protected $fillable = [
        "start_time", "end_time","product_id"
    ];
    public function product(){
        return $this->belongsTo('App\Models\Backend\Product');
    }
}
