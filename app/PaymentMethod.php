<?php

namespace App;

use App\Extra\Enum;

class PaymentMethod extends Enum
{
    const CASH = 'cash';
    const CARD = 'card';
    const ONLINE = 'online';
}
