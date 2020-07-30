<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    // RELATIONS ///////////////////////////////////////////////////////////////////////////////////

    public function owner()
    {
        return $this->belongsTo('App\Member');
    }
}
