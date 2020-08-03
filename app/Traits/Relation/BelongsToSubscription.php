<?php

namespace App\Traits\Relation;

trait BelongsToSubscription
{
    public function subscription()
    {
        return $this->belongsTo('App\Subscription');
    }

    public function owner()
    {
        // note: this is belongsToThrough relation which doesn't exist yet!
        return $this->hasOneThrough('App\Member', 'App\Subscription', 'member_id', 'id');
    }
}
