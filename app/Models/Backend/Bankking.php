<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bankking extends Model
{
    use HasFactory;
    use softDeletes;
    protected $table = "bankkings";
    protected $fillable = [
        "account", "monney","note","bank","status"
    ];
    protected $primaryKey = 'id';
}
