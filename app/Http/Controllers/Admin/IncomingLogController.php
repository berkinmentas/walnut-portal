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

    public function datatable(Request $request) {

        $model = IncomingLog::query();

        if ($request->has('startDate') && $request->startDate && $request->has('endDate') && $request->endDate) {
            $model->whereBetween('created_at', [
                $request->startDate . ' 00:00:00',
                $request->endDate . ' 23:59:59'
            ]);
        }

        return DataTables::eloquent($model)
            ->editColumn('created_at', function ($incomingLog) {
              return date('d-m-Y', strtotime($incomingLog->created_at));
            })
            ->addColumn('actions', function(IncomingLog $incomingLog) {
                return '<a class="btn btn-outline-primary btn-sm btn-action me-3" href="'.route('admin.incomingLogs.show', ['incomingLog' => $incomingLog]).'">'.__('Görüntüle').'</a>';
            })
            ->rawColumns(['id', 'title', 'word_count', 'created_at', 'actions'])
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
    public function show(IncomingLog $incomingLog)
    {
        $incomingLog->load('incomingLogData');
        return view('admin.incoming-logs.show', [
            'incomingLog' => $incomingLog,
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
