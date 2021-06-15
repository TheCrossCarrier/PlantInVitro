<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Container extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'type_id',
        'medium_id',
        'user_id',
    ];

    public function type()
    {
        return $this->belongsTo(ContainerType::class, 'type_id');
    }

    public function medium()
    {
        return $this->belongsTo(Medium::class);
    }

    public function relocations()
    {
        return $this
            ->hasMany(Relocation::class)
            ->join('actions', 'actions.id', '=', 'relocations.action_id')
            ->join('action_types', 'action_types.id', '=', 'actions.type_id')
            ->join('users', 'users.id', '=', 'actions.user_id')
            ->join('locations', 'locations.id', '=', 'relocations.location_id')
            ->orderBy('date')
            ->select([
                'actions.*',
                'action_types.name as action_name',
                'users.username',
                'relocations.container_id',
                'locations.name as location_name',
            ]);
    }

    public function nutrition()
    {
        return $this
            ->hasMany(Nutrition::class)
            ->join('actions', 'actions.id', '=', 'nutrition.action_id')
            ->join('action_types', 'action_types.id', '=', 'actions.type_id')
            ->join('users', 'users.id', '=', 'actions.user_id')
            ->join('nutrients', 'nutrients.id', '=', 'nutrition.nutrient_id')
            ->orderBy('date')
            ->select([
                'actions.*',
                'action_types.name as action_name',
                'users.username',
                'nutrition.container_id',
                'nutrients.name as nutrient_name',
                'nutrients.concentration',
            ]);
    }
}
