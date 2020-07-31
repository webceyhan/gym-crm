<?php

namespace App;

use App\Extra\Enum;

class HolidayStatus extends Enum
{
    const ACTIVE = 'active';
    const PENDING = 'pending';
    const EXPIRED = 'expired';
}
