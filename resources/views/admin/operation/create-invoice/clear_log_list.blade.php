<button type="button" class="excels btn btn-outline-warning mb-0-25 waves-effect waves-light">
    <a href="{{url('/invoice_export/'.$status)}}" target="_blank">Excel <i class="fa fa-file-excel-o"></i></a>
</button>
<table class="table table-bordered" id="example">
    <thead class="bg-info">
    <tr>
        <th>#</th>
        
        @if(Auth::guard('admin')->user()->hasPermissions(['Admin','edit-finance']))
        @if($status != 1)
            <th>Action</th>
        @endif
        @endif
        <th>PDF</th>
        <th >Status</th>
        <th>Edit</th>
        <th class="column">Clear Log</th>
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
    <tbody>
    <?php $id = 1; ?>
    @foreach($createInvoice as $createInvoices)

        <tr id="searchBody">
            <td>{{$id++}}</td>
            @if(Auth::guard('admin')->user()->hasPermissions(['Admin','edit-finance']))
            @if($status != 1)
            <td>
                <?php if($createInvoices->status == 2){ ?>
                <a type="submit" class="btn btn-warning btn-circle" id="pendingStatus"
                   data-id="{{ $createInvoices->id }}" data-token="{{ csrf_token() }}"><span
                            class="fa fa-check"></span></a>
                <?php } elseif(($createInvoices->status == 1) || ($createInvoices->status == 3) || ($createInvoices->status == 4)){   ?>

                <input type="checkbox" class="checkbox" data-id={{ $createInvoices->id }}">
                <?php } ?>
            </td>
            @endif
                @endif
                        <td><a href="<?php echo URL::to('/invoice_pdf_admin/'.$createInvoices->id) ?>" target="_blank"><i
                            class="fa fa-file-pdf-o fa-2x"
                            style="margin-top: 18px;"
                            aria-hidden="true"></i></a>

                    {{--                        <td><a href="{{ route('invoice_pdf_admin/'.$createInvoices->id ) }}" target="_blank"><i--}}
                    {{--                        class="fa fa-file-pdf-o fa-2x"--}}
                    {{--                        style="margin-top: 18px;"--}}
                    {{--                        aria-hidden="true"></i></a>--}}
            </td>

                <td><?php if ($createInvoices->status == 1) {
                    echo '<span style="color:#006400;">Open Invoice</span>';
                } elseif ($createInvoices->status == 2) {
                    echo '<span style="color:#FF8C00;">Pending Invoice</span>';
                } elseif ($createInvoices->status == 3) {
                    echo '<span style="color:#0000ff;">Past Due Invoice</span>';
                } elseif ($createInvoices->status == 4) {
                    echo '<span style="color:#8B0000;">Paid Invoice</span>';
                } ?>
            </td>
            <td style="display: flex;">
                @if(Auth::guard('admin')->user()->hasPermissions(['Admin','edit-create-invoice']))
                <a href="#edit_company{{$createInvoices->id}}" class="btn btn-primary btn-circle mt-1"
                   data-toggle="modal"><span
                            class="fa fa-pencil"></span>
                </a>
                @endif
                @if(Auth::guard('admin')->user()->hasPermissions(['Admin','delete-create-invoice']))
                <a class="btn btn-warning btn-circle mt-1 ml-1"
                   onclick="javascript:return confirm('Are you sure you want to delete ?')"
                   href="{{route('delete_invoice',$createInvoices->id)}}"><span class="fa fa-trash"></span>
                </a>
                @endif
            </td>
            <td>{{$createInvoices->clearLog->container_series_number}}</td>
            <td>{{$createInvoices->custom_duty}}</td>
            <td>{{$createInvoices->port_handling}}</td>
            <td>{{$createInvoices->vcc}}</td>
            <td>{{$createInvoices->transporter_charges}}</td>
            <td>{{$createInvoices->e_token}}</td>
            <td>{{$createInvoices->local_service_charges}}</td>
            <td>{{$createInvoices->bill_of_entry}}</td>
            <td>{{$createInvoices->other_charges}}</td>
            <td>{{$createInvoices->vcc_charges}}</td>
            <td>{{$createInvoices->single_vcc_charges}}</td>
            <td>{{$createInvoices->wash_fine_charges}}</td>
            <td>{{$createInvoices->repairing_cost_charges}}</td>
            <td>{{$createInvoices->export_services_fees}}</td>
            <td>{{$createInvoices->detention_charges}}</td>
            <td>{{$createInvoices->demurrage_charges}}</td>
            <td>{{$createInvoices->inspection_charges}}</td>
            <td>{{$createInvoices->deliver_order_charges}}</td>

        </tr>

        <!-- Create Invoice Modal -->
        <div class="modal fade small-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
             aria-hidden="true" id="edit_company{{$createInvoices->id}}">
            <div class="modal-dialog modal-lg">
                <form class="form" action="{{route('edit_invoice')}}" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{$createInvoices->id}}">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
{{--                            <?php--}}
{{--                            if(is_object($createInvoices->getLogInvoice)){ ?>--}}
{{--                            <h4 class="modal-title">Update Invoice</h4>--}}
{{--                            <?php }else{  ?>--}}
{{--                            <h4 class="modal-title">Create Invoice</h4>--}}
{{--                            <?php } ?>--}}
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <h4>Invoice Details</h4>
                                </div>
                            </div>
                            <hr/>
                                <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Clear Log</label>
                                        <input type="text" name="log_id" style="text-align: right;"
                                               placeholder="Clear Log"
                                               <?php
                                               if(isset($createInvoices->log_id)){ ?>
                                               value="{{ $createInvoices->log_id }}"
                                               <?php }else{  ?>
                                               value="0"
                                               <?php } ?>
                                               class="form-control" >

                                        <input type="hidden" name="log_id" value="{{$createInvoices->id}}"/>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Custom Duty</label>
                                        <input type="text" name="custom_duty" style="text-align: right;"
                                               placeholder="Custom Duty"
                                               <?php
                                               if(isset($createInvoices->custom_duty)){ ?>
                                                    value="{{ $createInvoices->custom_duty }}"
                                               <?php }else{  ?>
                                                    value="0"
                                               <?php } ?>
                                               class="form-control" >

                                        <input type="hidden" name="log_id" value="{{$createInvoices->id}}"/>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Port Handling</label>
                                        <input type="text" name="port_handling" style="text-align: right;"
                                               placeholder="Port Handling"
                                               <?php
                                                   if(isset($createInvoices->port_handling)){ ?>
                                                   value="{{ $createInvoices->port_handling }}"
                                               <?php }else{ ?>
                                                    value="0"
                                               <?php } ?>
                                               class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>VCC</label>
                                        <input type="text" name="vcc"
                                               placeholder="vcc" style="text-align: right;"
                                               <?php
                                                   if(isset($createInvoices->vcc)){ ?>
                                                   value="{{ $createInvoices->vcc }}"
                                               <?php }else{ ?>
                                                    value="0"
                                               <?php } ?>
                                               class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Transporter Charges</label>
                                        <input type="text" name="transporter_charges"
                                               placeholder="transporter_charges"  style="text-align: right;"
                                               <?php
                                                   if(isset($createInvoices->getLogInvoice->transporter_charges)){ ?>
                                                   value="{{ $createInvoices['getLogInvoice']->transporter_charges }}"
                                               <?php }else{ ?>
                                                   value="0"
                                               <?php } ?>
                                               class="form-control">
                                    </div>
                                </div>


                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>E Token</label>
                                        <input type="text" name="e_token"
                                               placeholder="E Token" style="text-align: right;"
                                               <?php
                                                   if(isset($createInvoices->e_token)){ ?>
                                                   value="{{ $createInvoices->e_token }}"
                                               <?php }else{ ?>
                                                   value="0"
                                               <?php } ?>
                                               class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Local Service Charges</label>
                                        <input type="text" name="local_service_charges"
                                               placeholder="Local Service Charges" style="text-align: right;"
                                               <?php
                                                   if(isset($createInvoices->local_service_charges)){ ?>
                                                   value="{{ $createInvoices->local_service_charges }}"
                                               <?php }else{ ?>
                                                   value="0"
                                               <?php } ?>
                                               class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Bill Of Entry</label>
                                        <input type="text" name="bill_of_entry"
                                               placeholder="Bill Of Entry" style="text-align: right;"
                                               <?php
                                               if(isset($createInvoices->bill_of_entry)){ ?>
                                               value="{{ $createInvoices->bill_of_entry }}"
                                               <?php }else{ ?>
                                               value="0"
                                               <?php } ?>
                                               class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Other Charges</label>
                                        <input type="text" name="other_charges"
                                               placeholder="Other Charges" style="text-align: right;"
                                               <?php
                                               if(isset($createInvoices->other_charges)){ ?>
                                               value="{{ $createInvoices->other_charges }}"
                                               <?php }else{ ?>
                                               value="0"
                                               <?php } ?>
                                               class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Vcc Charges</label>
                                        <input type="text" name="vcc_charges"
                                               placeholder="Vcc Charges" style="text-align: right;"
                                               <?php
                                               if(isset($createInvoices->vcc_charges)){ ?>
                                               value="{{ $createInvoices->vcc_charges }}"
                                               <?php }else{ ?>
                                               value="0"
                                               <?php } ?>
                                               class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Single Vcc Charges</label>
                                        <input type="text" name="single_vcc_charges"
                                               placeholder="Single Vcc Charges" style="text-align: right;"
                                               <?php
                                               if(isset($createInvoices->single_vcc_charges)){ ?>
                                               value="{{ $createInvoices->single_vcc_charges }}"
                                               <?php }else{ ?>
                                               value="0"
                                               <?php } ?>
                                               class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Wash Fine Charges</label>
                                        <input type="text" name="wash_fine_charges"
                                               placeholder="Wash Fine Charges" style="text-align: right;"
                                               <?php
                                               if(isset($createInvoices->wash_fine_charges)){ ?>
                                               value="{{ $createInvoices->wash_fine_charges }}"
                                               <?php }else{ ?>
                                               value="0"
                                               <?php } ?>
                                               class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Repairing Cost Charges</label>
                                        <input type="text" name="repairing_cost_charges"
                                               placeholder="Repairing Cost Charges" style="text-align: right;"
                                               <?php
                                               if(isset($createInvoices->repairing_cost_charges)){ ?>
                                               value="{{ $createInvoices->repairing_cost_charges }}"
                                               <?php }else{ ?>
                                               value="0"
                                               <?php } ?>
                                               class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Export Services Fees</label>
                                        <input type="text" name="export_services_fees"
                                               placeholder="Export Services Fees" style="text-align: right;"
                                               <?php
                                               if(isset($createInvoices->export_services_fees)){ ?>
                                               value="{{ $createInvoices->export_services_fees }}"
                                               <?php }else{ ?>
                                               value="0"
                                               <?php } ?>
                                               class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Detention Charges</label>
                                        <input type="text" name="detention_charges"
                                               placeholder="Detention Charges" style="text-align: right;"
                                               <?php
                                               if(isset($createInvoices->detention_charges)){ ?>
                                               value="{{ $createInvoices->detention_charges }}"
                                               <?php }else{ ?>
                                               value="0"
                                               <?php } ?>
                                               class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Demurrage Charges</label>
                                        <input type="text" name="demurrage_charges"
                                               placeholder="Demurrage Charges" style="text-align: right;"
                                               <?php
                                               if(isset($createInvoices->demurrage_charges)){ ?>
                                               value="{{ $createInvoices->demurrage_charges }}"
                                               <?php }else{ ?>
                                               value="0"
                                               <?php } ?>
                                               class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Inspection Charges</label>
                                        <input type="text" name="inspection_charges"
                                               placeholder="Inspection Charges" style="text-align: right;"
                                               <?php
                                               if(isset($createInvoices->inspection_charges)){ ?>
                                               value="{{ $createInvoices->inspection_charges }}"
                                               <?php }else{ ?>
                                               value="0"
                                               <?php } ?>
                                               class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Deliver Order Charges</label>
                                        <input type="text" name="deliver_order_charges"
                                               placeholder="Deliver Order Charges" style="text-align: right;"
                                               <?php
                                               if(isset($createInvoices->deliver_order_charges)){ ?>
                                               value="{{ $createInvoices->deliver_order_charges }}"
                                               <?php }else{ ?>
                                               value="0"
                                               <?php } ?>
                                               class="form-control">
                                    </div>
                                </div>

                            </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endforeach
    </tbody>
    <tfoot class="bg-info">
        
    <tr>
       <th>#</th>
        
        @if(Auth::guard('admin')->user()->hasPermissions(['Admin','edit-finance']))
        @if($status != 1)
            <th>Action</th>
        @endif
        @endif
        <th>PDF</th>
        <th >Status</th>
        <th>Edit</th>
        <th class="column">Clear Log</th>
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
    </tfoot>
</table>
@if(Auth::guard('admin')->user()->hasPermissions(['Admin','edit-finance']))
@if($status !='1' && $status !='2')
    <div class="form-group col-md-1 col-lg-1 col-sm-6 col-xs-12" style="margin:1%">
        <button type="button" class="btn btn-warning btn-rounded mb-0-25 waves-effect waves-light" data-toggle="modal"
                data-target="#change_status"><b><i class="fa fa-info-circle"></i></b> Change Status
        </button>
    </div>
@endif
@endif