<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NoteOrder extends Model
{
    use HasFactory;
    use softDeletes;
    protected $table = "note_orders";
    protected $fillable = [
        "note", "order_id","partner_id"
    ];
    protected $primaryKey = 'id';

    public function user(){
        return $this->belongsTo('App\Models\User', 'partner_id');
    }
    public function order(){
        return $this->belongsTo('App\Models\Frontend\Order','order_id');
    }
}
