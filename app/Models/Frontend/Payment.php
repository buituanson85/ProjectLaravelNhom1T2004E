<?php

namespace App\Models\Frontend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use HasFactory;
    use softDeletes;
    protected $table = "payments";
    protected $fillable = [
        "name", "slug","status"
    ];
    protected $primaryKey = 'id';

    public function order(){
        return $this->hasOne('App\Models\Frontend\Order');
    }

}
