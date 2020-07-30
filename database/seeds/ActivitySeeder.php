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

            $amount = rand(0, 10);

            $activities = factory(Activity::class, $amount)->make([
                'created_at' => $subscription->created_at,
            ]);

            $subscription->activities()->saveMany($activities);
        });
    }
}
