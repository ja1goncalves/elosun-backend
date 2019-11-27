<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class ElectricAccount.
 *
 * @package namespace App\Entities;
 */
class ElectricAccount extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'number',
        'type_address',
        'low_income',
        'phase',
        'installation',
        'client_id',
        'energy_distributor_id',
    ];

    const RESIDENCE = 'residence';
    const INDUSTRY = 'industry';
    const TYPE_ADDRESS = ['residence', 'industry'];

    const MONOPHASIC = 'mono';
    const BIPHASIC = 'bi';
    const TRIPHASIC = 'tri';
    const PHASES = ['mono', 'bi', 'tri'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function address()
    {
        return $this->hasMany(Address::class, 'electric');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function energyDistributor()
    {
        return $this->belongsTo(EnergyDistributor::class, 'energy_distributor_id');
    }

}
