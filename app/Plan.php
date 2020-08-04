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
        'duration' => 0,
        'price' => 0,
        'extra_fee' => 0,
        'is_prepaid' => true,
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'price' => 'double',
        'extra_fee' => 'double',
        'is_prepaid' => 'boolean',
    ];

    /**
     * Get plan's monthly fee.
     *
     * @return double
     */
    public function getMonthlyFeeAttribute()
    {
        return $this->price / $this->duration;
    }

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
        return $query->where('is_prepaid', !!$state);
    }
}
