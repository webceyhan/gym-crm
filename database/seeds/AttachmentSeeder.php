<?php

use App\Attachment;
use App\Member;
use Illuminate\Database\Seeder;

class AttachmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Member::inRandomOrder()->take(10)->get()->each(function ($member) {

            $amount = rand(1, 5);

            $attachments = factory(Attachment::class, $amount)->make([
                'created_at' => $member->created_at,
            ]);

            $member->attachments()->saveMany($attachments);
        });
    }
}
