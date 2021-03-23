<?php

namespace App\Http\Controllers;

use App\City;
use App\Country;
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

        $roles = Role::all();
        $country = Country::all();
        $city = City::all();

        $breadcrumbs = [
            ['link' => "modern", 'name' => __('locale.Home')], ['name' => __('locale.User')],
        ];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true, 'isFabButton' => true];

        return view('pages.users', compact('roles', 'country', 'city'), ['pageConfigs' => $pageConfigs], ['breadcrumbs' => $breadcrumbs]);

    }


    public function show(Request $request)
    {
        $data = $request->all();


        $users = User::query()->with('roles')->where('id', '!=', Auth::id())->orderBy('id', 'asc');

        return Datatables::of($users)
            ->addColumn('role', function ($data) {
                $roles = Role::select('id', 'title')->get();
                $role = '<select id="user_id_' . $data->id . '" multiple class="select2 roles validate browser-default ">';
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


                return '<a onclick="showModal(`users`,' . $data->id . ')" href="javascript:;" class="btn btn-outline btn-circle btn-sm purple">' . __('locale.Edit') . '</a>  '
                    . '<a onclick="deleteThis(`users`,' . $data->id . ')" href="javascript:;" class="btn btn-outline btn-circle btn-sm purple">' . __('locale.Delete') . '</a>';
            })
            ->rawColumns(['action' => 'action', 'role' => 'role'])
            ->toJson();
    }


    public function edit(Request $request, $id)
    {

        $data = User::find($id)->load('roles');

        if ($data) {
            return response()->json($data);
        }
        return response(['message' => __('locale.The operation failed')], 500);

    }

    public function store(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'name' => 'required|unique:users',
            'email' => 'required|email|unique:users',

        ]);

        if (count($validator->errors()) > 0) {
            return response()->json([
                'success' => FALSE,
                'message' => $validator->errors()->all()[0],

            ]);
        }

        if ($validator->failed()) {

            return response()->json([
                'success' => FALSE,
                'message' => $validator->errors(),

            ]);
        }
        $data['password'] = Hash::make($data['name']);

        $user = User::create($data);
        $user->roles()->sync($data['role_id']);

        if (!$data) {

            return response()->json([
                'success' => FALSE,
                'message' => __('locale.An error occurred during insertion')

            ]);
        }
        return response()->json([
            'success' => TRUE,
            'message' => __('locale.Done successfully')

        ]);
    }

    public function update(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'email' => 'required|email|unique:users,email,' . $data['id'],
            'name' => 'required|unique:users,name,' . $data['id'],

        ]);
        if (count($validator->errors()) > 0) {
            return response()->json([
                'success' => FALSE,
                'message' => $validator->errors()->all()[0],

            ]);
        }

        if ($validator->failed()) {

            return response()->json([
                'success' => FALSE,
                'message' => $validator->errors(),

            ]);
        }

        $user = User::find($data['id']);
        $user->update($request->all());
        if (isset($data['role_id'])) {

            return response()->json(['success' => TRUE, 'message' => __('locale.Done successfully')]);
        }
        $user->roles()->sync($data['role_id']);

        return response()->json(['success' => TRUE, 'message' => __('locale.Done successfully')]);
    }

    public function destroy(Request $request, $id)
    {

        if (User::find($id)->delete()) {
            return response()->json([
                'message' => __('locale.Done successfully'),
            ]);
        }

        return response(['message' => __('locale.The operation failed')], 500);
    }


}













