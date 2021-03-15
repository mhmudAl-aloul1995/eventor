@extends('layouts/contentLayoutMaster')


{{-- page title --}}
@section('title','users')

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
    <div id="usersModal" class="modal ">

        <div class="modal-content">
            <h4>User</h4>

            <div class="row">
                <form id="usersForm" action="" class="col s12">
                    <input name="id" type="hidden" value="">

                    <div class="row">
                        <div class="input-field col s6">
                            <input placeholder="Username" name="name" type="text" class="validate">
                            <label for="Username">Username</label>
                        </div>
                        <div class="input-field col s6">
                            <input placeholder="email" name="email" type="email" class="validate">
                            <label for="email">Email</label>
                        </div>


                    </div>

                </form>
            </div>

        </div>
        <div class="modal-footer">
            <a href="#!" onclick="submitForm('users')" class="modal-action  waves-effect waves-green btn-flat">Agree</a>
        </div>
    </div>
    <div class="section section-data-tables">
        <div class="card">
            <div class="card-content">
                <a onclick="showModal('users',null)" class="waves-effect waves-light btn">Add New</a>


            </div>
        </div>


        <!-- Users -->
        <div class="row">
            <div class="col s12">
                <div class="card">
                    <div class="card-content">
                        <h4 class="card-title">Users</h4>
                        <div class="row">
                            <div class="col s12">
                                <table id="usersTable" class="display">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Roles</th>
                                        <th>Action</th>
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

        $(document).ready(function () {
            var users = $('#usersTable').DataTable({
                processing: true,
                serverSide: true,
                "initComplete": function (oSettings, json) {
                    $(".roles").select2();


                },
                "drawCallback": function (oSettings, json) {
                    $(".roles").select2();


                    $('.roles').on('change',function () {
                        var ids = $(this).val();
                        var str = $(this).attr('id');
                        var user_id = str.split("_")[2];
                        $.ajax({
                            url: links + '/updateRoleUsers/',
                            data: {_token: token, roles: ids, user_id:user_id},
                            type: "POST",
                            success: function (data, textStatus, jqXHR) {


                            },
                            error: function (data, textStatus, jqXHR) {
                                console.log(data)

                                M.toast({html: data.message})

                            },
                        });

                    });

                },
                ajax: {
                    url: "{{url('users/{user}')}}",
                    data: function (d) {
                        // d.orph_mom_name = $('#orph_mom_name_search').val();
                    },
                    type: "GET"


                },
                dom: "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",
                buttons: [
                    'copy', 'excel', 'pdf',

                    {
                        text: 'reload',
                        className: 'btn green reload usersTable',
                        action: function (e, dt, node, config) {
                            dt.ajax.reload();
                        }
                    },
                ],
                columns: [
                    {className: 'text-center', data: 'name', name: 'name', searchable: true},
                    {className: 'text-center', data: 'email', name: 'email', searchable: true},
                    {className: 'text-center', data: 'role', name: 'role', searchable: true},
                    {className: 'text-center', data: 'action', name: 'action', searchable: false},

                ],
            });


        })
        $("#usersForm").validate({
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
                usersname: {
                    required: "Enter a usersname",
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