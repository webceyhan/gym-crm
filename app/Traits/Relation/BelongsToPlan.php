<?php

namespace App\Traits\Relation;

trait BelongsToPlan
{
    public function plan()
    {
        return $this->belongsTo('App\Plan');
    }
}
