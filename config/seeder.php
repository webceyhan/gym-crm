<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Seeder settings
    |--------------------------------------------------------------------------
    |
     */

    'now' => now()->subYears(2),

    // possible plans to subscribe
    'plan' => [
        'count' => 5,
        'monthly_fee' => 80,
        'discount_rate' => .21,
        'tags' => ['all in', 'promo', 'adult', 'student'],
    ],

    // members to attends
    'member' => [
        'count' => 20,

        // certificates, proves or signature
        'attachment' => [
            'count' => [0, 3],
            'delay_days' => [0, 7],
        ],

        // planned holidays incremental
        'holiday' => [
            'count' => [1, 3], // 1-3 times
            'days' => [5, 30], // 5-30 days for duration
            'delay_days' => [0, 10], // delay 0-10 days before holiday starts
            'gap_months' => [2, 3], // 2-3 months between holidays
        ],

        // friend, family or sibling
        'relative' => [
            'count' => [0, 2],
            'delay_days' => [1, 30],
        ],

        // 1 or more (previous) subscriptons
        'subscription' => [
            'count' => 2,

            // check in/out for fitness, spa or other facilities
            'activity' => [
                'count' => 10,
            ],

            // charge (with/out installment), refund or discount
            'payment' => [
                'count' => 3,
            ],
        ],
    ],

];
