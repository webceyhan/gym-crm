<?php

namespace App;

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
        return $this->belongsToMany('App\Member')
            ->using('App\Relative')
            ->withPivot(['type']);
    }
}
