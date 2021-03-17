<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroySupplierRequest;
use App\Http\Requests\StoreSupplierRequest;
use App\Http\Requests\UpdateSupplierRequest;
use App\Permission;
use App\Role;
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
use app\Helpers\Helper;

class supplierController extends Controller
{


    public function index()
    {

        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $supplier = Supplier::get();

        $breadcrumbs = [
            ['link' => "modern", 'name' => "Home"], ['name' => "Supplier"],
        ];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true, 'isFabButton' => true];

        return view('pages.suppliers', compact('supplier'), ['pageConfigs' => $pageConfigs], ['breadcrumbs' => $breadcrumbs]);

    }


    public function show(Request $request)
    {
        abort_if(Gate::denies('user_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $data = $request->all();

        $suppliers = Supplier::query()->orderBy('id', 'desc');

        return Datatables::of($suppliers)
            ->addColumn('action', function ($data) {


                return '<a onclick="showModal(`suppliers`,' . $data->id . ')" href="javascript:;" class="btn btn-outline btn-circle btn-sm purple">edit' . '</a>  '
                    . '<a onclick="deleteThis(`suppliers`,' . $data->id . ')" href="javascript:;" class="btn btn-outline btn-circle btn-sm purple">delete' . '</a>';
            })
            ->rawColumns(['action' => 'action', 'role' => 'role'])
            ->toJson();
    }


    public function edit(Request $request, $id)
    {
        abort_if(Gate::denies('user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');


        $data = Supplier::find($id);

        if ($data) {
            return response()->json($data);
        }
        return response(['message' => 'The operation failed'], 500);

    }

    public function store(Request $request)
    {
        abort_if(Gate::denies('user_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $data = $request->all();

        if ($request->files) {

            foreach ($request->files as $name => $file) {

                $fileName = Helper::uploadDocument($file);
                $data[$name] = $fileName;
            }
        }

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

        $supplier = Supplier::create($data);

        if (!$supplier) {

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
        //  abort_if(Gate::denies('user_update'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $data = $request->all();

        if ($request->files) {

            foreach ($request->files as $name => $file) {

                $fileName = Helper::uploadDocument($file);
                $data[$name] = $fileName;
            }
        }
        $user = Supplier::find($data['id']);
        $user->update($data);

        return response()->json([
            'success' => TRUE,
            'message' => "Done successfully"
        ]);
    }

    public function destroy(Request $request, $id)
    {

        if (Supplier::find($id)->delete()) {
            return response()->json([
                'message' => 'Done successfully',
            ]);
        }

        return response(['message' => 'The operation failed'], 500);
    }


}













