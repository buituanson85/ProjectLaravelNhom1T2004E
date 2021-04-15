<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;
    use softDeletes;
    protected $table = "categories";
    protected $fillable = [
        "name", "method","status"
    ];
    protected $primaryKey = 'id';

    public function product(){
        return $this->hasOne('App\Models\Backend\Product');
    }
}
