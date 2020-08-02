<?php

use App\Member;
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
        $config = config('seeder.member');
        $now = config('seeder.now')->clone();

        factory(Member::class, $config['count'])->create([
            'created_at' => fn() => $now->addDays(rand(0, 7)),
        ]);
    }
}
