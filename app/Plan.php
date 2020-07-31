<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    // RELATIONS ///////////////////////////////////////////////////////////////////////////////////

    public function subscriptions()
    {
        return $this->hasMany('App\Subscription');
    }

    public function members()
    {
        return $this->hasManyThrough('App\Member', 'App\Subscription');
    }

    public function payments()
    {
        return $this->hasManyThrough('App\Payment', 'App\Subscription');
    }

    // SCOPES //////////////////////////////////////////////////////////////////////////////////////

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

    /**
     * Scope a query to only include prepaid plans.
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopePrepaid(Builder $query)
    {
        return $query->where('installment', false);
    }

    /**
     * Scope a query to only include installment plans.
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeInstallment(Builder $query)
    {
        return $query->where('installment', true);
    }

}
