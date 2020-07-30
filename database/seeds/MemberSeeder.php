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
        $amount = 50;

        factory(Member::class, $amount)->create([
            'created_at' => fn() => now()->subYears(rand(0, 5)),
        ]);
    }
}
