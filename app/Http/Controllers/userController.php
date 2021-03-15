<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Permission;
use App\Role;
use App\User;
use Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class userController extends Controller
{


    public function index()
    {

        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roles = Role::get();

        $breadcrumbs = [
            ['link' => "modern", 'name' => "Home"], ['name' => "User"],
        ];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true, 'isFabButton' => true];

        return view('pages.users', compact('roles'), ['pageConfigs' => $pageConfigs], ['breadcrumbs' => $breadcrumbs]);

    }


    public function show(Request $request)
    {
        $data = $request->all();
        abort_if(Gate::denies('user_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');


        $users = User::query()->with('roles')->orderBy('id', 'asc');

        return Datatables::of($users)
            ->addColumn('role', function ($data) {
                $roles = Role::select('id', 'title')->get();
                $role = '<select id="user_id_'.$data->id.'" multiple class="select2 roles validate browser-default ">';
                foreach ($roles as $value) {
                    $role .= "<option ";

                    foreach ($data->roles as $value1) {


                        if ($value->id == $value1->id) {
                            $role .= "selected ";

                        }
                    }

                    $role .= " value='{$value->id}'>{$value->title}</option>";
                }
                $role .= "</select>";
                return $role;
            })

            ->addColumn('action', function ($data) {


                return '<a onclick="showModal(`users`,' . $data->id . ')" href="javascript:;" class="btn btn-outline btn-circle btn-sm purple">edit' . '</a>  '
                    . '<a onclick="deleteThis(`users`,' . $data->id . ')" href="javascript:;" class="btn btn-outline btn-circle btn-sm purple">delete' . '</a>';
            })
             ->rawColumns(['action' => 'action', 'role' => 'role'])

            ->toJson();
    }


    public function edit(Request $request, $id)
    {

        $data = User::find($id);

        if ($data) {
            return response()->json($data);
        }
        return response(['message' => 'The operation failed'], 500);

    }

    public function store(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')],
            'name' => ['required']
        ]);
        if ($validator->failed()) {

            return response()->json([
                'success' => FALSE,
                'message' => $validator->errors(),

            ]);
        }
        $data['password'] = Hash::make($data['name']);

        $user = User::create($data);
        $user->roles()->sync($request->input('roles', []));

        if (!$data) {

            return response()->json([
                'success' => FALSE,
                'message' => "An error occurred during insertion"

            ]);
        }
        return response()->json([
            'success' => TRUE,
            'message' => "Done successfully"

        ]);
    }

    public function update(Request $request)
    {
        $data = $request->all();

        abort_if(Gate::denies('user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $user = User::find($data['user_id']);
        $user->update($request->all());
        $user->roles()->sync($request->input('roles', []));

        return response()->json([
            'success' => TRUE,
            'message' => "Done successfully"
        ]);
    }

    public function destroy(Request $request, $id)
    {

        if (User::find($id)->delete()) {
            return response()->json([
                'message' => 'Done successfully',
            ]);
        }

        return response(['message' => 'The operation failed'], 500);
    }


}













