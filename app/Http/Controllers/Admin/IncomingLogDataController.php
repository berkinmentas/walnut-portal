<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\IncomingLogData;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class IncomingLogDataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.incoming-log-datas.index');
    }
    public function datatable() {

        $model = IncomingLogData::query();

        return DataTables::eloquent($model)
            ->addColumn('actions', function(IncomingLogData $incomingLogData) {
                return '<a class="btn btn-outline-primary btn-sm btn-action me-3" href="'.route('admin.incomingLogDatas.edit', ['incomingLogData' => $incomingLogData]).'">'.__('Görüntüle').'</a>';
            })
            ->rawColumns(['id', 'payload', 'inserted', 'actions'])
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
    public function show(IncomingLogData $logData)
    {
        $logData->load('incomingLogs.callbackLogs');
        return view('admin.incoming-log-data.show', [
            'logData' => $logData,
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
