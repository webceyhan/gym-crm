<?php

use App\Member;
use App\Relative;
use Illuminate\Database\Seeder;

class RelativeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // get available member ids
        $memberIds = Member::pluck('id')->flip();

        Member::all()->each(function ($member) use ($memberIds) {

            // 0-2 relatives per member
            $amount = rand(0, 2);

            // start from member's creation
            $now = $member->created_at->clone();

            // get unique related member ids to assign
            $relatedMemberIds = $memberIds->except([$member->id])->keys()->shuffle();

            // make relatives
            $relatives = factory(Relative::class, $amount)->make([
                'member_id' => fn() => $relatedMemberIds->pop(),
                'created_at' => fn() => $now->addDays(rand(1, 30)),
            ]);

            // save relatives
            $member->relatives()->saveMany($relatives);
        });
    }

}
