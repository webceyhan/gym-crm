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
        Member::all()->each(function ($member) {

            // 0-4 holiday per member
            $amount = rand(0, 4);

            // start from member's creation
            $now = $member->created_at->clone();

            // make holidays
            $holidays = factory(Holiday::class, $amount)->make();

            // customize holidays
            $holidays->each(function ($holiday) use ($now) {
                // schedule 2-3 months after previous one
                $holiday->created_at = $now->addMonths(rand(2, 3))->clone();

                // delay 0-10 days after scheduled date
                $holiday->start_date = $now->addDays(rand(0, 10))->clone();

                // count between 5-30 days to finish
                $holiday->end_date = $now->addDays(rand(5, 30))->clone();
            });

            // save holidays
            $member->holidays()->saveMany($holidays);
        });
    }
}
