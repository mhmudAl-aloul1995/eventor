<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyRoleRequest;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Permission;
use App\Role;
use App\Language;
use App\Supplier;
use App\User;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\DataTables;
use App;
class LanguageController extends Controller
{

    public function index()
    {

        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');


        $breadcrumbs = [
            ['link' => "home", 'name' => __('locale.Home')], ['name' => "Language"],
        ];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true, 'isFabButton' => true];

        return view('pages.languages', compact('breadcrumbs'), ['pageConfigs' => $pageConfigs], ['breadcrumbs' => $breadcrumbs]);

    }


    public function show(Request $request)
    {
        abort_if(Gate::denies('user_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $data = $request->all();

        $languages = Language::query()->orderBy('id', 'desc');

        return Datatables::of($languages)
            ->editColumn('status', function ($data) {
                $status = ($data->status == 1) ? __('locale.Active')  : __('locale.In Active');

                return $status;

                   })
            ->addColumn('action', function ($data) {


                return '<a onclick="showModal(`languages`,' . $data->id . ')" href="javascript:;" class="btn btn-outline btn-circle btn-sm purple">' . __('locale.Edit') .  '</a>  '
                    . '<a onclick="deleteThis(`languages`,' . $data->id . ')" href="javascript:;" class="btn btn-outline btn-circle btn-sm purple">' . __('locale.Delete') . '</a>';
            })
            ->rawColumns(['action' => 'action', 'role' => 'role'])
            ->toJson();
    }


    public function edit(Request $request, $id)
    {
        abort_if(Gate::denies('user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');


        $data = Language::find($id);

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
        if ($request->files) {

            foreach ($request->files as $name => $file) {

                $fileName = uploadDocument($file);
                $data[$name] = $fileName;

            }
        }

        $service = Language::create($data);

        if (!$service) {

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
        abort_if(Gate::denies('user_update'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $data = $request->all();
        $Language = Language::find($data['id']);

        if ($request->files) {

            foreach ($request->files as $name => $file) {

                $fileName = uploadDocument($file);
                removeFile('documentfiles/'.$Language[$name]);
                $data[$name] = $fileName;

            }
        }
        $Language->update($data);

        return response()->json([
            'success' => TRUE,
            'message' => __('locale.Done successfully')
        ]);
    }

    public function destroy(Request $request, $id)
    {

        if (Language::find($id)->delete()) {
            return response()->json([
                'message' => __('locale.Done successfully'),
            ]);
        }

        return response(['message' => 'The operation failed'], 500);
    }
    // set locale in session
    public function swap($locale){


        $availLocale = [
            'en'=>'en',
            'ar'=>'ar',

        ];
        if (array_key_exists($locale, $availLocale)) {

           dd(App::setLocale($locale));

        }
        return redirect()->back();
    }
}
