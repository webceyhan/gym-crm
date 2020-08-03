<?php

namespace App\Traits\Relation;

use App\RelativeType;

trait HasRelatives
{
    // public function relatives()
    // {
    //     return $this->belongsToMany('App\Member', 'relatives', 'owner_id')
    //         ->using('App\Relative')
    //         ->withPivot(['id', 'type']);
    // }

    public function relatives()
    {
        return $this->hasMany('App\Relative', 'owner_id');
    }

    // public function siblings()
    // {
    //     return $this->relatives()->where('type', RelativeType::SIBLING);
    // }

    // public function families()
    // {
    //     return $this->relatives()->where('type', RelativeType::FAMILY);
    // }

    // public function friends()
    // {
    //     return $this->relatives()->where('type', RelativeType::FRIEND);
    // }
}
