<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Taxon extends Model
{
    use HasFactory;

    protected $fillable = [
        'subspecies',
        'species',
        'genus',
        'family',
        'user_id',
    ];
}
