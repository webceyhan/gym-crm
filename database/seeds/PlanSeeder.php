<?php

use App\Plan;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // start from 2 years ago
        $now = now()->subYears(2);

        foreach (self::data() as $attributes) {
            $plan = new Plan($attributes);
            $plan->created_at = $now->addDays(rand(0, 10));
            $plan->save();
        }
    }

    private static function data()
    {
        return [
            [
                'name' => 'Cash 1 year',
                'duration' => 12,
                'price' => 895,
                'extra_fee' => 100,
                'is_prepaid' => true,
                'description' => implode('\n', [
                    'ALL IN membership',
                    'You receive an extra reduction of €100',
                    'Pay the entire year at once',
                    'Membership fee €100',
                ]),
            ],
            [
                'name' => '1 year Domiciliation',
                'duration' => 12,
                'price' => 900,
                'extra_fee' => 100,
                'is_prepaid' => false,
                'description' => implode('\n', [
                    'ALL IN membership',
                    'You receive an extra reduction of €100',
                    'After 12 months you can cancel monthly',
                    'Monthly direct debit',
                    'Membership fee €100',
                ]),
            ],
            [
                'name' => 'Discover us 3 months',
                'duration' => 3,
                'price' => 265,
                'extra_fee' => 100,
                'is_prepaid' => true,
                'description' => implode('\n', [
                    'ALL IN membership',
                    'You receive an extra reduction of €25',
                    'Pay 3 months in advance',
                    'Membership fee €100',
                ]),
            ],
            [
                'name' => 'Student 1 year',
                'duration' => 12,
                'price' => 495,
                'extra_fee' => 40,
                'is_prepaid' => true,
                'description' => implode('\n', [
                    'You\'re younger than 24y',
                    'All-in membership for students',
                    'Pay the entire year at once',
                    'You don\'t pay the membership fee (€40)',
                    'You are in possession of a valid student\'s card',
                ]),
            ],
        ];
    }

}
