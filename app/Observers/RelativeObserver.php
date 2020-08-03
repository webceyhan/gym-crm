<?php

namespace App\Observers;

use App\Relative;

class RelativeObserver
{
    /**
     * Handle the relative "created" event.
     *
     * @param  \App\Relative  $relative
     * @return void
     */
    public function created(Relative $relative)
    {
        // create cross-reference (without recursive loop)
        Relative::withoutEvents(function () use ($relative) {
            Relative::create([
                'owner_id' => $relative->member_id,
                'member_id' => $relative->owner_id,
            ]);
        });
    }

    /**
     * Handle the relative "updated" event.
     *
     * @param  \App\Relative  $relative
     * @return void
     */
    public function updated(Relative $relative)
    {
        //
    }

    /**
     * Handle the relative "deleted" event.
     *
     * @param  \App\Relative  $relative
     * @return void
     */
    public function deleted(Relative $relative)
    {
        // delete cross-reference (without recursive loop)
        Relative::withoutEvents(function () use ($relative) {
            Relative::where('owner_id', $relative->member_id)
                ->where('member_id', $relative->owner_id)
                ->delete();
        });
    }

    /**
     * Handle the relative "restored" event.
     *
     * @param  \App\Relative  $relative
     * @return void
     */
    public function restored(Relative $relative)
    {
        //
    }

    /**
     * Handle the relative "force deleted" event.
     *
     * @param  \App\Relative  $relative
     * @return void
     */
    public function forceDeleted(Relative $relative)
    {
        //
    }
}
