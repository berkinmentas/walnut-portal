<?php

namespace App\Observers;

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
        DB::transaction(function () use ($incomingLog) {
            try {
                $response = Http::post('/test-reciever', [
                    'title' => $incomingLog->title,
                    'word_count' => $incomingLog->word_count
                ]);

                CallbackLog::query()->create([
                    'incoming_log_id' => $incomingLog->id,
                    'status' => $response->json('ok') ? 'confirmed' : 'pending',
                    'result' => json_encode($response->json())
                ]);

            } catch (\Exception $e) {
                CallbackLog::query()->create([
                    'incoming_log_id' => $incomingLog->id,
                    'status' => 'pending',
                    'result' => $e->getMessage()
                ]);
            }
        });
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
