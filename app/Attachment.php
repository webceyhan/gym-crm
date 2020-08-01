<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    // RELATIONS ///////////////////////////////////////////////////////////////////////////////////

    public function owner()
    {
        return $this->belongsTo('App\Member');
    }
}
