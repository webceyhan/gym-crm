<?php

namespace App;

use App\Traits\Relation\BelongsToSubscription;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
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
        'type' => ActivityType::FITNESS,
        'finished_at' => null,
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'finished_at',
    ];

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
