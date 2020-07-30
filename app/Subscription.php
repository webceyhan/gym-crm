<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    // RELATIONS ///////////////////////////////////////////////////////////////////////////////////

    public function plan()
    {
        return $this->belongsTo('App\Plan');
    }

    public function owner()
    {
        return $this->belongsTo('App\Member');
    }

    public function activities()
    {
        return $this->hasMany('App\Activity');
    }

    public function payments()
    {
        return $this->hasMany('App\Payment');
    }
}
