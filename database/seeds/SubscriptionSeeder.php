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

            $amount = rand(0, 1);

            factory(Subscription::class, $amount)->create([
                'plan_id' => $planIds->random(),
                'member_id' => $member->id,
                'created_at' => $member->created_at,
            ]);
        });
    }
}
