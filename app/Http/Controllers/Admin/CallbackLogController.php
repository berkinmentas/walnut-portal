<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminUser;
use App\Models\CallbackLog;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CallbackLogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.callback-logs.index');
    }
    public function datatable() {

        $model = CallbackLog::query();

        return DataTables::eloquent($model)
            ->addColumn('actions', function(CallbackLog $callbackLog) {
                return '<a class="btn btn-outline-primary btn-sm btn-action me-3" href="'.route('admin.callbackLogs.show', ['callbackLog' => $callbackLog]).'">'.__('Görüntüle').'</a>';
            })
            ->rawColumns(['id', 'incoming_log_id', 'status', 'actions'])
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
    public function show(CallbackLog $callbackLog)
    {
        $callbackLog->load('incomingLog');
        return view('admin.callback-logs.show', [
            'callbackLog' => $callbackLog,
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
