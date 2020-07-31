<?php

namespace App;

use App\Extra\Enum;

class ActivityStatus extends Enum
{
    const ACTIVE = 'active';
    const COMPLETED = 'completed';
    const EXPIRED = 'expired';
}
