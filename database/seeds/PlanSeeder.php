<?php

use App\Plan;
use App\PlanType;
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
        $config = config('seeder.plan');
        $now = config('seeder.now')->clone();

        $plans = factory(Plan::class, $config['count'])->make();

        $plans->each(function ($plan, $i) use ($now, $config) {

            $months = $i * 3 >= 12 ? 12 : ($i * 3); // max 1 year
            $discount = 1 - $config['discount_rate']; // multiplier
            $tag = $config['tags'][$i] ?? $config['tags'][0]; // unique

            // set defaults
            $plan->duration = $months;
            $plan->name = "${tag} - indefinite";
            $plan->type = PlanType::INDEFINITE;
            $plan->price = $config['monthly_fee'];
            $plan->created_at = $now->addDays($i * 10);

            // set specific plans
            if ($plan->duration > 0) {
                $plan->name = "${tag} - " . ($months < 12 ? "${months} months" : "1 year");
                $plan->type = $months < 12 ? PlanType::MONTHLY : PlanType::YEARLY;
                $plan->price = $config['monthly_fee'] * $discount * $months;
            }

            $plan->save();
        });
    }
}
