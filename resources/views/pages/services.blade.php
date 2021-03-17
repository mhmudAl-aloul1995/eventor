@extends('layouts/contentLayoutMaster')


{{-- page title --}}
@section('title','services')

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
    <div id="servicesModal"  class="modal ">

        <div class="modal-content">
            <h4>Service</h4>

            <div class="row">
                <form id="servicesForm" action="" class="col s12">
                    <input required name="id" type="hidden" value="">

                    <div class="row">
                        <div class="input-field col s4">
                            <input required placeholder="Name" name="name" type="text" class="validate">
                            <label for="name">Name</label>
                        </div>

                        <div class="input-field col s4">
                            <select placeholder="Supplier Name" required name="supplier_id" class=" validate  ">
                                <option  selected  value="">Supplier Name</option>

                                @foreach($supplier as $value)
                                    <option  value="{{$value->id}}">{{$value->name}}</option>
                                @endforeach

                            </select>
                            <label for="supplier_id" class="active">Supplier Name</label>

                        </div>
                        <div class="input-field col s4">
                            <textarea placeholder="Description" name="description" type="text" class="materialize-textarea validate"></textarea>
                            <label for="description">Description</label>
                        </div>

                    </div>
                    <div class="row">
                        <div class="input-field col s4">
                            <input required placeholder="Priority" name="priority" type="text" class="validate">
                            <label for="priority">Priority</label>
                        </div>

                        <div class="input-field col s4">
                            <input required placeholder="Price" name="price" type="number" class="validate">
                            <label for="price">Price</label>
                        </div>
                        <div class="input-field col s4">
                            <label class="active" for="is_vat">Is Vat</label>

                            <select placeholder="Is Vat" required name="is_vat" class=" validate ">
                                <option   selected value="">Is Vat</option>
                                <option   value="1">Yes</option>
                                <option   value="2">No</option>


                            </select>
                        </div>

                    </div>
                    <div class="row">
                        <div class="input-field col s4">
                            <input required placeholder="Vat No" name="vat_no" type="number" class="validate">
                            <label for="vat_no">Vat No</label>
                        </div>
                        <div class="input-field col s4">
                            <input required placeholder="Infants From" name="Infants_from" type="text" class="datepicker validate">
                            <label for="Infants_from">Infants From</label>
                        </div>
                        <div class="input-field col s4">
                            <input required placeholder="Infants To" name="Infants_to" type="text" class="datepicker validate">
                            <label for="Infants_to">Infants From</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s4">
                            <input required placeholder="Children From" name="children_from" type="text" class="datepicker validate">
                            <label for="Children From">Infants From</label>
                        </div>
                        <div class="input-field col s4">
                            <input required placeholder="Children From" name="children_from" type="text" class="datepicker validate">
                            <label for="children_from">Children From</label>
                        </div>
                        <div class="input-field col s4">
                            <input required placeholder="Children To" name="children_to" type="text" class="datepicker validate">
                            <label for="children_to">Children To</label>
                        </div>

                    </div>
                    <div class="row">
                        <div class="input-field col s4">
                            <input required placeholder="Adults From" name="Adults_from" type="text" class="datepicker validate">
                            <label for="Adults_from">Adults From</label>
                        </div>
                        <div class="input-field col s4">
                            <input required placeholder="Adults To" name="Adults_to" type="text" class="datepicker validate">
                            <label for="Adults_to">Adults To</label>
                        </div>


                    </div>

                </form>
            </div>

        </div>
        <div class="modal-footer">
            <a href="#!" onclick="closeModal('#servicesForm')" class="modal-action modal-close  waves-effect waves-red btn-flat ">Close</a>
            <a href="#!" onclick="submitForm('services')"
               class="modal-action ok  waves-effect waves-green btn-flat">Agree</a>
        </div>
    </div>
    <div class="section section-data-tables">
        <div class="card">
            <div class="card-content">
                <a onclick="showModal('services',null)" class="waves-effect waves-light btn">Add New</a>
                <a onclick="reloadTable('services',null)" class="waves-effect green waves-light btn">Reload</a>


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
                                <table id="servicesTable" class="display">
                                    <thead>
                                    <tr>

                                        <th>Name</th>
                                        <th>Supplier</th>
                                        <th>Description</th>
                                        <th>Priority</th>
                                        <th>Price</th>
                                        <th>Is vat</th>
                                        <th>Vat No</th>
                                        <th>Infants From</th>
                                        <th>Infants To</th>
                                        <th>Children From</th>
                                        <th>Children To</th>
                                        <th>Adults From</th>
                                        <th>Adults To</th>
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


            var services = $('#servicesTable').DataTable({
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
                    url: "{{url('services/{service}')}}",
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
                        className: 'btn green reload servicesTable',
                        action: function (e, dt, node, config) {
                            dt.ajax.reload();
                        }
                    },
                ],
                columns: [
                    {className: 'text-center', data: 'name', name: 'name', searchable: true},
                    {className: 'text-center', data: 'supplier.name', name: 'supplier', searchable: true},
                    {className: 'text-center', data: 'description', name: 'description', searchable: true},
                    {className: 'text-center', data: 'priority', name: 'priority', searchable: true},
                    {className: 'text-center', data: 'price', name: 'price', searchable: true},
                    {className: 'text-center', data: 'is_vat', name: 'is_vat', searchable: true},
                    {className: 'text-center', data: 'vat_no', name: 'vat_no', searchable: true},
                    {className: 'text-center', data: 'Infants_from', name: 'Infants_from', searchable: true},
                    {className: 'text-center', data: 'Infants_to', name: 'Infants_to', searchable: true},
                    {className: 'text-center', data: 'children_from', name: 'children_from', searchable: true},
                    {className: 'text-center', data: 'children_to', name: 'children_to', searchable: true},
                    {className: 'text-center', data: 'Adults_from', name: 'Adults_from', searchable: true},
                    {className: 'text-center', data: 'Adults_to', name: 'Adults_to', searchable: true},
                    {className: 'text-center', data: 'action', name: 'action', searchable: false},

                ],
            });


        })
        $("#servicesForm").validate({
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
                servicesname: {
                    required: "Enter a servicesname",
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