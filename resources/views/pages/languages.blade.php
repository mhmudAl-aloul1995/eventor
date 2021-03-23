@extends('layouts/contentLayoutMaster')


{{-- page title --}}
@section('title','languages')

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
    <div id="languagesModal"  class="modal ">

        <div class="modal-content">
            <h4>Service</h4>

            <div class="row">
                <form id="languagesForm" action="" class="col s12">
                    <input required name="id" type="hidden" value="">

                    <div class="row">
                        <div class="input-field col s6">
                            <input required placeholder="{{__("Name")}}" name="name" type="text" class="validate">
                            <label for="name">{{__("Name")}}</label>
                        </div>
                        <div class="input-field col s6">
                            <label class="active" for="Status">{{__("Status")}}</label>

                            <select placeholder="{{__("Status")}}" required name="status" class=" validate ">
                                <option   selected value="">{{__("Status")}}</option>
                                <option   value="1">{{__("Active")}}</option>
                                <option   value="0">{{__("In Active")}}</option>
                            </select>
                        </div>


                    </div>
                    <div class="row">

                        <div class="file-field input-field col s6">
                            <div class="btn-small">
                                <span>{{__('locale.File')}}</span>
                                <input type="file">
                            </div>
                            <div class="file-path-wrapper">
                                <input required placeholder="{{__('locale.File')}}" name="file" class="file-path  validate" type="file">
                            </div>
                        </div>
                        <div class="file-field input-field col s6">
                            <div class="btn-small">
                                <span>{{__('locale.Icon')}}</span>
                                <input type="file">
                            </div>
                            <div class="file-path-wrapper">
                                <input required placeholder="{{__('locale.Icon')}}" name="icon" class="file-path validate" type="file">
                                <input required placeholder="{{__('locale.Icon')}}" name="icon" class="file-path validate" type="file">
                            </div>
                        </div>

                    </div>

                </form>
            </div>

        </div>
        <div class="modal-footer">
            <a href="#!" onclick="closeModal('#languagesForm')" class="modal-action modal-close  waves-effect waves-red btn-flat ">Close</a>
            <a href="#!" onclick="submitForm('languages')"
               class="modal-action ok  waves-effect waves-green btn-flat">{{__('locale.Agree')}}</a>
        </div>
    </div>
    <div class="section section-data-tables">
        <div class="card">
            <div class="card-content">
                <a onclick="showModal('languages',null)" class="waves-effect waves-light btn">{{__('locale.Add New')}}</a>
                <a onclick="reloadTable('languages',null)" class="waves-effect green waves-light btn">{{__('locale.Reload')}}</a>


            </div>
        </div>


        <!-- Services -->
        <div class="row">
            <div class="col s12">
                <div class="card">
                    <div class="card-content">
                        <h4 class="card-title">Services</h4>
                        <div class="row">
                            <div class="col s12">
                                <table id="languagesTable" class="display">
                                    <thead>
                                    <tr>
                                        <th>{{__('locale.Name')}}</th>
                                        <th>{{__('locale.Status')}}</th>
                                        <th>{{__('locale.Icon')}}</th>
                                        <th>{{__('locale.File')}}</th>
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

        $(document).ready(function () {


            var languages = $('#languagesTable').DataTable({
                processing: true,
                "searching": true,
                serverSide: true,
                "scrollX": true,
                "responsive": true,

                scrollCollapse: true,
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ],
                ajax: {
                    url: "{{url('languages/{service}')}}",
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
                        className: 'btn green reload languagesTable',
                        action: function (e, dt, node, config) {
                            dt.ajax.reload();
                        }
                    },
                ],
                columns: [
                    {className: 'text-center', data: 'name', name: 'name', searchable: true},
                    {className: 'text-center', data: 'status', name: 'status', searchable: true},
                    {className: 'text-center', data: 'file', name: 'file', searchable: true},
                    {className: 'text-center', data: 'icon', name: 'icon', searchable: true},
                    {className: 'text-center', data: 'action', name: 'action', searchable: false},

                ],
            });


        })
        $("#languagesForm").validate({
            rules: {
                name: {
                    required: true,
                    minlength: 5
                },
                supplier_id: {
                    required: true,
                },
                description: {
                    required: true,
                },

            },
            //For custom messages
            messages: {
                languagesname: {
                    required: "Enter a languagesname",
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