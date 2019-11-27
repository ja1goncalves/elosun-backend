<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Order.
 *
 * @package namespace App\Entities;
 */
class Order extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'start_watts',
        'end_watts',
        'type_order',
        'orderly_type',
        'orderly_id',
        'order_status_id'
    ];

    const SALE = 'sale';
    const PURCHASE = 'purchase';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function orderly()
    {
        return $this->morphTo('orderly');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function status()
    {
        return $this->belongsTo(OrdersStatus::class, 'order_status_id');
    }
}
