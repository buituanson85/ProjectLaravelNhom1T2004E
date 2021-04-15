<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Coupon extends Model
{
    use HasFactory;
    use softDeletes;
    protected $table = "coupons";
    protected $fillable = [
        "name", "slug","quantity","price","method","start_time","end_time"
    ];
    protected $primaryKey = 'id';
}
