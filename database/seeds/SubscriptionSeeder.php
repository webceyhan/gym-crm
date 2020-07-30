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
        $memberIds = Member::pluck('id');

        $memberIds->each(function ($memberId) use ($planIds) {
            factory(Subscription::class)->create([
                'member_id' => $memberId,
                'plan_id' => $planIds->random(),
            ]);
        });
    }
}
