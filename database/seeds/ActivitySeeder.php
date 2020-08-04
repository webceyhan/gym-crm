<?php

use App\Activity;
use App\Subscription;
use Illuminate\Database\Seeder;

class ActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Subscription::all()->each(function ($subscription) {

            // 1-5 activity per subscription
            $amount = rand(1, 5);

            // start from subscription's start-date
            $now = $subscription->start_date->clone();

            // make activities
            $activities = factory(Activity::class, $amount)->make();

            // customize activities
            $activities->each(function ($activity) use ($now) {
                $activity->created_at = $now->addDays(rand(0, 5))->clone();
                $activity->finished_at = $now->addHours(rand(1, 3))->clone();
            });

            // save activities
            $subscription->activities()->saveMany($activities);
        });
    }
}
