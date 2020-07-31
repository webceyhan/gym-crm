<?php

namespace App;

use App\Extra\Enum;

class SubscriptionStatus extends Enum
{
    const ACTIVE = 'active';
    const EXPIRED = 'expired';
    const CANCELLED = 'cancelled';
}
