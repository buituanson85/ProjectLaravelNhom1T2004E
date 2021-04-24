<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Partner extends Model
{
    use HasFactory;
    use softDeletes;
    protected $table = "partners";
    protected $fillable = [
        "name","email","phone","address","title","note","status"
    ];
    protected $primaryKey = 'id';
}
