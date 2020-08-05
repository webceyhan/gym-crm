<?php

namespace App;

use App\Traits\Relation\BelongsToMember;
use App\Traits\Relation\BelongsToPlan;
use App\Traits\Relation\HasActivities;
use App\Traits\Relation\HasPayments;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use BelongsToMember, BelongsToPlan, HasActivities, HasPayments;

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
        'balance' => 0,
        'cancelled_at' => null,
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'start_date',
        'end_date',
        'cancelled_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'start_date' => 'date:Y-m-d',
        'end_date' => 'date:Y-m-d',
        'balance' => 'double',
    ];

    // SCOPES //////////////////////////////////////////////////////////////////////////////////////

    /**
     * Scope a query to only include [not-]active subscriptions.
     * Active: ongoing (not expired) and not cancelled.
     *
     * @param boolean $state
     * @param Builder $query
     * @return Builder
     */
    public function scopeActive(Builder $query, $state = true): Builder
    {
        if (!$state) {
            return $query->expired()->orWhere(fn($q) => $q->cancelled());
        }

        return $query->expired(false)->cancelled(false);
    }

    /**
     * Scope a query to only include [not-]expired subscriptions.
     *
     * @param boolean $state
     * @param Builder $query
     * @return Builder
     */
    public function scopeExpired(Builder $query, $state = true): Builder
    {
        $operator = !!$state ? '<' : '>=';

        return $query->whereDate('end_date', $operator, now());
    }

    /**
     * Scope a query to only include [not-]cancelled subscriptions.
     *
     * @param boolean $state
     * @param Builder $query
     * @return Builder
     */
    public function scopeCancelled(Builder $query, $state = true): Builder
    {
        return $query->whereNull('cancelled_at', 'and', !!$state);
    }

    /**
     * Scope a query to only include subscriptions with [not-]outstanding balance.
     *
     * @param boolean $state
     * @param Builder $query
     * @return Builder
     */
    public function scopeOutstanding(Builder $query, $state = true): Builder
    {
        $operator = !!$state ? '<' : '>=';

        return $query->where('balance', $operator, 0);
    }

    /**
     * Scope a query to only include subscriptions with [not-]overdue balance.
     * Overdue: ongoing (not expired) with outstanding balance.
     *
     * @param boolean $state
     * @param Builder $query
     * @return Builder
     */
    public function scopeOverdue(Builder $query, $state = true): Builder
    {
        return $query->expired($state)->outstanding();
    }

    /**
     * Scope a query to only include subscriptions of given status.
     *
     * @param string $status
     * @param Builder $query
     * @return Builder
     */
    public function scopeOfStatus(Builder $query, string $status): Builder
    {
        try {
            return $query->{$status}();
        } catch (\Throwable $th) {
            throw new \InvalidArgumentException($status);
        }
    }
}
