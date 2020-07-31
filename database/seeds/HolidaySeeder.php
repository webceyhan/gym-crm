<?php

use App\Holiday;
use App\Member;
use Illuminate\Database\Seeder;

class HolidaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Member::inRandomOrder()->take(10)->get()->each(function ($member) {

            $amount = rand(1, 2);

            $holidays = factory(Holiday::class, $amount)->make([
                'created_at' => $member->created_at,
            ]);

            $member->holidays()->saveMany($holidays);
        });
    }
}
