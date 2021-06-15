<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Action extends Model
{
    use HasFactory;

    protected $fillable = [
        'type_id',
        'date',
        'comment',
        'user_id',
    ];

    public function type()
    {
        return $this->belongsTo(ActionType::class);
    }
}
