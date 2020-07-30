<?php

use App\Plan;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $amount = 10;

        factory(Plan::class, $amount)->create([
            'created_at' => fn() => now()->subYears(rand(0,5))
        ]);
    }
}
