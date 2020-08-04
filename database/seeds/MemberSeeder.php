<?php

use App\Member;
use App\Plan;
use Illuminate\Database\Seeder;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Plan::all()->each(function ($plan) {

            // 1-10 members per plan
            $amount = rand(1, 10);

            // start from plan's creation
            $now = $plan->created_at->clone();

            // make members
            $members = factory(Member::class, $amount)->make();

            // customize and save members
            $members->each(function ($member) use ($now) {
                $member->created_at = $now->addDays(rand(0, 7));
                $member->verified_at = rand(0, 2) ? $now->addDays(rand(0, 10)) : null;
                $member->save();
            });
        });
    }
}
