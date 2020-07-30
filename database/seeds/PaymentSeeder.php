<?php

use App\Payment;
use App\Subscription;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Subscription::all()->each(function ($subscription) {

            $amount = rand(0, 2);

            $payments = factory(Payment::class, $amount)->make([
                'created_at' => $subscription->created_at,
            ]);

            $subscription->payments()->saveMany($payments);
        });
    }
}
