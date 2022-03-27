<div class="card">
    <div class="card-header p-2">
        <ul class="nav nav-tabs">
            <li class="nav-item clearLogTab">
                <a class="nav-link active clearLogTab" href="#clearlog" data-toggle="tab">Clear Log Invoice</a>
            </li>
            <li class="nav-item deliveryLogTab">
                <a class="nav-link deliveryLogTab" href="#delivery" data-toggle="tab">Delivery Invoice</a>
            </li>
        </ul>
    </div>
    <div class="card-body">
        <br>

        <input type="hidden" value="{{$status}}" name="statusCheck" id="statusCheck">
        <div class="tab-content" style="margin-left: 13px;margin-right: 13px;">
            <div class="tab-pane active" id="clearlog">
                <div class="header-btn">
                    @if(Auth::guard('admin')->user()->hasPermissions(['Admin','edit-finance']))
                        @if($status !='1' && $status !='2')
                            <div class="form-group col-md-1 col-lg-1 col-sm-6 col-xs-12 com" style="margin:1%">
                                <button type="button" class="btn btn-warning btn-rounded mb-0-25 waves-effect waves-light"
                                        data-toggle="modal"
                                        data-target="#change_status"><b><i class="fa fa-info-circle"></i></b> Change  Status
                                </button>
                            </div>
                        @endif
                    @endif
                </div>
                <table class="table table-bordered table-responsive w-100 clearlogDatatable">
                    <thead class="bg-info">
                    <tr>
                         <th>Action</th>
                        <th>#</th>
                        <th>Invoice No.</th>
                        <th>PDF</th>
                        <th>Status</th>
                        <th>Edit</th>
                        <th class="column">Clear Log</th>
                        <th class="column">Customer Name</th>
                        <th class="column">Custom Duty</th>
                        <th>Port Handling</th>
                        <th>VCC</th>
                        <th>Transporter Charges</th>
                        <th>E-Token</th>
                        <th>Local Service Charges</th>
                        <th>Bill Of Entry</th>
                        <th>Other Charges</th>
                        <th>VCC Charges</th>
                        <th>Single VCC Charges</th>
                        <th>Wash Fine Charges</th>
                        <th>Repairing Cost Charges</th>
                        <th>Export Services Fees</th>
                        <th>Detention Charges</th>
                        <th>Demurrage Charges</th>
                        <th>Inspection Charges</th>
                        <th>Deliver Order Charges</th>
                    </tr>
                    </thead>
                </table>
            </div>
            <div class="tab-pane" id="delivery">
                <div class="header-btn">
                    @if(Auth::guard('admin')->user()->hasPermissions(['Admin','edit-finance']))
                        @if($status !='1' && $status !='2')
                            <div class="form-group col-md-1 col-lg-1 col-sm-6 col-xs-12 com" style="margin:1%">
                                <button type="button" class="btn btn-warning btn-rounded mb-0-25 waves-effect waves-light"
                                        data-toggle="modal"
                                        data-target="#delivery_change_status"><b><i class="fa fa-info-circle"></i></b> Change  Status
                                </button>
                            </div>
                        @endif
                    @endif

                </div>
                <table class="table table-bordered w-100 deliverLogTable" id="deliverLogTable">
                    <thead class="bg-info dataTable" id="table-2">
                    <tr>
                        <th>Action</th>
                        <th>#</th>
                        <th>Invoice No.</th>
                        <th>PDF</th>
                        <th>Status</th>
                        <th>container</th>
                        <th>Customer Name</th>
                        <th>Delivery Charges</th>
                        <th>Consignee Name</th>
                        <th>Bolading No.</th>
                        <th>ETA</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>


@if(!empty($createInvoice))
{{ $createInvoice->appends(Request::All())->links()}}
@endif
</div>
</div>
<div class="site" id="user_data">
    @include('admin.operation.create-invoice.change_status')
    @include('admin.operation.create-invoice.delivery_change_status')
</div>
</div>
@section('js')
    <script src="{{asset('assets/formwizard/js/jquery.steps.js')}}"></script>
    <script src="{{asset('assets/formwizard/js/jquery-ui.min.js')}}"></script>
    <script src="{{asset('assets/formwizard/js/main.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

    <script type="text/javascript">
        var clearLogtable = $('.clearlogDatatable').DataTable({
            dom: 'Bfrtip',
            processing: true,
            serverSide: true,
            ajax: "{{ route('invoices_list_admin', ['id'=>$status]) }}",
            columns: [
                {
                    data: "SetAction",
                    "searchable": false,
                    "orderable": false,
                    "render": function (data, type, row) {
                        var status = $('#statusCheck').val()
                        if (status == 2) {
                            return '<a type="submit" class="btn btn-warning btn-sm btn-circle" id="pendingStatus" ' +
                                'data-id="' + row.id + '" data-token="{{csrf_token() }}"> <span class="fa fa-check"></span></a>';
                        } else {
                            return '<input type="checkbox" class="checkbox" data-id="' + row.id + '">'
                        }
                    }
                },
                {data: 'id', name: 'id'},
                {data: 'pgl_id', name: 'pgl_id',searchable: true},
                {data: 'pdf', name: 'pdf', orderable: false, searchable: false},
                {data: 'status', name: 'status', orderable: false, searchable: false},
                {data: 'action', name: 'action', orderable: false, searchable: false, className: 'invoice-btn-wrap'},
                {data: 'clear_log.container_series_number', name: 'clearLog.container_series_number'},
                {
                    data: 'updated_at',
                    name: 'updated_at',
                    orderable: true,
                    searchable: false
                },
                {data: 'custom_duty', name: 'custom_duty',  orderable: false},
                {data: 'port_handling', name: 'port_handling',  orderable: false},
                {data: 'vcc', name: 'vcc',  orderable: false},
                {data: 'transporter_charges', name: 'transporter_charges',  orderable: false},
                {data: 'e_token', name: 'e_token',  orderable: false},
                {data: 'local_service_charges', name: 'local_service_charges',  orderable: false},
                {data: 'bill_of_entry', name: 'bill_of_entry',  orderable: false},
                {data: 'other_charges', name: 'other_charges',  orderable: false},
                {data: 'vcc_charges', name: 'vcc_charges',  orderable: false},
                {data: 'single_vcc_charges', name: 'single_vcc_charges',  orderable: false},
                {data: 'wash_fine_charges', name: 'wash_fine_charges',  orderable: false},
                {data: 'repairing_cost_charges', name: 'repairing_cost_charges',  orderable: false},
                {data: 'export_services_fees', name: 'export_services_fees',  orderable: false},
                {data: 'detention_charges', name: 'detention_charges',  orderable: false},
                {data: 'demurrage_charges', name: 'demurrage_charges',  orderable: false},
                {data: 'inspection_charges', name: 'inspection_charges',  orderable: false},
                {data: 'deliver_order_charges', name: 'deliver_order_charges',  orderable: false},
                // {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
            buttons: [
                {
                    extend: 'excel',
                    className: 'excelButton',
                    text:'Export' }
            ]

        });
        if ($('#statusCheck').val() == 1) {
            var clearLogColumn = clearLogtable.column(1);
            clearLogColumn.visible(!clearLogColumn.visible())
        }

        var deliveryLogTable = $('.deliverLogTable').DataTable({
            dom: 'Bfrtip',
            processing: true,
            serverSide: true,
            ajax: "{{ route('invoices_list_admin', ['id'=>$status.'-delivery']) }}",
            columns: [
                {
                    data: "SetAction",
                    "searchable": false,
                    "orderable": false,
                    "render": function (data, type, row) {
                        var status = $('#statusCheck').val()
                        if (status == 2) {
                            return '<a type="submit" class="btn btn-warning btn-sm btn-circle" id="deliveryPendingStatus" ' +
                                'data-id="' + row.id + '" data-token="{{csrf_token() }}"> <span class="fa fa-check"></span></a>';
                        } else {
                            return '<input type="checkbox" class="checkbox" data-id="' + row.id + '">'
                        }
                    }
                },
                {data: 'id', name: 'id'},
                {data: 'pgl_id', name: 'pgl_id', searchable: true},
                {data: 'pdf', name: 'pdf', orderable: false, searchable: false},
                {data: 'status', name: 'status', orderable: false, searchable: false},
                {data: 'container.container_number', name: 'container.container_number'},
                {
                    data: 'created_at',
                    name: 'created_at',
                    orderable: true,
                    searchable: false
                },
                {data: 'delivery_charges', name: 'delivery_charges', orderable: false},
                {data: 'get_customer.consignee', name: 'get_customer.consignee', orderable: false},
                {data: 'container.bolading_number', name: 'container.bolading_number', orderable: false},
                {data: 'container.eta_port_discharge', name: 'container.eta_port_discharge', orderable: false},

                // {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
            buttons: [
                // see https://datatables.net/reference/type/selector-modifier
                {
                    extend: 'excel',
                    className: 'excelButton',
                    text:'Export',
                }
            ]

        });
        if ($('#statusCheck').val() == 1) {
            deliveryLogTable.column(0).visible(!deliveryLogTable.column(0).visible())
        }
        $(document).on("click", '.clearLogTab', function (e) {
            clearLogtable.ajax.reload();
            var status = $('#statusCheck').val()
            if (status == 1) {
                var column = clearLogtable.column('action');
                column.visible(!column.visible())
            }
        })
        $(document).on("click", '.deliveryLogTab', function (e) {
            deliveryLogTable.ajax.reload();
        })
        $(document).ready(function () {

            $(document).on("click", "#pendingStatus", function (e) {
                var id = $(this).data("id");
                var token = $(this).data("token");
                swal.fire({
                    title: "Change Status",
                    text: "Are You Sure Want to Change the Status?",
                    type: "warning",
                    showCancelButton: !0,
                    confirmButtonText: "YES!",
                    cancelButtonText: "NO",
                    reverseButtons: !0
                }).then(function (e) {

                    if (e.value === true) {
                        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

                        $.ajax(
                            {
                                url: "/invoices_list_admin/pendingStatus/" + id,
                                type: 'POST',
                                data: {
                                    "id": id,
                                    "_token": token,
                                },
                                success: function (response) {
                                    console.log(response);
                                    if (response.success === true) {
                                        swal.fire("Status Changed Successfully!", response.message, "success");
                                        location.reload();
                                    } else {
                                        swal.fire("status not Changed!!", response.message, "error");
                                        location.reload();
                                    }
                                }
                            });
                    } else {
                        e.dismiss;
                    }

                })

            });
            $(document).on("click", "#deliveryPendingStatus", function (e) {
                var id = $(this).data("id");
                var token = $(this).data("token");
                swal.fire({
                    title: "Change Delivery Charge Status",
                    text: "Are You Sure Want to Change the Status?",
                    type: "warning",
                    showCancelButton: !0,
                    confirmButtonText: "YES!",
                    cancelButtonText: "NO",
                    reverseButtons: !0
                }).then(function (e) {

                    if (e.value === true) {
                        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

                        $.ajax(
                            {
                                url: "/invoices_list_admin/deliveryPendingStatus/" + id,
                                type: 'POST',
                                data: {
                                    "id": id,
                                    "_token": token,
                                },
                                success: function (response) {
                                    console.log(response);
                                    if (response.success === true) {
                                        swal.fire("Delivery Charge Status Changed Successfully!", response.message, "success");
                                        location.reload();
                                    } else {
                                        swal.fire("status not Changed!!", response.message, "error");
                                        location.reload();
                                    }
                                }
                            });
                    } else {
                        e.dismiss;
                    }

                })

            });

            $('#change-all').on('click', function (e) {
                var idsArr = [];
                $(".checkbox:checked").each(function () {
                    idsArr.push($(this).attr('data-id'));
                });
                var status = $(".inv_status:checked").val();
                if (status == null) {
                    alert('Please select at least one status');
                    return;
                }
                if (idsArr.length <= 0) {
                    alert("Please select atleast one record to change.");
                } else {
                    if (confirm("Are you sure, you want to change the selected invoice status ?")) {
                        var strIds = idsArr.join(",");
                        $.ajax({
                            url: "{{ route('change_status_logs') }}",
                            type: 'get',
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            data: {'ids': strIds, 'status': status},
                            success: function (data) {
                                if (data['status'] == true) {
                                    $("#change_status").modal('hide');
                                    $(".checkbox:checked").each(function () {
                                        $(this).parents("tr").remove();
                                    });
                                    alert(data['message']);
                                } else {
                                    alert('Whoops Something went wrong!!');
                                }
                            },
                            error: function (data) {
                                alert(data.responseText);
                            }
                        });
                    }
                }
            });

            $('#change-delivery-all').on('click', function (e) {
                var idsArr = [];
                $(".checkbox:checked").each(function () {
                    idsArr.push($(this).attr('data-id'));
                });
                var status = $(".inv_status:checked").val();
                if (status == null) {
                    alert('Please select at least one status');
                    return;
                }
                if (idsArr.length <= 0) {
                    alert("Please select atleast one record to change.");
                } else {
                    if (confirm("Are you sure, you want to change the selected Delivery Invoice status ?")) {
                        var strIds = idsArr.join(",");
                        $.ajax({
                            url: "{{ route('change_status_delivery') }}",
                            type: 'get',
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            data: {'ids': strIds, 'status': status},
                            success: function (data) {
                                if (data['status'] == true) {
                                    $("#delivery_change_status").modal('hide');
                                    $(".checkbox:checked").each(function () {
                                        $(this).parents("tr").remove();
                                    });
                                    alert(data['message']);
                                } else {
                                    alert('Whoops Something went wrong!!');
                                }
                            },
                            error: function (data) {
                                alert(data.responseText);
                            }
                        });
                    }
                }
            });
        })


    </script>

@stop
