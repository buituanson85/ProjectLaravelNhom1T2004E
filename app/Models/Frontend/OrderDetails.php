<?php

namespace App\Models\Frontend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderDetails extends Model
{
    use HasFactory;
    use softDeletes;
    protected $table = "order_details";
    protected $fillable = [
        "order_id", "customer_id","product_id","product_name","product_image","product_price_total","product_received_date","product_pay_date"
    ];
    protected $primaryKey = 'id';

    public function order(){
        return $this->belongsTo('App\Models\Frontend\Order','order_id');
    }

    public function product(){
        return $this->belongsTo('App\Models\Backend\Product', 'product_id');
    }
}
