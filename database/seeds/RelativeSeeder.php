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
        Member::inRandomOrder()->take(10)->get()->each(function ($owner) {

            $amount = rand(1,2);

            $relatives = factory(Relative::class, $amount)->create([
                'owner_id' => $owner->id,
                // generate random member id between as one less then owner id
                'member_id' => fn() => $owner->id > 1 ? rand(1, $owner->id) : 2,
                'created_at' => $owner->created_at,
            ]);

            // create cross-reference record
            $relatives->each(function ($relative) {
                Relative::create([
                    'owner_id' => $relative->member_id,
                    'member_id' => $relative->owner_id,
                    'type' => $relative->type,
                    'created_at' => $relative->created_at,
                ]);
            });
        });
    }

}
