<?php

namespace App;

use App\Traits\Relation\HasSubscriptions;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasSubscriptions;

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
        'description' => null,
        'type' => PlanType::INDEFINITE,
        'duration' => 0,
        'price' => 0,
        'monthly_fee' => 0,
        'extra_fee' => 0,
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'price' => 'double',
        'monthly_fee' => 'double',
        'extra_fee' => 'double',
    ];

    // SCOPES //////////////////////////////////////////////////////////////////////////////////////

    /**
     * Scope a query to only include [not-]prepaid plans.
     *
     * @param boolean $state
     * @param Builder $query
     * @return Builder
     */
    public function scopePrepaid(Builder $query, $state = true)
    {
        $operator = !!$state ? '=' : '!=';

        return $query->where('monthly_fee', $operator, 0);
    }

    /**
     * Scope a query to only include plans of given type.
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
