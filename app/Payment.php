<?php

namespace App;

use App\Traits\Relation\BelongsToSubscription;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use BelongsToSubscription;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'amount' => 0,
        'method' => PaymentMethod::CASH,
        'type' => PaymentType::CHARGE,
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'amount' => 'double',
    ];

    // SCOPES //////////////////////////////////////////////////////////////////////////////////////

    /**
     * Scope a query to only include payments of given method.
     *
     * @param string $method
     * @param Builder $query
     * @return Builder
     */
    public function scopeOfMethod(Builder $query, string $method)
    {
        return $query->where('method', $method);
    }

    /**
     * Scope a query to only include payments of given type.
     *
     * @param string $type
     * @param Builder $query
     * @return Builder
     */
    public function scopeOfType(Builder $query, string $type)
    {
        return $query->where('type', $type);
    }
}
