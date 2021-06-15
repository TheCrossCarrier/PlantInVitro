<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Death extends Model
{
    use HasFactory;

    public $fillable = [
        'action_id',
        'plant_id',
        'cause_id',
    ];

    public $timestamps = false;
}
