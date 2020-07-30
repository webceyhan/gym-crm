<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class Relative extends Pivot
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'relatives';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

}
