<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Statistical extends Model
{
    use HasFactory;
    use softDeletes;
    protected $table = "statisticals";

    protected $fillable = [
        "order_date","sales","profit","quantity","total_order"
    ];
}
