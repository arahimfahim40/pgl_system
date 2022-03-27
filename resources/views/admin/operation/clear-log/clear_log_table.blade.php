<table class="table table-bordered">
    <thead class="bg-info dataTable" id="table-2">
    <tr>
        <th width="5px;">#</th>
        @if(Auth::guard('admin')->user()->hasPermissions(['Admin','edit-log']))
        <th>Status</th>
        @endif
        <th>Customer Name</th>
        <th>Container Series Number</th>
        <th>Consignee Name</th>
        <th>IMP Code</th>
        <th>BL NO</th>
        <th>Container No</th>
        <th>ETA</th>
        <th>DO Charges</th>
        <th>Clearance Status</th>
        <th>Clearance Amount</th>
        <th>Clear Date</th>
        <th>Report Date To PGL</th>
        <th>Report By</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    <?php $id = 1; ?>
    @foreach($clearLog as $clearLogs)
        <tr id="searchBody">
            @if(Auth::guard('admin')->user()->hasPermissions(['Admin','edit-log']))
            <td><?=$id++; ?></td>
                <td><?php if($clearLogs->clearance_status == "Cleared"){ ?>
                <a type="submit" class="btn btn-danger btn-circle" id="clearanceStatus" data-id="{{ $clearLogs->id }}" data-token="{{ csrf_token() }}"><span class="fa fa-close" ></span>
                </a>
                <?php }elseif($clearLogs->clearance_status == "Not_Cleared"){ ?>
                <a type="submit" class="btn btn-warning btn-circle" id="clearanceStatus" data-id="{{ $clearLogs->id }}" data-token="{{ csrf_token() }}" ><span class="fa fa-check"></span>
                <?php } ?>
            </td>
            @endif

            <td>{{!empty($clearLogs->getCustomer) ?$clearLogs->getCustomer->customer_name : '--'}}</td>
            <td>{{$clearLogs->container_series_number}}</td>
            <td>{{!empty($clearLogs->getCustomer) ?$clearLogs->getCustomer->consignee : '--'}}</td>
            <td>{{$clearLogs->imp_code}}</td>
            <td>{{!empty($clearLogs->container) ?$clearLogs->container->bolading_number : ''}}</td>
            <td> {{!empty($clearLogs->container) ?$clearLogs->container->container_number : ''}}</td>
            <td>{{!empty($clearLogs->container) ?$clearLogs->container->eta_port_discharge : ''}}</td>
            <td>{{$clearLogs->do_charges}}</td>
            <?php if($clearLogs->clearance_status == "Cleared"){ ?>
            <td>Cleared</td>
            <?php }elseif($clearLogs->clearance_status == "Not_Cleared"){ ?>
            <td>Not Cleared</td>
                <?php } ?>
            <td>{{$clearLogs->clearance_amount}}</td>
            <td>{{$clearLogs->clear_date}}</td>
            <td>{{$clearLogs->created_at}}</td>
            <td>{{$clearLogs->reportedUser->username }}</td>

{{--          --}}
{{--            @foreach($users as $user)--}}

{{--                <?php--}}
{{--                $report_by = $clearLogs->report_by;--}}
{{--                if($report_by == $user->id){?>--}}
{{--                <td>{{ $user->username }}</td>--}}
{{--            <?php--}}
{{--                }--}}
{{--                ?>--}}
{{--            @endforeach--}}

            <td style="display: flex;">
                @if(Auth::guard('admin')->user()->hasPermissions(['Admin','edit-log']))
                <a href="#edit_company{{$clearLogs->id}}" class="btn btn-primary btn-circle mt-1"
                   data-toggle="modal"><span
                            class="fa fa-pencil"></span>
                </a>
                @endif
                @if(Auth::guard('admin')->user()->hasPermissions(['Admin','delete-log']))
                <a class="btn btn-warning btn-circle mt-1 ml-1"
                   onclick="javascript:return confirm('Are you sure you want to delete ?')"
                   href="{{route('delete_clear_log_admin',$clearLogs->id)}}"><span class="fa fa-trash"></span>
                </a>
                @endif
                @if(Auth::guard('admin')->user()->hasPermissions(['Admin','create-invoice-log']))
                <a href="#create_invoice{{$clearLogs->id}}"
                   class="btn btn-primary btn-circle mt-1 ml-1" data-toggle="modal"><span
                            class="fa fa-file"></span>
                </a>
                @endif

            </td>
        </tr>
        <!-- Edit company modal -->
        <div class="modal fade small-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
             aria-hidden="true" id="edit_company{{$clearLogs->id}}">
            <div class="modal-dialog modal-lg">
                <form class="form" action="{{route('edit_clear_log')}}" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{$clearLogs->id}}">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <h4 class="modal-title">Edit Clear Log</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Container Series Number</label>
                                        <input type="text" name="container_series_number"
                                               placeholder="Container Series Number"
                                               value="{{$clearLogs->container_series_number}}" class="form-control"
                                               required>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="customer">Customer Name DS</label>
                                        <span class="requited_filed">*</span>

                                        <select name="customer_id" class="form-control select2search get_customer"
                                                id="customer_select2"
                                                required>
                                            @foreach($customers as $ro)
                                                <option @if($ro->id == $clearLogs->customer_id) selected
                                                     @endif  value="{{$ro->id}}">&nbsp;{{$ro->customer_name}}&nbsp;
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
{{--                                        <label>Consignee Name</label>--}}
                                        <input type="hidden" name="consignee" placeholder="Consignee Name"
                                               value="{{$clearLogs->consignee}}" id="consignee_name" required
                                               class="form-control consignee_name" readonly>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Container No</label>
                                        <label name="container_id" class="form-control container_id">
                                            @foreach($containers as $ro)
                                                @if($ro->id==$clearLogs->container_id)
                                                    {{$ro->container_number}}
                                                @endif
                                            @endforeach
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>DO Charges</label>
                                        <input type="text" value="{{$clearLogs->do_charges}}" style="text-align: right;" name="do_charges"
                                        onkeypress="return onlyDotsAndNumbers(this,event);" maxlength="10"
                                                           oncopy="return false"
                                                           ondrag="return false"
                                                           ondrop="return false"
                                                           onpaste="return false"
                                        placeholder="DO Charges" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>IMP Code</label>
                                        <input type="text" value="{{$clearLogs->imp_code}}" name="imp_code" style="text-align: right;"
                                        onkeypress="return onlyDotsAndNumbers(this,event);" maxlength="10"
                                                           oncopy="return false"
                                                           ondrag="return false"
                                                           ondrop="return false"
                                                           onpaste="return false"
                                        placeholder="IMP Code" class="form-control">
                                    </div>
                                </div>
{{--                                        <label for="clear_date"> Clearance Status</label>--}}
                                        <select style="display: none;" name="clearance_status" id="clear_date" class="form-control">
                                            <option {{ old('clearance_status',$clearLogs->clearance_status)=="Cleared"? 'selected':''}}  value="Cleared"> Cleared</option>
                                            <option {{ old('clearance_status',$clearLogs->clearance_status)=="Not_Cleared"? 'selected':''}}  value="Not_Cleared"> Not Cleared</option>
                                        </select>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Clearance Amount</label>
                                        <input type="text" value="{{$clearLogs->clearance_amount}}"
                                               name="clearance_amount" style="text-align: right;" placeholder="Clearance Amount"
                                               onkeypress="return onlyDotsAndNumbers(this,event);" maxlength="10"
                                                           oncopy="return false"
                                                           ondrag="return false"
                                                           ondrop="return false"
                                                           onpaste="return false"
                                               class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Clear Date</label>
                                        <input type="date" name="clear_date"
                                               value="<?php echo Date("Y-m-d", strtotime($clearLogs->clear_date)) ?>"
                                               placeholder="Clear Date" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Other Charges</label>
                                        <input type="text" value="{{$clearLogs->other_charges}}" name="other_charges"
                                               placeholder="Other Charges" style="text-align: right;"
                                               onkeypress="return onlyDotsAndNumbers(this,event);" maxlength="10"
                                                           oncopy="return false"
                                                           ondrag="return false"
                                                           ondrop="return false"
                                                           onpaste="return false"
                                               class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Transporter In Charge</label>
                                        <input type="text" value="{{$clearLogs->transporter_in_charge}}"
                                               name="transporter_in_charge" placeholder="Transporter In Charge"
                                               onkeypress="return onlyDotsAndNumbers(this,event);" maxlength="10"
                                                           oncopy="return false"
                                                           ondrag="return false"
                                                           ondrop="return false"
                                                           onpaste="return false"
                                               class="form-control">
                                    </div>
                                </div>

                            </div>
                            <div class="row">

                                <div class="col-md-4">
                                    <label>Pull Out</label>
                                      <div id="pull_out" class="form-group">
                                        <input type="radio" value="yes" name="pull_out"
                                               @if($clearLogs->pull_out=='yes')checked @endif checked>
                                        <label>Yes</label>
                                        <input type="radio" value="no" name="pull_out"
                                               @if($clearLogs->pull_out=='no')checked @endif>
                                        <label>No</label>


                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <label>Deposit</label>
                                    <div id="deposit" class="form-group">
                                        <input type="radio" value="yes" name="deposit"
                                               @if($clearLogs->deposit=='yes')checked @endif checked>
                                        <label>Yes</label>
                                        <input type="radio" value="no" name="deposit"
                                               @if($clearLogs->deposit=='no')checked @endif>
                                        <label>No</label>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Create Invoice Modal -->
        <div class="modal fade small-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
             aria-hidden="true" id="create_invoice{{$clearLogs->id}}">
            <div class="modal-dialog modal-lg">
                <form class="form" action="{{route('save_invoice')}}" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{$clearLogs->id}}">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <?php
                            if(is_object($clearLogs->getLogInvoice)){ ?>
                            <h4 class="modal-title">Update Invoice</h4>
                            <?php }else{  ?>
                            <h4 class="modal-title">Create Invoice</h4>
                            <?php } ?>


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
                                            <label>Custom Duty</label>
                                            <input type="text" name="custom_duty" style="text-align: right;"
                                                   placeholder="Custom Duty"
                                                   <?php
                                                   if(isset($clearLogs->getLogInvoice->custom_duty)){ ?>
                                                        value="{{ $clearLogs['getLogInvoice']->custom_duty }}"
                                                   <?php }else{  ?>
                                                        value="0"
                                                   <?php } ?>
                                                   class="form-control" >

                                            <input type="hidden" name="log_id" value="{{$clearLogs->id}}"/>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Port Handling</label>
                                            <input type="text" name="port_handling" style="text-align: right;"
                                                   placeholder="Port Handling"
                                                   <?php
                                                       if(isset($clearLogs->getLogInvoice->port_handling)){ ?>
                                                       value="{{ $clearLogs['getLogInvoice']->port_handling }}"
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
                                                       if(isset($clearLogs->getLogInvoice->vcc)){ ?>
                                                       value="{{ $clearLogs['getLogInvoice']->vcc }}"
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
                                                       if(isset($clearLogs->getLogInvoice->transporter_charges)){ ?>
                                                       value="{{ $clearLogs['getLogInvoice']->transporter_charges }}"
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
                                                       if(isset($clearLogs->getLogInvoice->e_token)){ ?>
                                                       value="{{ $clearLogs['getLogInvoice']->e_token }}"
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
                                                       if(isset($clearLogs->getLogInvoice->local_service_charges)){ ?>
                                                       value="{{ $clearLogs['getLogInvoice']->local_service_charges }}"
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
                                                   if(isset($clearLogs->getLogInvoice->bill_of_entry)){ ?>
                                                   value="{{ $clearLogs['getLogInvoice']->bill_of_entry }}"
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
                                                   if(isset($clearLogs->getLogInvoice->other_charges)){ ?>
                                                   value="{{ $clearLogs['getLogInvoice']->other_charges }}"
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
                                                   if(isset($clearLogs->getLogInvoice->vcc_charges)){ ?>
                                                   value="{{ $clearLogs['getLogInvoice']->vcc_charges }}"
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
                                                   if(isset($clearLogs->getLogInvoice->single_vcc_charges)){ ?>
                                                   value="{{ $clearLogs['getLogInvoice']->single_vcc_charges }}"
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
                                                   if(isset($clearLogs->getLogInvoice->wash_fine_charges)){ ?>
                                                   value="{{ $clearLogs['getLogInvoice']->wash_fine_charges }}"
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
                                                   if(isset($clearLogs->getLogInvoice->repairing_cost_charges)){ ?>
                                                   value="{{ $clearLogs['getLogInvoice']->repairing_cost_charges }}"
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
                                                   if(isset($clearLogs->getLogInvoice->export_services_fees)){ ?>
                                                   value="{{ $clearLogs['getLogInvoice']->export_services_fees }}"
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
                                                   if(isset($clearLogs->getLogInvoice->detention_charges)){ ?>
                                                   value="{{ $clearLogs['getLogInvoice']->detention_charges }}"
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
                                                   if(isset($clearLogs->getLogInvoice->demurrage_charges)){ ?>
                                                   value="{{ $clearLogs['getLogInvoice']->demurrage_charges }}"
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
                                                   if(isset($clearLogs->getLogInvoice->inspection_charges)){ ?>
                                                   value="{{ $clearLogs['getLogInvoice']->inspection_charges }}"
                                                   <?php }else{ ?>
                                                   value="0"
                                                   <?php } ?>
                                                   class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-3" style="display: none">
                                        <div class="form-group">
                                            <label>Deliver Order Charges</label>
                                            <input type="text" name="deliver_order_charges"
                                                   placeholder="Deliver Order Charges" style="text-align: right;"
                                                   value="0"
                                                   class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Delivery Order Fee</label>
                                            <input type="text" name="delivery_order_fee"
                                                   placeholder="Delivery Order Fee" style="text-align: right;"
                                                   <?php
                                                   if(isset($clearLogs->getLogInvoice->delivery_order_fee)){ ?>
                                                   value="{{ $clearLogs['getLogInvoice']->delivery_order_fee }}"
                                                   <?php }else{ ?>
                                                   value="0"
                                                   <?php } ?>
                                                   class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-3" style="display: none">
                                        <div class="form-group">
                                            <label>Terminal Handling Charges</label>
                                            <input type="text" name="terminal_handling_charges"
                                                   placeholder="Terminal Handling Charges" style="text-align: right;"
                                                   <?php
                                                   if(isset($clearLogs->getLogInvoice->terminal_handling_charges)){ ?>
                                                   value="{{ $clearLogs['getLogInvoice']->terminal_handling_charges }}"
                                                   <?php }else{ ?>
                                                   value="0"
                                                   <?php } ?>
                                                   class="form-control">
                                        </div>
                                        </div>
                                    </div>




                                <div class="row">
                                    <div class="col-md-12">
                                        <h3>Log Invoice Details</h3>
                                    </div>
                                </div>
                                <hr/>

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Container Series Number</label>
                                            <input type="text" name="container_series_number"
                                                   placeholder="Container Series Number"
                                                   value="{{$clearLogs->container_series_number}}" class="form-control"
                                                   readonly required>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="customer">Customer Name</label>
                                            <span class="requited_filed">*</span>
                                            <select name="customer_id" class="form-control select2 get_customer"
                                                    disabled id="customer_select" style="-webkit-appearance: none;"
                                                    required>
                                                <option></option>
                                                @foreach($customers as $ro)
                                                    <option @if($ro->id==$clearLogs->customer_id) selected
                                                            @endif  value="{{$ro->id}}">&nbsp;{{$ro->customer_name}}&nbsp;
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Container No</label>
                                            <select name="container_id" class="form-control select2 get_container"
                                                    DISABLED id="container_id" style="-webkit-appearance: none;"
                                                    required>
                                                <option></option>
                                                @foreach($containers as $ro)
                                                    <option @if($ro->id==$clearLogs->container_id) selected
                                                            @endif value="{{$ro->id}}">&nbsp;{{$ro->container_number}}&nbsp;
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>DO Charges</label>
                                            <input type="text" value="{{$clearLogs->do_charges}}" name="do_charges"
                                                   readonly placeholder="DO Charges" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>IMP Code</label>
                                            <input type="text" value="{{$clearLogs->imp_code}}" name="imp_code"
                                                   readonly placeholder="IMP Code" class="form-control">
                                        </div>
                                    </div>

    {{--                                        <label for="clear_date"> Clearance Status</label>--}}
                                            <select style="display: none;" disabled name="clearance_status" id="clear_date" class="form-control">
                                                <option value="Cleared"> Cleared</option>
                                                <option value="Not_Cleared"> Not Cleared</option>
                                            </select>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Clearance Amount</label>
                                            <input readonly type="text" value="{{$clearLogs->clearance_amount}}"
                                                   name="clearance_amount" placeholder="Clearance Amount"
                                                   class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Clear Date</label>
                                            <input readonly type="date" name="clear_date"
                                                   value="<?php echo Date("Y-m-d", strtotime($clearLogs->clear_date)) ?>"
                                                   placeholder="Clear Date" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Other Charges</label>
                                            <input readonly type="text" value="{{$clearLogs->other_charges}}"
                                                   name="other_charges"
                                                   placeholder="Other Charges"
                                                   class="form-control">
                                        </div>
                                    </div>
                                </div>
                                    <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Transporter In Charge</label>
                                            <input readonly type="text" value="{{$clearLogs->transporter_in_charge}}"
                                                   name="transporter_in_charge" placeholder="Transporter In Charge"
                                                   class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label>Pull Out</label>
                                        <div id="pull_out" class="form-group">
                                            <input disabled type="radio" value="yes" name="pull_out"
                                                   @if($clearLogs->pull_out=='yes')checked @endif checked>
                                            <label>Yes</label>
                                            <input disabled type="radio" value="no" name="pull_out"
                                                   @if($clearLogs->pull_out=='no')checked @endif>
                                            <label>No</label>
                                        </div>
                                    </div>



                                    <div class="col-md-4">
                                        <label>Deposit</label>
                                        <div id="deposit" class="form-group">
                                            <input disabled type="radio" value="yes" name="deposit"
                                                   @if($clearLogs->deposit=='yes')checked @endif checked>
                                            <label>Yes</label>
                                            <input disabled type="radio" value="no" name="deposit"
                                                   @if($clearLogs->deposit=='no')checked @endif>
                                            <label>No</label>
                                        </div>
                                    </div>
                                </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Save Invoice</button>
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
        @if(Auth::guard('admin')->user()->hasPermissions(['Admin','edit-log']))
        <th>Status</th>
        @endif
        <th>Customer Name</th>
        <th>Container Series Number</th>
        <th>Consignee Name</th>
        <th>IMP Code</th>
        <th>BL NO</th>
        <th>Container No</th>
        <th>ETA</th>
        <th>DO Charges</th>
        <th>Clearance Status</th>
        <th>Clearance Amount</th>
        <th>Clear Date</th>
        <th>Report Date To PGL</th>
        <th>Report By</th>
        <th>Action</th>
    </tr>
    </tfoot>
</table>
@if(!empty($clearLog))
{{ $clearLog->appends(Request::All())->links()}}
@endif
</div>
</div>
</div>
<!-- add Clear Log -->
<div class="modal fade small-modal"  role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true"
     id="add_company">
    <div class="modal-dialog modal-lg">
        <form class="form" action="{{route('add_clear_log')}}" method="post">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title">Add Clear Log</h4>
                </div>
                <div class="modal-body">

                    <div class="container">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Container Series Number</label>
                                    <input type="text" name="container_series_number"
                                           placeholder="Container Series Number"
                                           class="form-control" required>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="customer">Customer Name</label>
                                    <span class="requited_filed">*</span>
                                    <select style="display: block" name="customer_id" class="form-control select2search get_customer"
                                            id="customer_select"
                                            required>
                                        @foreach($customers as $ro)
                                            <option value="{{$ro->id}}">&nbsp;{{$ro->customer_name}}&nbsp;</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                             <div class="col-md-4">
                                <div class="form-group">
                                    <label>Container No </label>
                                    <select name="container_id" class="form-control select2search get_container"
                                            id="container_id"
                                            required>
                                        <option></option>
                                        @foreach($containers as $ro)
                                              <option value="{{$ro->id}}">&nbsp;{{$ro->container_number}}&nbsp;</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>DO Charges</label>
                                    <input type="text"
                                     name="do_charges" style="text-align: right;"
                                           onkeypress="return onlyDotsAndNumbers(this,event);" maxlength="10"
                                           oncopy="return false"
                                           ondrag="return false"
                                           ondrop="return false"
                                           onpaste="return false"
                                            style="text-align: right;"
                                           value="0" id="field" placeholder="DO Charges"
                                           class="form-control"  />
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>IMP Code</label>
                                    <input type="text" name="imp_code" placeholder="IMP Code" class="form-control">
                                </div>
                            </div>


{{--                                   <label for="clear_date"> Clearance Status</label>--}}
                                    <select style="display: none;" name="clearance_status" id="clear_date" class="form-control">
                                        <option  value="Not_Cleared"> Not Cleared</option>
                                        <option  value="Cleared"> Cleared</option>
                                    </select>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Clearance Amount</label>
                                    <input type="text" name="clearance_amount" style="text-align: right;"
                                           onkeypress="return onlyDotsAndNumbers(this,event);" maxlength="10"
                                           oncopy="return false"
                                           ondrag="return false"
                                           ondrop="return false"
                                           onpaste="return false"
                                           value="0" placeholder="Clearance Amount"
                                           class="form-control">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Clear Date</label>
                                    <input type="date" name="clear_date" value="<?php echo Date('Y-m-d') ?>"
                                           placeholder="Clear Date" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Other Charges</label>
                                    <input type="text" name="other_charges" style="text-align: right;" value="0"
                                           onkeypress="return onlyDotsAndNumbers(this,event);" maxlength="10"
                                           oncopy="return false"
                                           ondrag="return false"
                                           ondrop="return false"
                                           onpaste="return false"
                                           placeholder="Other Charges"
                                           class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Transporter In Charge</label>
                                    <input type="text" name="transporter_in_charge" placeholder="Transporter In Charge"
                                           onkeypress="return onlyDotsAndNumbers(this,event);" maxlength="10"
                                           oncopy="return false"
                                           ondrag="return false"
                                           ondrop="return false"
                                           onpaste="return false"
                                           class="form-control">
                                </div>
                            </div>

                        </div>
                        <div class="row">

                            <div class="col-md-4">
                                <label>Pull Out</label>
                                <div class="form-group">
                                    <input type="radio" value="yes" name="pull_out" checked>
                                    <label>Yes</label>
                                    <input type="radio" value="no" name="pull_out">
                                    <label>No</label>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label>Deposit</label>
                                <div class="form-group">
                                    <input type="radio" value="yes" name="deposit" checked>
                                    <label>Yes</label>
                                    <input type="radio" value="no" name="deposit">
                                    <label>No</label>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Add</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>

@section('js')
    <script src="{{asset('assets/formwizard/js/jquery.steps.js')}}"></script>
    <script src="{{asset('assets/formwizard/js/jquery-ui.min.js')}}"></script>
    <script src="{{asset('assets/formwizard/js/main.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

    <script type="text/javascript">
        function onlyDotsAndNumbers(txt, event) {
            var charCode = (event.which) ? event.which : event.keyCode
            if (charCode == 46) {
                if (txt.value.indexOf(".") < 0)
                    return true;
                else
                    return false;
            }

            if (txt.value.indexOf(".") > 0) {
                var txtlen = txt.value.length;
                var dotpos = txt.value.indexOf(".");
                //Change the number here to allow more decimal points than 2
                if ((txtlen - dotpos) > 2)
                    return false;
            }

            if (charCode > 31 && (charCode < 48 || charCode > 57))
                return false;

            return true;
        }
        $(document).ready(function () {
            $(document).on("click", "#clearanceStatus", function (e) {
                var id = $(this).data("id");
                var token = $(this).data("token");
                swal.fire({
                    title: "Change Status",
                    text: "Are You Sure Want to Change Status?",
                    type: "warning",
                    showCancelButton: !0,
                    confirmButtonText: "CHANGE!",
                    cancelButtonText: "CANCEL",
                    reverseButtons: !0
                }).then(function (e) {

                    if (e.value === true) {
                        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

                        $.ajax(
                            {
                                url: "clearance_status/" + id,
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
        });


    </script>
    <script>
        $(document).ready(function () {
            $('.get_customer').change(function () {

                var customer_id = $(this).val();
                var request = $.ajax({
                    url: "{{route('get_customer_admin')}}",
                    method: "GET",
                    //  dataType: "json",
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data: {customer_id: customer_id},
                });
                request.done(function (msg) {
                    $(".consignee_name").val(msg.consignee)

                });
                request.fail(function (jqXHR, textStatus) {
                 //   alert('please select a customer')
                });
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            $('.get_container').change(function () {

                var container_id = $(this).val();
                var request = $.ajax({
                    url: "{{route('get_container_admin')}}",
                    method: "GET",
                    //  dataType: "json",
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data: {container_id: container_id},
                });
                request.done(function (msg) {
                    if (msg.bolading_number.length == 0) {
                        $(".bl_no").val('N/A');
                    } else {
                        $(".bl_no").val(msg.bolading_number);
                    }
                    if (msg.eta_port_discharge.length === 0) {
                        $(".eta").val('N/A')
                    } else {
                        $(".eta").val(msg.eta_port_discharge);
                    }
                });
                request.fail(function (jqXHR, textStatus) {
              //      alert('Please re-select someting went wrong')
                });
            });
        });

        $(document).ready(function(){
        // make sorable table
        $('th').each(function (col) {
            $(this).hover(
                function () {
                    $(this).addClass('focus');
                },
                function () {
                    $(this).removeClass('focus');
                }
            );
            $(this).click(function () {
                if ($(this).is('.asc')) {
                    $(this).removeClass('asc');
                    $(this).addClass('desc selected');
                    sortOrder = -1;
                } else {
                    $(this).addClass('asc selected');
                    $(this).removeClass('desc');
                    sortOrder = 1;
                }
                $(this).siblings().removeClass('asc selected');
                $(this).siblings().removeClass('desc selected');
                var arrData = $('table').find('tbody >tr:has(td)').get();
                arrData.sort(function (a, b) {
                    var val1 = $(a).children('td').eq(col).text().toUpperCase();
                    var val2 = $(b).children('td').eq(col).text().toUpperCase();
                    if ($.isNumeric(val1) && $.isNumeric(val2))
                        return sortOrder == 1 ? val1 - val2 : val2 - val1;
                    else
                        return (val1 < val2) ? -sortOrder : (val1 > val2) ? sortOrder : 0;
                });
                $.each(arrData, function (index, row) {
                    $('tbody').append(row);
                });
            });
        });
        });
    </script>
@stop
