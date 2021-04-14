<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permission extends Model
{
    use HasFactory;
    use softDeletes;
    protected $table = "permissions";

    protected $fillable = [
        "name","slug","url","icon","parent"
    ];

    public function roles(){
        return $this->belongsToMany(Role::class,'role_permission');
    }
}
