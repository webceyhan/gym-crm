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
        $config = config('seeder.member.subscription');

        Member::all()->each(function ($member) use ($planIds, $config) {

            $now = $member->created_at->clone();

            $subscriptions = factory(Subscription::class, rand(...$config['count']))->make([
                'plan_id' => fn() => $planIds->random(),
                'member_id' => $member->id,
            ]);

            $subscriptions->each(function ($subscription) use ($now, $config) {
                $subscription->created_at = $now->clone();
                $subscription->start_date = $now->addDays(rand(...$config['delay_days']))->clone();
                $subscription->end_date = $now->addMonths($subscription->plan->duration)->clone();
                $subscription->cancelled_at = rand(0, 100) < 10 ? $now : null;
                $subscription->balance = -$subscription->plan->price;
                $subscription->save();
            });

        });
    }
}
