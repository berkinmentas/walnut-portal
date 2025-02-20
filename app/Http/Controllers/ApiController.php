<?php

namespace App\Http\Controllers;

use App\Models\CallbackLog;
use App\Models\IncomingLog;
use App\Models\IncomingLogData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class ApiController extends Controller
{
    public function callback(Request $request)
    {
        if (!is_array($request->all())) {
            throw ValidationException::withMessages(['error' => 'Geçersiz veri formatı. Dizi bekleniyor.']);
        }

        $validated = $request->validate([
            '*.source' => 'required|string',
            '*.title' => 'required|string',
            '*.word_count' => 'required|integer'
        ]);

        DB::beginTransaction();
        try {
            $logData = IncomingLogData::query()->create([
                'payload' => $validated,
                'inserted' => []
            ]);

            $insertedNews = [];
            foreach ($validated as $news) {

                $exists = IncomingLog::query()
                    ->where('title', $news['title'])
                    ->exists();

                if (!$exists) {
                    $incomingLog = IncomingLog::query()->create([
                        'source' => $news['source'],
                        'title' => $news['title'],
                        'word_count' => $news['word_count'],
                        'incoming_log_data_id' => $logData->id
                    ]);
                    $insertedNews[] = $news;
                }
            }

            $logData->update(['inserted' => $insertedNews]);

            DB::commit();

            return response()->json([
                'inserted_count' => count($insertedNews)
            ]);

        } catch (\Exception $exception) {
            DB::rollBack();
            throw ValidationException::withMessages([
                'error' => $exception->getMessage()
            ]);
        }
    }

    public function testReceiver(Request $request)
    {
        return response()->json([
            'ok' => true,
            'title' => $request->input('title')
        ]);
    }
}
