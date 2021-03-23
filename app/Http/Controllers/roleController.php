<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyRoleRequest;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Permission;
use App\Role;
use App\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\DataTables;

class roleController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('role_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $permission = Permission::all();

        return view('pages.roles', compact('permission'));
    }


    public function store(Request $request)
    {
        $role = Role::create($request->all());
        $role->permissions()->sync($request->input('permissions', []));

        return response()->json([
            'success' => TRUE,
            'message' => __('locale.Done successfully')

        ]);
    }

    public function edit(Request $request, $id)
    {
        abort_if(Gate::denies('role_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');


        $role = Role::find($id);

        if ($role) {
            return response()->json($role);
        }
        return response(['message' => 'The operation failed'], 500);


    }

    public function update(Request $request, Role $role)
    {
        $data = $request->all();
        $role = Role::find($data['role_id']);
        $role->update($request->all());

        if (isset($data['permissions']) < 1) {
            return response()->json([
                'success' => False,
                'message' => __('locale.you must have at least one permission')

            ]);
        }
        $role->permissions()->sync($request->input('permissions', []));

        return response()->json([
            'success' => TRUE,
            'message' => __('locale.Done successfully')

        ]);
    }

    public function show(Request $request)
    {
        $data = $request->all();

        abort_if(Gate::denies('role_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $query = Role::query()->with('permissions')->orderBy('roles.title', 'desc')->get();

        return Datatables::of($query)
            ->addColumn('permission', function ($data) {
                $permissions = Permission::select('id', 'title')->get();

                $permission = '<select  onChange="changePermission(' . $data->id . ')"  id="role_id_' . $data->id . '" multiple class="select2 permissions validate browser-default ">';
                foreach ($permissions as $value) {
                    $permission .= "<option ";

                    foreach ($data->permissions as $value1) {


                        if ($value->id == $value1->id) {
                            $permission .= "selected ";

                        }
                    }

                    $permission .= " value='{$value->id}'>{$value->title}</option>";
                }
                $permission .= "</select>";
                return $permission;
            })
            ->addColumn('action', function ($data) {


                return '<a onclick="showModal(`roles`,' . $data->id . ')" href="javascript:;" class="btn btn-outline btn-circle btn-sm purple">edit' . '</a>  '
                    /*                    '<a onclick="showModal(`permissions`,' . $data->id . ')" href="javascript:;" class="btn btn-outline btn-circle btn-sm purple">edit' . '</a>  '*/
                    . '<a onclick="deleteThis(`roles`,' . $data->id . ')" href="javascript:;" class="btn btn-outline btn-circle btn-sm purple">delete' . '</a>';
            })
            ->rawColumns(['action' => 'action', 'permission' => 'permission'])
            ->toJson();
    }

    public function destroy(Request $request, $id)
    {
        abort_if(Gate::denies('role_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');


        Role::find($id)->delete();

        return response()->json([
            'success' => TRUE,
            'message' => __('locale.Done successfully')

        ]);
    }

    public function massDestroy(MassDestroyRoleRequest $request)
    {
        Role::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
