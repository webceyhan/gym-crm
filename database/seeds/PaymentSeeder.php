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
        $config = config('seeder.member.subscription.payment');

        Subscription::all()->each(function ($subscription) use ($config) {

            $now = $subscription->created_at->clone();
            $count = rand(0, $subscription->plan->duration);

            $payments = factory(Payment::class, $count)->make();

            $payments->each(function ($payment) use ($now, $subscription) {
                $payment->subscription_id = $subscription->id;
                $payment->created_at = $now->addMonth(1)->clone();
                $payment->save();

                // subtract from balance (inverse to zero balance)
                $subscription->balance += $payment->amount;
            });

            // update balance
            $subscription->save();

            // todo: enable this later after fixing plan balance/fee issue
            // $subscription->payments()->saveMany($payments);
        });
    }
}
