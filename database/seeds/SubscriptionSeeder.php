<?php

use App\Member;
use App\Plan;
use App\Subscription;
use Illuminate\Database\Seeder;

class SubscriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $planIds = Plan::pluck('id');

        Member::all()->each(function ($member) use ($planIds) {

            // 0-3 subscriptions per member
            $amount = rand(0, 3);

            // start from member's creation
            $now = $member->created_at->clone();

            // make subscriptions
            $subscriptions = factory(Subscription::class, $amount)->make([
                'plan_id' => fn() => $planIds->random(),
            ]);

            // customize subscriptions
            $subscriptions->each(function ($subscription) use ($now) {
                // get chosen plan
                $plan = $subscription->plan;

                // accredit balance with plan price (+ extra fees)
                $subscription->balance = -($plan->price + $plan->extra_fee);

                // schedule 0-2 weeks after previous one
                $subscription->created_at = $now->addWeeks(rand(0, 2))->clone();

                // delay 0-10 days after schdule
                $subscription->start_date = $now->addDays(rand(0, 10))->clone();

                // add months as long as the selected plan's duration
                $subscription->end_date = $now->addMonths($plan->duration)->clone();

                // optionally cancel and rewind now-date to 1-n months ago (max as long as plan's duration)
                $subscription->cancelled_at = rand(0, 2) ? null : $now->subMonths(rand(1, $plan->duration))->clone();
            });

            // save subscriptions
            $member->subscriptions()->saveMany($subscriptions);

        });
    }
}
