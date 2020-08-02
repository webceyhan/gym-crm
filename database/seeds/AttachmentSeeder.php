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
        $config = config('seeder.member.attachment');

        Member::all()->shuffle()->each(function ($member) use ($config) {

            // starting from member creation
            $now = $member->created_at->clone();

            $attachments = factory(Attachment::class, rand(...$config['count']))->make([
                'created_at' => fn() => $now->addDays(rand(...$config['delay_days'])),
            ]);

            $member->attachments()->saveMany($attachments);
        });
    }
}
