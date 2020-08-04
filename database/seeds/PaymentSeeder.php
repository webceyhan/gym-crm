<?php

use App\Payment;
use App\PaymentType;
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

            // get chosen plan
            $plan = $subscription->plan;

            // start from subscription's creation
            $now = $subscription->created_at->clone();

            // pay extra-fee if needed
            if ($plan->extra_fee) {
                $subscription->payments()->create([
                    'amount' => $plan->extra_fee,
                    'created_at' => $now->clone(),
                ]);
            }

            // add %10 discount if yearly plan
            if ($plan->duration >= 12 ) {
                $subscription->payments()->create([
                    'type' => PaymentType::DISCOUNT,
                    'amount' => $plan->price * .1,
                    'created_at' => $now->clone(),
                ]);
            }

            // pay one-time fee if needed
            if ($plan->is_prepaid) {
                // refresh current balance after above operations
                // todo: use better logic than observers!
                $subscription->refresh();

                $subscription->payments()->create([
                    'amount' => abs($subscription->balance),
                    'created_at' => $now->clone(),
                ]);

                return; // done
            }

            // 1-n payments per subscription
            $amount = rand(1, $plan->duration);

            // make payments
            $payments = factory(Payment::class, $amount)->make([
                'type' => PaymentType::CHARGE,
                'amount' => $plan->monthly_fee,
                'created_at' => fn() => $now->addMonth(1)->clone(),
            ]);

            // make optional refund
            if($amount > 1 && !rand(0, 2)){
                $payments->last()->fill([
                    'type' => PaymentType::REFUND,
                    'amount' => -$plan->monthly_fee
                ]);
            }

            // save payments
            $subscription->payments()->saveMany($payments);
        });
    }
}
