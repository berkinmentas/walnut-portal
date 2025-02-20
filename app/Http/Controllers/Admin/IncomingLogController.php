<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CallbackLog;
use App\Models\IncomingLog;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class IncomingLogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.incoming-logs.index');
    }

    public function datatable() {

        $model = IncomingLog::query();

        return DataTables::eloquent($model)
            ->addColumn('actions', function(IncomingLog $incomingLog) {
                $action = '<a class="btn btn-outline-primary btn-sm btn-action me-3" href="'.route('admin.incomingLogs.edit', ['incomingLog' => $incomingLog]).'">'.__('Görüntüle').'</a>';
                $action .= '<a data-id="' . $incomingLog->id . '" data-url="' . route('admin.incomingLogs.destroy', ['incomingLog' => $incomingLog]) . '" role="button" class="btn btn-outline-danger btn-sm btn-delete">'.__('Sil').'</a>';

                return $action;
            })
            ->rawColumns(['id', 'title', 'word_count', 'actions'])
            ->make();
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(IncomingLog $log)
    {
        $log->load('incomingLogData', 'callbackLogs');
        return view('admin.incoming-logs.show', [
            'log' => $log,
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
