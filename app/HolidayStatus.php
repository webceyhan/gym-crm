<?php

namespace App;

use App\Extra\Enum;

class HolidayStatus extends Enum
{
    const PENDING = 'pending';
    const ONGOING = 'ongoing';
    const EXPIRED = 'expired';
}
