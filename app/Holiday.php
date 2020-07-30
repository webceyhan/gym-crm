<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Holiday extends Model
{
    // RELATIONS ///////////////////////////////////////////////////////////////////////////////////

    public function subscription()
    {
        return $this->belongsTo('App\Subscription');
    }

    public function owner()
    {
        return $this->hasOneThrough('App\Member', 'App\Subscription');
    }
}
