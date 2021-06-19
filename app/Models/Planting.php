<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Planting extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'action_id',
        'plant_id',
        'container_id',
    ];

    public function action()
    {
        return $this->belongsTo(Action::class);
    }
}
