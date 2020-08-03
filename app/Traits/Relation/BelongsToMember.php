<?php

namespace App\Traits\Relation;

trait BelongsToMember
{
    public function owner()
    {
        return $this->belongsTo('App\Member', 'member_id');
    }
}
