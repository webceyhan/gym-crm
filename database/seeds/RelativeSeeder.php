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
        $ids = Member::pluck('id');
        $config = config('seeder.member.relative');

        Member::all()->each(function ($owner) use ($ids, $config) {

            // starting from owner creation
            $now = $owner->created_at->clone();

            // get unique id pool to consume as reference
            $scopedIds = $ids->except($owner->id)->shuffle();

            $relatives = factory(Relative::class, rand(...$config['count']))->create([
                'owner_id' => $owner->id,
                'member_id' => fn() =>  $scopedIds->pop(),
                'created_at' => fn() => $now->addDays(rand(...$config['delay_days'])),
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
