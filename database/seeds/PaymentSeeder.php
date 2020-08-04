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

            // check if one-time plan was chosen
            if (!$subscription->plan->is_prepaid) {

                // create only one payment
                factory(Payment::class)->create([
                    'subscription_id' => $subscription->id,
                    'amount' => abs($subscription->balance),
                    'type' => PaymentType::CHARGE,
                    'created_at' => $subscription->created_at,
                ]);

                // clear outstanding balance
                return $subscription->update(['balance' => 0]);
            }

            // 1-n payment per subscription
            $amount = rand(0, $subscription->plan->duration);

            // start from subscription's creation
            $now = $subscription->created_at->clone();

            // get the monthly subscription fee
            $fee = $subscription->plan->price / $subscription->plan->duration;

            // make payments
            $payments = factory(Payment::class, $amount)->make();

            // customize payments
            $payments->each(function ($payment) use ($now, $fee) {
                $payment->amount = $fee;
                $payment->type = PaymentType::CHARGE;
                $payment->created_at = $now->addMonth(1)->clone();
            });

            // save payments
            $subscription->payments()->saveMany($payments);

            // update balance
            $subscription->balance += ($fee * $amount);
            $subscription->save();

        });
    }
}
