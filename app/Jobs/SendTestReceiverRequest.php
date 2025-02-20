<?php

namespace App\Jobs;

use App\Models\CallbackLog;
use App\Models\IncomingLog;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class SendTestReceiverRequest implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $incomingLog;
    /**
     * Create a new job instance.
     */
    public function __construct(IncomingLog $incomingLog)
    {
        $this->incomingLog = $incomingLog;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            $response = Http::withHeaders([
                'X-API-KEY' => config('app.api_key'),
                'Accept' => 'application/json'
            ])->post(config('app.api_base_url') . "/test-receiver", [
                    'title' => $this->incomingLog->title,
                    'word_count' => $this->incomingLog->word_count
                ]);

            CallbackLog::query()->create([
                'incoming_log_id' => $this->incomingLog->id,
                'status' => $response->json('ok') ? 'confirmed' : 'pending',
                'result' => json_encode($response->json())
            ]);
        } catch (\Exception $e) {
            CallbackLog::query()->create([
                'incoming_log_id' => $this->incomingLog->id,
                'status' => 'pending',
                'result' => $e->getMessage()
            ]);
        }
    }
}
