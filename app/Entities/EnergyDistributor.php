<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class EnergyDistributor.
 *
 * @package namespace App\Entities;
 */
class EnergyDistributor extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'initials',
        'site',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function electricAccounts()
    {
        return $this->hasMany(ElectricAccount::class, 'energy_distributor_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function electricStations()
    {
        return $this->hasMany(ElectricStation::class, 'energy_distributor_id');
    }

}
