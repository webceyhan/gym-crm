<?php

namespace App;

use App\Extra\Enum;

class PaymentType extends Enum
{
    const CHARGE = 'charge';
    const REFUND = 'refund';
    const DISCOUNT = 'discount';
}
