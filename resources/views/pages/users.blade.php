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
                        <div class="input-field col s4">
                            <input placeholder="{{__('locale.Username')}}" name="name" type="text" class="validate">
                            <label for="username">{{__('locale.Username')}}</label>
                        </div>
                        <div class="input-field col s4">
                            <input placeholder="{{__('locale.Email')}}" name="email" type="email" class="validate">
                            <label for="email">{{__('locale.Email')}}</label>
                        </div>
                        <div class="input-field col s4">
                            <input placeholder="{{__('locale.Phone')}}" name="phone" type="text" class="validate">
                            <label for="phone">{{__('locale.Phone')}}</label>
                        </div>


                    </div>
                    <div class="row">

                        <div class="input-field col s4">
                            <input placeholder="{{__('locale.Address')}}" name="address" type="text" class="validate">
                            <label for="address">{{__('locale.Address')}}</label>
                        </div>
                        <div class="input-field col s4">
                            <input  placeholder="{{__('locale.Lat')}}" name="lat" type="text" class="validate">
                            <label for="lat">{{__('locale.Lat')}}</label>
                        </div>
                        <div class="input-field col s4">
                            <input  placeholder="{{__('Locale.Long')}}" name="long" type="text" class="validate">
                            <label for="long">{{__('Locale.Long')}}</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s4">
                            <input  placeholder="{{__('locale.Ip Number')}}" name="ip_number" type="text" class="validate">
                            <label for="ip_number">{{__('locale.Ip Number')}}</label>
                        </div>
                        <div class="input-field col s4">
                            <label for="city_id" class="active">{{__('locale.City')}}</label>

                            <select placeholder="{{__('locale.City')}}" required name="city_id" class=" validate  ">
                                 <option    value="">{{__('locale.City')}}</option>

                                @foreach($city as $value)
                                    <option value="{{$value->id}}">{{$value->name}}</option>
                                @endforeach

                            </select>

                        </div>
                        <div class="input-field col s4">
                            <label for="country_id" class="active">{{__('locale.Country')}}</label>

                            <select placeholder="{{__('locale.Country')}}" required name="country_id" class=" validate  ">
                                 <option    value="">{{__('locale.Country')}}</option>

                                @foreach($country as $value)
                                    <option value="{{$value->id}}">{{$value->name}}</option>
                                @endforeach

                            </select>

                        </div>


                    </div>
                    <div class="row">
                        <div class="input-field col s4">
                            <label for="status" class="active">{{__('locale.Status')}}</label>

                            <select placeholder="{{__('locale.Status')}}" required name="status" class=" validate  ">
                                 <option    value="">{{__('locale.Status')}}</option>
                                <option value="0">{{__('locale.Active')}}</option>
                                <option value="1">{{__('locale.In Active')}}</option>


                            </select>

                        </div>
                        <div class="input-field col s4">
                            <label for="status" class="active">{{__('locale.Gender')}}</label>

                            <select placeholder="{{__('locale.Gender')}}" required name="gender" class=" validate  ">
                                 <option    value="">{{__('locale.Gender')}}</option>
                                <option value="0">{{__('locale.Male')}}</option>
                                <option value="1">{{__('locale.Female')}}</option>


                            </select>

                        </div>
                        <div class="input-field col s4">
                            <label for="enable_notification" class="active">{{__('locale.Enable Notification')}}</label>

                            <select placeholder="{{__('locale.Enable Notification')}}" required name="enable_notification"
                                    class=" validate  ">
                                 <option    value="">{{__('locale.Enable Notification')}}</option>
                                <option value="0">{{__('locale.Yes')}}</option>
                                <option value="1">{{__('locale.No')}}</option>
                            </select>

                        </div>


                    </div>
                    <div class="row">
                        <div class="input-field col s4">
                            <label for="enable_notification" class="active">{{__('locale.Roles')}}</label>

                            <select placeholder="{{__('locale.Roles')}}" required name="role_id" class=" validate  ">
                                <option     value="">{{__('locale.Roles')}}</option>
                                @foreach($roles as $value)
                                <option value="{{$value->id}}">{{$value->title}}</option>
                                @endforeach
                            </select>

                        </div>

                        <div class="input-field col s4">
                            <input placeholder="Last login" name="last_login" type="text" class="validate">
                            <label for="last_login">{{__('locale.Last login')}}</label>
                        </div>
                        <div class="file-field input-field col s6">
                            <div class="btn-small">
                                <span>{{__('locale.Image')}}</span>
                                <input type="file">
                            </div>
                            <div class="file-path-wrapper">
                                <input placeholder="{{__('locale.Image')}}" name="image" class="file-path validate" type="file">
                            </div>
                        </div>


                    </div>

                </form>
            </div>

        </div>
        <div class="modal-footer">
            <a href="#!" onclick="submitForm('users')" class="modal-action  waves-effect waves-green btn-flat">{{__('locale.Agree')}}</a>
        </div>
    </div>
    <div class="section section-data-tables">
        <div class="card">
            <div class="card-content">
                <a onclick="showModal('users',null)" class="waves-effect waves-light btn">{{__('locale.Add New')}}</a>
                <a onclick="reloadTable('users',null)" class="waves-effect green waves-light btn">{{__('locale.Reload')}}</a>


            </div>
        </div>


        <!-- Users -->
        <div class="row">
            <div class="col s12">

                <div class="card">
                    <div class="card-content">
                        <h4 class="card-title">{{__('locale.User')}}</h4>
                        <div class="row">
                            <div class="col s12">
                                <table id="usersTable" class="display">
                                    <thead>
                                    <tr>
                                        <th>{{__('locale.Name')}}</th>
                                        <th>{{__('locale.Email')}}</th>
                                        <th>{{__('locale.Address')}}</th>
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
        function searchRoles() {


        }

        var users = $('#usersTable').DataTable({
            processing: true,
            serverSide: true,

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
                {className: 'text-center', data: 'address', name: 'address', searchable: true},
                {className: 'text-center', data: 'action', name: 'action', searchable: false},

            ],
        });

        $(document).ready(function () {


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