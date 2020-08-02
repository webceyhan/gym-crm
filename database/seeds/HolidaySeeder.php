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
        $config = config('seeder.member.holiday');

        Member::all()->shuffle()->each(function ($member) use ($config) {

            // starting from member creation
            $now = $member->created_at->clone();

            $holidays = factory(Holiday::class, rand(...$config['count']))->make();

            $holidays->each(function ($holiday) use ($now, $config) {
                $holiday->created_at = $now->addMonths(rand(...$config['gap_months']))->clone();
                $holiday->start_date = $now->addDays(rand(...$config['delay_days']))->clone();
                $holiday->end_date = $now->addDays(rand(...$config['days']))->clone();
            });

            $member->holidays()->saveMany($holidays);
        });
    }
}
