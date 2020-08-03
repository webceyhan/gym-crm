<?php

namespace App\Traits\Relation;

trait HasSubscriptions
{
    public function subscriptions()
    {
        return $this->hasMany('App\Subscription');
    }

    public function members()
    {
        return $this->belongsToMany('App\Member', 'App\Subscription');
    }

    public function activities()
    {
        return $this->hasManyThrough('App\Activity', 'App\Subscription');
    }

    public function payments()
    {
        return $this->hasManyThrough('App\Payment', 'App\Subscription');
    }

    public function lastSubscription()
    {
        return $this->hasOne('App\Subscription')->latest('id');
    }

    public function lastActivity()
    {
        return $this->hasOneThrough('App\Activity', 'App\Subscription')->latest('id');
    }
}
