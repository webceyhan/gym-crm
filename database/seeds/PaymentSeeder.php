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
            $subscription->payments()->saveMany(
                factory(Payment::class, rand(0, 2))->make()
            );
        });
    }
}
