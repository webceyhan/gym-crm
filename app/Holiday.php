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

    public function scopePending(Builder $query): Builder
    {
        return $query->whereDate('start_date', '>', now()->today());
    }

    public function scopeOngoing(Builder $query): Builder
    {
        return $query
            ->whereDate('start_date', '<=', now()->today())
            ->whereDate('end_date', '>=', now()->today());
    }

    public function scopeExpired(Builder $query): Builder
    {
        return $query->whereDate('end_date', '<', now()->today());
    }

    public function scopeOfStatus(Builder $query, string $status): Builder
    {
        try {
            return $query->{$status}();
        } catch (\Throwable $th) {
            throw new \InvalidArgumentException($status);
        }
    }
}
