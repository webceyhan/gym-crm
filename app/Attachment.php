<?php

namespace App;

use App\Traits\Relation\BelongsToMember;
use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    use BelongsToMember;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];
}
