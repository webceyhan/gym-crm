<?php

namespace App\Traits\Relation;

trait HasActivities
{
    public function activities()
    {
        return $this->hasMany('App\Activity');
    }

    public function lastActivity()
    {
        return $this->hasOne('App\Activity')->latest('id');
    }
}
