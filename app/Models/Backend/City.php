<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model
{
    use HasFactory;
    use softDeletes;
    protected $table = "cities";
    protected $fillable = [
        "name", "slug","status"
    ];
    protected $primaryKey = 'id';

    public function district(){
        return $this->hasOne('App\Models\Backend\District');
    }
}
