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
        $members = Member::inRandomOrder()->take(10)->get();

        $members->each(function ($member) {
            $attachments = factory(Attachment::class, rand(1, 5))->make();
            $member->attachments()->saveMany($attachments);
        });
    }
}
