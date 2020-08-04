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
        Member::all()->each(function ($member) {

            // possible attachment names
            $names = collect(self::data());

            // 0-3 per attachments member
            $amount = rand(0, $names->count());

            // start from member's creation
            $now = $member->created_at->clone();

            // make attachments
            $attachments = factory(Attachment::class, $amount)->make([
                'name' => fn() => $names->shift(),
                'created_at' => fn() => $now->addDays(rand(0, 10)),
            ]);

            // save attachments
            $member->attachments()->saveMany($attachments);
        });
    }

    private static function data()
    {
        return [
            'terms & conditions',
            'id verification',
            'age verification',
            'address verification',
            'health status certificate',
        ];
    }
}
