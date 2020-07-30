<?php

namespace App;

use App\Extra\Enum;

class MemberStatus extends Enum
{
    const IN = 'in';
    const OUT = 'out';
    const AWAY = 'away';
}
