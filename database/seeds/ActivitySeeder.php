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
            $subscription->activities()->saveMany(
                factory(Activity::class, rand(0, 10))->make()
            );
        });
    }
}
