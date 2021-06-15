<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plant extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'taxon_id',
        'img_filename',
        'description',
        'user_id',
    ];

    public function taxon()
    {
        return $this->belongsTo(Taxon::class);
    }

    public function parent()
    {
        return $this->hasOneThrough(
            Plant::class,
            Relation::class,
            'child_id',
            'id',
            'id',
            'parent_id'
        );
    }

    public function containers()
    {
        return $this
            ->hasManyThrough(
                Container::class,
                Planting::class,
                'plant_id',
                'id',
                'id',
                'container_id'
            )
            ->join('actions', 'actions.id', '=', 'plantings.action_id')
            ->orderBy('date');
    }

    public function plantings()
    {
        return $this
            ->hasMany(Planting::class)
            ->join('actions', 'actions.id', '=', 'plantings.action_id')
            ->join('action_types', 'action_types.id', '=', 'actions.type_id')
            ->join('users', 'users.id', '=', 'actions.user_id')
            ->orderBy('date')
            ->select([
                'actions.*',
                'action_types.name as action_name',
                'users.username',
                'plantings.plant_id',
                'plantings.container_id',
            ]);
    }

    public function death()
    {
        return $this
            ->hasOne(Death::class)
            ->join('death_causes', 'death_causes.id', '=', 'deaths.cause_id')
            ->join('actions', 'actions.id', '=', 'deaths.action_id')
            ->join('action_types', 'action_types.id', '=', 'actions.type_id')
            ->join('users', 'users.id', '=', 'actions.user_id')
            ->select([
                'actions.*',
                'action_types.name as action_name',
                'users.username',
                'deaths.plant_id',
                'death_causes.name as cause',
            ]);
    }
}
