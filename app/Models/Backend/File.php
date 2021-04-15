<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class File extends Model
{
    use HasFactory;
    use softDeletes;
    protected $table = "files";
    protected $fillable = [
        "name", "slug","cmt_before","cmt_after","license_before","license_after","registration_book","customer_id"
    ];
    protected $primaryKey = 'id';

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

}
