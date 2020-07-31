<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    // RELATIONS ///////////////////////////////////////////////////////////////////////////////////

    public function subscription()
    {
        return $this->subscriptions()
            ->latest('id')
            ->first();
    }

    public function subscriptions()
    {
        return $this->hasMany('App\Subscription');
    }

    public function attachments()
    {
        return $this->hasMany('App\Attachment');
    }

    public function relatives()
    {
        return $this->belongsToMany('App\Member', 'relatives', 'owner_id')
            ->using('App\Relative')
            ->withPivot(['id', 'type']);
    }

    public function holidays()
    {
        return $this->hasMany('App\Holiday');
    }

    // SCOPES //////////////////////////////////////////////////////////////////////////////////////

    /**
     * Scope a query to only include members of given status.
     *
     * @param string status
     * @param Builder $query
     * @return Builder
     */
    public function scopeOfStatus(Builder $query, string $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Scope a query to only include child members.
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeChild(Builder $query): Builder
    {
        return $query->whereRaw("TIMESTAMPDIFF(YEAR, birth_date, NOW()) < 18");
    }

    /**
     * Scope a query to only include adult members.
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeAdult(Builder $query): Builder
    {
        return $query->whereRaw("TIMESTAMPDIFF(YEAR, birth_date, NOW()) >= 18");
    }
}
