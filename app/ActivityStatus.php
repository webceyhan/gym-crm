<?php

namespace App;

use App\Extra\Enum;

class ActivityStatus extends Enum
{
    const ACTIVE = 'active';
    const EXPIRED = 'expired';
    const FINISHED = 'finished';
}
