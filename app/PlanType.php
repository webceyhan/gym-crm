<?php

namespace App;

use App\Extra\Enum;

class PlanType extends Enum
{
    const DAILY = 'daily';
    const WEEKLY = 'weekly';
    const MONTHLY = 'monthly';
    const YEARLY = 'yearly';
    const INDEFINITE = 'indefinite';
}
