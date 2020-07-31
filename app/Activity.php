<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    // RELATIONS ///////////////////////////////////////////////////////////////////////////////////

    public function subscription()
    {
        return $this->belongsTo('App\Subscription');
    }

    public function owner()
    {
        return $this->hasOneThrough('App\Member', 'App\Subscription');
    }

    // SCOPES //////////////////////////////////////////////////////////////////////////////////////

    /**
     * Scope a query to only include activities of given type.
     *
     * @param string type
     * @param Builder $query
     * @return Builder
     */
    public function scopeOfType(Builder $query, string $type)
    {
        return $query->where('type', $type);
    }

    /**
     * Scope a query to only include activities of given status.
     *
     * @param string status
     * @param Builder $query
     * @return Builder
     */
    public function scopeOfStatus(Builder $query, string $status)
    {
        switch ($status) {
            case ActivityStatus::ACTIVE:
                return $query
                    ->whereDate('created_at', '>', now()->yesterday())
                    ->whereNull('finished_at');

            case ActivityStatus::EXPIRED:
                return $query->whereDate('created_at', '<', now()->yesterday());

            case ActivityStatus::FINISHED:
                return $query->whereNotNull('finished_at');
        }

        return $query;
    }
}
