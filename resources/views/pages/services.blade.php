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
                            <input required placeholder="{{__("Name")}}" name="name" type="text" class="validate">
                            <label for="name">{{__("Name")}}</label>
                        </div>

                        <div class="input-field col s4">
                            <label for="supplier_id" class="active">{{__("Supplier Name")}}</label>

                            <select placeholder="{{__("Supplier Name")}}" required name="supplier_id" class=" validate  ">
                                <option  selected  value="">{{__("Supplier Name")}}</option>

                                @foreach($supplier as $value)
                                    <option  value="{{$value->id}}">{{$value->name}}</option>
                                @endforeach

                            </select>

                        </div>
                        <div class="input-field col s4">
                            <textarea placeholder="{{__("Description")}}" name="description" type="text" class="materialize-textarea validate"></textarea>
                            <label for="description">{{__("Description")}}</label>
                        </div>

                    </div>
                    <div class="row">
                        <div class="input-field col s4">
                            <input required placeholder="{{__("Priority")}}" name="priority" type="text" class="validate">
                            <label for="priority">{{__("Priority")}}</label>
                        </div>

                        <div class="input-field col s4">
                            <input required placeholder="{{__("Price")}}" name="price" type="number" class="validate">
                            <label for="price">{{__("Price")}}</label>
                        </div>
                        <div class="input-field col s4">
                            <label class="active" for="is_vat">{{__("Is Vat")}}</label>

                            <select placeholder="Is Vat" required name="is_vat" class=" validate ">
                                <option   selected value="">{{__("Is Vat")}}</option>
                                <option   value="1">{{__("Yes")}}</option>
                                <option   value="2">{{__("No")}}</option>
                            </select>
                        </div>

                    </div>
                    <div class="row">
                        <div class="input-field col s4">
                            <input required placeholder="{{__('locale.Vat No')}}" name="vat_no" type="number" class="validate">
                            <label for="vat_no">{{__('locale.Vat No')}}</label>
                        </div>
                        <div class="input-field col s4">
                            <input required placeholder="{{__('locale.Infants From')}}" name="Infants_from" type="number" class=" validate">
                            <label for="Infants_from">{{__('locale.Infants From')}}</label>
                        </div>
                        <div class="input-field col s4">
                            <input required placeholder="{{__('locale.Infants To')}}" name="Infants_to" type="number" class=" validate">
                            <label for="Infants_to">{{__('locale.Infants To')}}</label>
                        </div>

                    </div>
                    <div class="row">

                        <div class="input-field col s4">
                            <input required placeholder="{{__('locale.Children From')}}" name="children_from" type="number" class=" validate">
                            <label for="Children From">{{__('locale.Children From')}}</label>
                        </div>
                        <div class="input-field col s4">
                            <input required placeholder="{{__('locale.Children To')}}" name="children_to" type="number" class=" validate">
                            <label for="children_to">{{__('locale.Children To')}}</label>
                        </div>

                        <div class="input-field col s4">
                            <input required placeholder="{{__('locale.Adults From')}}" name="Adults_from" type="number" class=" validate">
                            <label for="Adults_from">{{__('locale.Adults From')}}</label>
                        </div>
                        <div class="input-field col s4">
                            <input required placeholder="{{__('locale.Adults To')}}" name="Adults_to" type="number" class=" validate">
                            <label for="Adults_to">{{__('locale.Adults To')}}</label>
                        </div>


                    </div>

                </form>
            </div>

        </div>
        <div class="modal-footer">
            <a href="#!" onclick="closeModal('#servicesForm')" class="modal-action modal-close  waves-effect waves-red btn-flat ">Close</a>
            <a href="#!" onclick="submitForm('services')"
               class="modal-action ok  waves-effect waves-green btn-flat">{{__('locale.Agree')}}</a>
        </div>
    </div>
    <div class="section section-data-tables">
        <div class="card">
            <div class="card-content">
                <a onclick="showModal('services',null)" class="waves-effect waves-light btn">{{__('locale.Add New')}}</a>
                <a onclick="reloadTable('services',null)" class="waves-effect green waves-light btn">{{__('locale.Reload')}}</a>


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

                                        <th>{{__('locale.Name')}}</th>
                                        <th>{{__('locale.Supplier')}}</th>
                                        <th>{{__('locale.Description')}}</th>
                                        <th>{{__('locale.Priority')}}</th>
                                        <th>{{__('locale.Price')}}</th>
                                        <th>{{__('locale.Is Vat')}}</th>
                                        <th>{{__('locale.Vat No')}}</th>
                                        <th>{{__('locale.Infants From')}}</th>
                                        <th>{{__('locale.Infants To')}}</th>
                                        <th>{{__('locale.Children From')}}</th>
                                        <th>{{__('locale.Children To')}}</th>
                                        <th>{{__('locale.Adults From')}}</th>
                                        <th>{{__('locale.Adults To')}}</th>
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