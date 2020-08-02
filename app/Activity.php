<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
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
        'type' => ActivityType::FITNESS,
        'finished_at' => null,
    ];

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

    public function scopeOngoing(Builder $query): Builder
    {
        return $query
            ->whereDate('created_at', now()->today())
            ->whereNull('finished_at');
    }

    public function scopeFinished(Builder $query): Builder
    {
        return $query->whereNotNull('finished_at');
    }

    public function scopeExpired(Builder $query): Builder
    {
        return $query->whereDate('created_at', '<', now()->today());
    }

    public function scopeOfType(Builder $query, string $type): Builder
    {
        return $query->where('type', $type);
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
