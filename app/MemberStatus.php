<?php

namespace App;

use App\Extra\Enum;

class MemberStatus extends Enum
{
    const INSIDE = 'inside';
    const OUTSIDE = 'outside';
    const AWAY = 'away';
}
