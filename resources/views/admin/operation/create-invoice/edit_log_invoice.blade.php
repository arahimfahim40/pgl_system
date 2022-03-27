@extends('admin.layout.main')
@section('title','Clear Log')
@section('content')
    <div class="site-content">
        <div class="content-area py-1">
            <div class="container-fluid">
                <div class=" bg-white table-responsive">
                    {{--			<div class="form-group col-lg-1 col-sm-3 col-xs-4" style="margin:1%;">--}}
                    {{--				@foreach($createInvoice as $createInvoices)--}}
                    {{--					@if(($createInvoices['status'] == 1))--}}
                    {{--						<div class="form-group col-md-1 col-lg-1 col-sm-6 col-xs-12" style="margin:1%">--}}
                    {{--							<button type="button" class="btn btn-warning btn-rounded mb-0-25 waves-effect waves-light" data-toggle="modal" data-target="#change_invoice_status"><b><i class="fa fa-info-circle"></i></b> Change Status--}}
                    {{--							</button>--}}
                    {{--						</div>--}}
                    {{--					@endif--}}
                    {{--				@endforeach--}}
                    {{--			</div>--}}

                    <div class="form-group col-md-1 col-lg-1 col-sm-2 col-xs-12" style="margin:1%;float: right;">
                        <select class="form-control" id="showEntry">
                            <option value="20">20</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                            <option value="150">150</option>
                            <option value="200">200</option>
                            <option value="300">300</option>
                            <option value="500">500</option>
                            <option value="9000000">All</option>
                        </select>
                    </div>
                    <div class="site" id="user_data">
                        <form class="form" action="{{route('update_log_invoice')}}" method="post">
                            @csrf
                            <input type="hidden" name="id" value="{{$clearLogs->id}}">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                    <h4 class="modal-title">Update Invoice</h4>


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
                                                       if(isset($clearLogs->custom_duty)){ ?>
                                                       value="{{ $clearLogs->custom_duty }}"
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
                                                       if(isset($clearLogs->port_handling)){ ?>
                                                       value="{{ $clearLogs->port_handling }}"
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
                                                       if(isset($clearLogs->vcc)){ ?>
                                                       value="{{ $clearLogs->vcc }}"
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
                                                       if(isset($clearLogs->transporter_charges)){ ?>
                                                       value="{{ $clearLogs->transporter_charges }}"
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
                                                       if(isset($clearLogs->e_token)){ ?>
                                                       value="{{ $clearLogs->e_token }}"
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
                                                       if(isset($clearLogs->local_service_charges)){ ?>
                                                       value="{{ $clearLogs->local_service_charges }}"
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
                                                       if(isset($clearLogs->bill_of_entry)){ ?>
                                                       value="{{ $clearLogs->bill_of_entry }}"
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
                                                       if(isset($clearLogs->other_charges)){ ?>
                                                       value="{{ $clearLogs->other_charges }}"
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
                                                       if(isset($clearLogs->vcc_charges)){ ?>
                                                       value="{{ $clearLogs->vcc_charges }}"
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
                                                       if(isset($clearLogs->single_vcc_charges)){ ?>
                                                       value="{{ $clearLogs->single_vcc_charges }}"
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
                                                       if(isset($clearLogs->wash_fine_charges)){ ?>
                                                       value="{{ $clearLogs->wash_fine_charges }}"
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
                                                       if(isset($clearLogs->repairing_cost_charges)){ ?>
                                                       value="{{ $clearLogs->repairing_cost_charges }}"
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
                                                       if(isset($clearLogs->export_services_fees)){ ?>
                                                       value="{{ $clearLogs->export_services_fees }}"
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
                                                       if(isset($clearLogs->detention_charges)){ ?>
                                                       value="{{ $clearLogs->detention_charges }}"
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
                                                       if(isset($clearLogs->demurrage_charges)){ ?>
                                                       value="{{ $clearLogs->demurrage_charges }}"
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
                                                       if(isset($clearLogs->inspection_charges)){ ?>
                                                       value="{{ $clearLogs->inspection_charges }}"
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
                                                       if(isset($clearLogs->delivery_order_fee)){ ?>
                                                       value="{{ $clearLogs->delivery_order_fee }}"
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
                                                       if(isset($clearLogs->terminal_handling_charges)){ ?>
                                                       value="{{ $clearLogs->terminal_handling_charges }}"
                                                       <?php }else{ ?>
                                                       value="0"
                                                       <?php } ?>
                                                       class="form-control">
                                            </div>
                                        </div>
                                    </div>



<?php /**** fututre use
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
                                    */ ?>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Save Invoice</button>
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>
                </div>
                </div>
                </div>
                @stop
                @section('js')


                    </script>
@stop
