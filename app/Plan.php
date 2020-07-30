<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    // RELATIONS ///////////////////////////////////////////////////////////////////////////////////

    public function subscriptions()
    {
        return $this->hasMany('App\Subscription');
    }

    public function members()
    {
        return $this->hasManyThrough('App\Member', 'App\Subscription');
    }

    public function payments()
    {
        return $this->hasManyThrough('App\Payment', 'App\Subscription');
    }

}
