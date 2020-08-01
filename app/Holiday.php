<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Holiday extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    // RELATIONS ///////////////////////////////////////////////////////////////////////////////////

    public function owner()
    {
        return $this->belongsTo('App\Member');
    }

    // SCOPES //////////////////////////////////////////////////////////////////////////////////////

    /**
     * Scope a query to only include holidays of given status.
     *
     * @param string status
     * @param Builder $query
     * @return Builder
     */
    public function scopeOfStatus(Builder $query, string $status)
    {
        switch ($status) {
            case HolidayStatus::ACTIVE:
                return $query
                    ->whereDate('start_date', '<=', now())
                    ->whereDate('end_date', '>=', now());

            case HolidayStatus::PENDING:
                return $query->whereDate('start_date', '>', now());

            case HolidayStatus::EXPIRED:
                return $query->whereDate('end_date', '<', now());
        }

        return $query;
    }

}
