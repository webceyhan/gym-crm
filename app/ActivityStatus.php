<?php

namespace App;

use App\Extra\Enum;

class ActivityStatus extends Enum
{
    const ONGOING = 'ongoing';
    const FINISHED = 'finished';
    const EXPIRED = 'expired';
}
