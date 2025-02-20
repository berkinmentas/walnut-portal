<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminUser\StoreRequest;
use App\Http\Requests\Admin\AdminUser\UpdateRequest;
use App\Models\AdminUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Yajra\DataTables\Facades\DataTables;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.users.index');
    }
    public function datatable() {

        $model = AdminUser::query();

        return DataTables::eloquent($model)
            ->editColumn('created_at', function(AdminUser $adminUser) {
                return date('d-m-Y', strtotime($adminUser->created_at));
            })
            ->addColumn('actions', function(AdminUser $user) {
                $action = '<a class="btn btn-outline-primary btn-sm btn-action me-3" href="'.route('admin.users.edit', ['user' => $user]).'">'.__('Görüntüle').'</a>';
                $action .= '<a data-id="' . $user->id . '" data-url="' . route('admin.users.destroy', ['user' => $user]) . '" role="button" class="btn btn-outline-danger btn-sm btn-delete">'.__('Sil').'</a>';

                return $action;
            })
            ->rawColumns(['id', 'email', 'actions'])
            ->make();
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        DB::beginTransaction();
        try {
            $req = $request->validated();

            $user = AdminUser::query()->create([
                'email' => $req['email'],
                'password' => bcrypt($req['password']),
            ]);

            if (!$user)
                throw new \Exception(__('Kullanıcı oluşturulamadı'));

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            throw ValidationException::withMessages([$exception->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AdminUser $user)
    {
        return view('admin.users.edit', [
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, AdminUser $user)
    {
        DB::beginTransaction();
        try {
            $req = $request->validated();

            $updateData = ['email' => $req['email']];

            if ($req['password'])
                $updateData['password'] = bcrypt($req['password']);

            if (!$user->update($updateData))
                throw new \Exception(__('Kullanıcı güncellenemedi'));

            DB::commit();
            return redirect()->route('admin.users.index')->with('success', 'Kullanıcı güncellendi');

        } catch (\Exception $exception) {
            DB::rollBack();
            throw ValidationException::withMessages([$exception->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AdminUser $user)
    {
        try {
            $deleted = $user->delete();

            if (!$deleted)
                throw new \Exception(__('Kullanıcı silinemedi'));

        } catch (\Exception $exception) {
            throw ValidationException::withMessages([$exception->getMessage()]);
        }
    }
}
