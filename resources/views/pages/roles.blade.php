@extends('layouts/contentLayoutMaster')


{{-- page title --}}
@section('title','roles')

{{-- vendor styles --}}
@section('vendor-style')
    <link rel="stylesheet" type="text/css" href="{{asset('vendors/flag-icon/css/flag-icon.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('vendors/data-tables/css/jquery.dataTables.min.css')}}">
    <link rel="stylesheet" type="text/css"
          href="{{asset('vendors/data-tables/extensions/responsive/css/responsive.dataTables.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('vendors/data-tables/css/select.dataTables.min.css')}}">
@endsection
@section('page-style')
    <link rel="stylesheet" type="text/css" href="{{asset('css/pages/data-tables.css')}}">
@endsection


{{-- page content --}}
@section('content')


    <!-- Modal Structure -->
    <div id="rolesModal" class="modal ">

        <div class="modal-content">
            <h4>User</h4>

            <div class="row">
                <form id="rolesForm" action="" class="col s12">
                    <input name="id" type="hidden" value="">

                    <div class="row">
                        <div class="input-field col s6">
                            <input placeholder="Title" name="title" type="text" class="validate">
                            <label for="Username">{{__('locale.Role')}}</label>
                        </div>

                    </div>
                </form>
            </div>

        </div>
        <div class="modal-footer">
            <a href="#!" onclick="submitForm('roles')"
               class="modal-action  waves-effect waves-green btn-flat">{{__('locale.Agree')}}</a>
        </div>
    </div>
    <div class="section section-data-tables">
        <div class="card">
            <div class="card-content">
                <a onclick="showModal('roles',null)" class="waves-effect waves-light btn">{{__('locale.Add New')}}</a>
                <a onclick="reloadTable('roles',null)" class="waves-effect green waves-light btn">{{__('locale.Reload')}}</a>


            </div>
        </div>


        <!-- Roles -->
        <div class="row">
            <div class="col s12">
                <div class="card">
                    <div class="card-content">
                        <h4 class="card-title">{{__('locale.Roles')}}</h4>
                        <div class="row">
                            <div class="col s12">
                                <table id="rolesTable" class="display">
                                    <thead>
                                    <tr>
                                        <th>{{__('locale.Role')}}</th>
                                        <th>{{__('locale.Permission')}}</th>
                                        <th>{{__('locale.Action')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>


                                    </tbody>
                                    {{--  <tfoot>
                                      <tr>
                                          <th>Name</th>
                                          <th>Position</th>
                                          <th>Office</th>
                                          <th>Age</th>
                                          <th>Start date</th>
                                          <th>Salary</th>
                                      </tr>
                                      </tfoot>--}}
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection

{{-- vendor scripts --}}
@section('vendor-script')
    <script src="{{asset('vendors/data-tables/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('vendors/data-tables/extensions/responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('vendors/data-tables/js/dataTables.select.min.js')}}"></script>

@endsection

{{-- page script --}}
@section('page-script')
    {{--
          <script src="{{asset('js/scripts/data-tables.js')}}"></script>
    --}}



    <script>
        function changePermission(role_id) {

            var ids = $("#role_id_" + role_id).val()
            $.ajax({
                url: links + '/updateRolePermissions',
                data: {_token: token, permissions: ids, role_id: role_id},
                type: "POST",
                success: function (data, textStatus, jqXHR) {
                    M.toast({html: data.message})

                    $("#rolesTable").DataTable().ajax.reload()

                },
                error: function (data, textStatus, jqXHR) {
                    console.log(data)

                    M.toast({html: data.message})
                    $("#rolesTable").DataTable().ajax.reload()

                },
            });

        }

        $(document).ready(function () {


            var roles = $('#rolesTable').DataTable({
                processing: true,
                serverSide: true,
                "initComplete": function (oSettings, json) {
                    $(".permissions").select2();


                },
                "drawCallback": function (oSettings, json) {
                    $(".permissions").select2();


                },
                ajax: {
                    url: "{{url('roles/{user}')}}",
                    data: function (d) {

                    },
                    type: "GET"


                },
                dom: "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",
                buttons: [
                    'copy', 'excel', 'pdf',

                    {
                        text: 'reload',
                        className: 'btn green reload rolesTable',
                        action: function (e, dt, node, config) {
                            dt.ajax.reload();
                        }
                    },
                ],
                columns: [
                    {className: 'text-center', data: 'title', name: 'title', searchable: true},
                    {className: 'text-center', data: 'permission', name: 'permission', searchable: true},
                    {className: 'text-center', data: 'action', name: 'action', searchable: false},

                ],
            });


        })


        $("#rolesForm").validate({
            rules: {
                name: {
                    required: true,
                    minlength: 5
                },
                email: {
                    required: true,
                    email: true
                },

            },
            //For custom messages
            messages: {
                rolesname: {
                    required: "Enter a rolesname",
                    minlength: "Enter at least 5 characters"
                },
                curl: "Enter your website",
            },
            errorElement: 'div',
            errorPlacement: function (error, element) {
                var placement = $(element).data('error');
                if (placement) {
                    $(placement).append(error)
                } else {
                    error.insertAfter(element);
                }
            }
        });
    </script>
@endsection