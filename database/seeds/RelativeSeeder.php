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
        $count = Member::count();
        $members = Member::inRandomOrder()->take(10)->get();

        $members->each(function ($member) use ($count) {

            // generated related member id
            $memberId = rand(1, $count);

            // re-generate id until it's different than owner
            while ($memberId === $member->id) {
                $memberId = rand(1, $count);
            }

            $relative = factory(Relative::class, 1)->create([
                'owner_id' => $member->id,
                'member_id' => $memberId,
            ])->first();

            // create cross-reference record
            Relative::create([
                'owner_id' => $relative->member_id,
                'member_id' => $relative->owner_id,
                'type' => $relative->type,
            ]);

        });
    }
}
