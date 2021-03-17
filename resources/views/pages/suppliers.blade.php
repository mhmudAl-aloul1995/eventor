@extends('layouts/contentLayoutMaster')


{{-- page title --}}
@section('title','suppliers')

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
    <div id="suppliersModal"  class="modal ">

        <div class="modal-content">
            <h4>Service</h4>

            <div class="row">
                <form id="suppliersForm" action="" class="col s12">
                    <input required name="id" type="hidden" value="">

                    <div class="row">
                        <div class="input-field col s4">
                            <input required placeholder="Name" name="name" type="text" class="validate">
                            <label for="name">Name</label>
                        </div>

                        <div class="input-field col s4">
                            <input required placeholder="Address" name="address" type="text" class="validate">
                            <label for="address">Address</label>
                        </div>

                        <div class="input-field col s4">
                            <input required placeholder="Location" name="location" type="text" class="validate">
                            <label for="location">Location</label>
                        </div>

                    </div>
                    <div class="row">
                        <div class="input-field col s4">
                            <input required placeholder="Phone" name="phone" type="number" class="validate">
                            <label for="phone">Phone</label>
                        </div>

                        <div class="input-field col s4">
                            <input required placeholder="Price" name="email" type="email" class="validate">
                            <label for="price">Email</label>
                        </div>
                        <div class="input-field col s4">
                            <textarea required placeholder="Website" name="website" type="text" class="validate materialize-textarea "></textarea>
                            <label for="website">Website</label>
                        </div>

                    </div>
                    <div class="row">
                        <div class="input-field col s4">
                            <textarea required placeholder="Description" name="description" type="text" class="validate materialize-textarea"></textarea>
                            <label for="description">Description</label>
                        </div>
                        <div class="input-field col s4">
                            <input required placeholder="Balance" name="balance" type="text" class="validate ">
                            <label for="balance">Balance</label>
                        </div>

                    </div>
                    <div class="row">
                        <div class="file-field input-field col s6">
                            <div class="btn-small">
                                <span>Logo</span>
                                <input type="file">
                            </div>
                            <div class="file-path-wrapper">
                                <input placeholder="Logo" name="logo" class="file-path  validate" type="file">
                            </div>
                        </div>
                        <div class="file-field input-field col s6">
                            <div class="btn-small">
                                <span>Favicon</span>
                                <input type="file">
                            </div>
                            <div class="file-path-wrapper">
                                <input placeholder="Favicon" name="favicon" class="file-path validate" type="file">
                            </div>
                        </div>


                    </div>

                </form>
            </div>

        </div>
        <div class="modal-footer">
            <a href="#!" onclick="closeModal('#suppliersForm')" class="modal-action modal-close  waves-effect waves-red btn-flat ">Close</a>
            <a href="#!" onclick="submitForm('suppliers')"
               class="modal-action ok  waves-effect waves-green btn-flat">Agree</a>
        </div>
    </div>
    <div class="section section-data-tables">
        <div class="card">
            <div class="card-content">
                <a onclick="showModal('suppliers',null)" class="waves-effect waves-light btn">Add New</a>
                <a onclick="reloadTable('suppliers',null)" class="waves-effect green waves-light btn">Reload</a>


            </div>
        </div>


        <!-- Supplier -->
        <div class="row">
            <div class="col s12">
                <div class="card">
                    <div class="card-content">
                        <h4 class="card-title">Supplier</h4>
                        <div class="row">
                            <div class="col s12">
                                <table id="suppliersTable" class="display">
                                    <thead>
                                    <tr>

                                        <th>Name</th>
                                        <th>Logo</th>
                                        <th>Favicon</th>
                                        <th>Address</th>
                                        <th>Location</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th>Website</th>
                                        <th>Description</th>


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
            $('.datepicker').datepicker({ format: 'yyyy-mm-dd' });


            var suppliers = $('#suppliersTable').DataTable({
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
                    url: "{{url('suppliers/{supplier}')}}",
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
                        className: 'btn green reload suppliersTable',
                        action: function (e, dt, node, config) {
                            dt.ajax.reload();
                        }
                    },
                ],
                columns: [
                    {className: 'text-center', data: 'name', name: 'name', searchable: true},
                    {className: 'text-center', data: 'logo', name: 'logo', searchable: true},
                    {className: 'text-center', data: 'favicon', name: 'favicon', searchable: true},
                    {className: 'text-center', data: 'address', name: 'address', searchable: true},
                    {className: 'text-center', data: 'location', name: 'location', searchable: true},
                    {className: 'text-center', data: 'phone', name: 'phone', searchable: true},
                    {className: 'text-center', data: 'email', name: 'email', searchable: true},
                    {className: 'text-center', data: 'website', name: 'website', searchable: true},
                    {className: 'text-center', data: 'description', name: 'description', searchable: true},
                    {className: 'text-center', data: 'action', name: 'action', searchable: false},

                ],
            });


        })
        $("#suppliersForm").validate({
            rules: {
                name: {
                    required: true,
                    minlength: 5
                },
                suppliers_id: {
                    required: true,
                },
                description: {
                    required: true,
                },

            },
            //For custom messages
            messages: {
                suppliersname: {
                    required: "Enter a suppliersname",
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