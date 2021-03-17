<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyServiceRequest;
use App\Http\Requests\StoreServiceRequest;
use App\Http\Requests\UpdateServiceRequest;
use App\Permission;
use App\Role;
use App\Service;
use App\Supplier;
use Carbon\Carbon;
use Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class serviceController extends Controller
{


    public function index()
    {

        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $supplier = Supplier::get();

        $breadcrumbs = [
            ['link' => "modern", 'name' => "Home"], ['name' => "Service"],
        ];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true, 'isFabButton' => true];

        return view('pages.services', compact('supplier'), ['pageConfigs' => $pageConfigs], ['breadcrumbs' => $breadcrumbs]);

    }


    public function show(Request $request)
    {
        abort_if(Gate::denies('user_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $data = $request->all();

        $services = Service::query()->with('supplier')->orderBy('id', 'desc');

        return Datatables::of($services)
            ->addColumn('action', function ($data) {


                return '<a onclick="showModal(`services`,' . $data->id . ')" href="javascript:;" class="btn btn-outline btn-circle btn-sm purple">edit' . '</a>  '
                    . '<a onclick="deleteThis(`services`,' . $data->id . ')" href="javascript:;" class="btn btn-outline btn-circle btn-sm purple">delete' . '</a>';
            })
            ->rawColumns(['action' => 'action', 'role' => 'role'])
            ->toJson();
    }


    public function edit(Request $request, $id)
    {
        abort_if(Gate::denies('user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');


        $data = Service::find($id);

        if ($data) {
            return response()->json($data);
        }
        return response(['message' => 'The operation failed'], 500);

    }

    public function store(Request $request)
    {
        abort_if(Gate::denies('user_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $data = $request->all();

        $validator = Validator::make($data, [
            'name' => ['required']
        ]);
        if ($validator->failed()) {

            return response()->json([
                'success' => FALSE,
                'message' => $validator->errors(),

            ]);
        }
        $data['password'] = Hash::make($data['name']);

        $service = Service::create($data);

        if (!$service) {

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
        abort_if(Gate::denies('user_update'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $data = $request->all();

        $user = Service::find($data['user_id']);
        $user->update($request->all());
        $user->roles()->sync($request->input('roles', []));

        return response()->json([
            'success' => TRUE,
            'message' => "Done successfully"
        ]);
    }

    public function destroy(Request $request, $id)
    {

        if (Service::find($id)->delete()) {
            return response()->json([
                'message' => 'Done successfully',
            ]);
        }

        return response(['message' => 'The operation failed'], 500);
    }


}













