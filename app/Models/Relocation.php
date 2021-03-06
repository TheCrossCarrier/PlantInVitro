<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Relocation extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'action_id',
        'container_id',
        'location_id',
    ];
}
