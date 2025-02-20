<?php

namespace App\Observers;

use App\Jobs\SendTestReceiverRequest;
use App\Models\CallbackLog;
use App\Models\IncomingLog;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class IncomingLogObserver
{
    /**
     * Handle the IncomingLog "created" event.
     */

    public function created(IncomingLog $incomingLog)
    {
        dispatch(new SendTestReceiverRequest($incomingLog));
    }

    /**
     * Handle the IncomingLog "updated" event.
     */
    public function updated(IncomingLog $incomingLog): void
    {
        //
    }

    /**
     * Handle the IncomingLog "deleted" event.
     */
    public function deleted(IncomingLog $incomingLog): void
    {
        //
    }

    /**
     * Handle the IncomingLog "restored" event.
     */
    public function restored(IncomingLog $incomingLog): void
    {
        //
    }

    /**
     * Handle the IncomingLog "force deleted" event.
     */
    public function forceDeleted(IncomingLog $incomingLog): void
    {
        //
    }
}
