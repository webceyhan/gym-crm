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
        $config = config('seeder.member.subscription.activity');

        Subscription::all()->each(function ($subscription) use ($config) {

            $now = $subscription->created_at->clone();

            $activities = factory(Activity::class, rand(...$config['count']))->make();

            $activities->each(function($activity) use($now){
                $activity->created_at = $now->addDays(rand(0, 7))->clone();
                $activity->finished_at = $now->addHours(rand(1,3))->clone();
            });

            $subscription->activities()->saveMany($activities);
        });
    }
}
