<?php

namespace App;

use App\Traits\Relation\BelongsToMember;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Holiday extends Model
{
    use BelongsToMember;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'start_date',
        'end_date',
    ];

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
