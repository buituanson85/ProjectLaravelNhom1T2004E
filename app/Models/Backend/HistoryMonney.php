<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HistoryMonney extends Model
{
    use HasFactory;
    use softDeletes;
    protected $table = "history_monneys";
    protected $fillable = [
        "send_monney", "note","wallet_id"
    ];
    protected $primaryKey = 'id';

    public function wallet(){
        return $this->belongsTo('App\Models\Backend\Wallet', 'wallet_id');
    }
}
