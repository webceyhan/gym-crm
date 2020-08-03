<?php

namespace App\Traits\Relation;

trait HasHolidays
{
    public function holidays()
    {
        return $this->hasMany('App\Holiday');
    }

    public function lastHoliday()
    {
        return $this->hasOne('App\Holiday')->latest('id');
    }
}
