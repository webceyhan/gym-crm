<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
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

    // RELATIONS ///////////////////////////////////////////////////////////////////////////////////

    public function plan()
    {
        return $this->belongsTo('App\Plan');
    }

    public function owner()
    {
        return $this->belongsTo('App\Member');
    }

    public function activities()
    {
        return $this->hasMany('App\Activity');
    }

    public function payments()
    {
        return $this->hasMany('App\Payment');
    }

    // SCOPES //////////////////////////////////////////////////////////////////////////////////////

    /**
     * Scope a query to only include subscriptions of given status.
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeOfStatus(Builder $query, string $status)
    {
        switch ($status) {
            case SubscriptionStatus::ACTIVE:
                return $query
                    ->whereDate('end_date', '>', now())
                    ->whereNull('cancelled_at');

            case SubscriptionStatus::EXPIRED:
                return $query->whereDate('end_date', '<', now());

            case SubscriptionStatus::CANCELLED:
                return $query->whereNotNull('cancelled_at');
        }

        return $query;
    }

    /**
     * Scope a query to only include subscriptions with negative balance.
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeInDept(Builder $query)
    {
        return $query->where('balance', '<', 0);
    }
}
