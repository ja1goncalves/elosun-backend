<?php

namespace App\Entities;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class ResetPassword.
 *
 * @package namespace App\Entities;
 */
class ResetPassword extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'password_resets';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'token'
    ];


    public function scopeExpired($query)
    {
        return $query->where('created_at', '<', Carbon::now()->subHours(6)->toDateTimeString());
    }
}
