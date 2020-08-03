<?php

namespace App\Traits\Relation;

trait HasPayments
{
    public function payments()
    {
        return $this->hasMany('App\Payment');
    }
}
