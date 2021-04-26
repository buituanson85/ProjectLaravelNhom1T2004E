<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Wallet extends Model
{
    use HasFactory;
    use softDeletes;
    protected $table = "wallets";
    protected $fillable = [
        "account", "monney_confirm","monney","partner_id","note"
    ];
    protected $primaryKey = 'id';

    public function user(){
        return $this->belongsTo('App\Models\User', 'partner_id');
    }

    public function historymonney(){
        return $this->hasMany('App\Models\Backend\HistoryMonney', 'wallet_id');
    }
}
