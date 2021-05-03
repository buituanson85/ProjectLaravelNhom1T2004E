<?php

namespace App\Models\Frontend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory;
    use softDeletes;
    protected $table = "orders";
    protected $fillable = [
        "customer_id", "payment_id","price_total","status"
    ];
    protected $primaryKey = 'id';

    public function user(){
        return $this->belongsTo('App\Models\User', 'customer_id');
    }

    public function orderdetails(){
        return $this->hasOne('App\Models\Frontend\OrderDetails','order_id');
    }

    public function noteorder(){
        return $this->hasOne('App\Models\Backend\NoteOrder','order_id');
    }
}
