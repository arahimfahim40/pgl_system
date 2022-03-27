@extends('admin.layout.main')
@section('title','Clear Log')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
    </section>

    <!-- Main content -->
    <div class="site-content">
        <div class="content-area py-1">
            <div class="container-fluid">
                @if (\Session::has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <i class="ik ik-x"></i>
                        </button>
                    </div>
                @endif
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a class="nav-link active" href="#clearlog" data-toggle="tab">Clear Log Invoice</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#delivery" data-toggle="tab">Delivery Invoice</a>
                            </li>
                        </ul>
{{--                        <ul class="nav nav-pills">--}}
{{--                            <li class="nav-item"><a class="nav-link active" href="#clearlog" data-toggle="tab">Clear Log Invoice</a></li>--}}
{{--                            <li class="nav-item"><a class="nav-link" href="#delivery" data-toggle="tab">Delivery Invoice</a></li>--}}
{{--                        </ul>--}}
                    </div>
                        <div class="card-body">
<br>
                            <div class="tab-content" style="margin-left: 13px;margin-right: 13px;">

                                <div class="tab-pane active" id="clearlog">
                                    <form class="form-horizontal" method="POST" action="<?php echo URL::to('/clear_log_invoice') ?>">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Clear Log</label>
                                                    <select name="log_id" class="form-control select2search get_container"
                                                            required>
                                                        @foreach($clearLog as $clearLogs)
                                                        @if(!$clearLogs->getLogInvoice)
                                                            <option value="{{$clearLogs->id}}">&nbsp;{{$clearLogs->container_series_number}}&nbsp;
                                                            </option>
                                                        @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Custom Duty</label>
                                                    <input type="text" name="custom_duty" style="text-align: right;" value="0"
                                                           onkeypress="return onlyDotsAndNumbers(this,event);" maxlength="10"
                                                           oncopy="return false"
                                                           ondrag="return false"
                                                           ondrop="return false"
                                                           onpaste="return false"
                                                           placeholder="Custom Duty" class="form-control" >
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Port Handling</label>
                                                    <input type="text" name="port_handling" style="text-align: right;" value="0" placeholder="Port Handling"
                                                           onkeypress="return onlyDotsAndNumbers(this,event);" maxlength="10"
                                                           oncopy="return false"
                                                           ondrag="return false"
                                                           ondrop="return false"
                                                           onpaste="return false"
                                                           class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>VCC</label>
                                                    <input type="text" name="vcc" placeholder="VCC" style="text-align: right;" value="0"
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
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Transporter Charges</label>
                                                    <input type="text" name="transporter_charges" placeholder="Transporter Charges" style="text-align: right;" value="0"
                                                           onkeypress="return onlyDotsAndNumbers(this,event);" maxlength="10"
                                                           oncopy="return false"
                                                           ondrag="return false"
                                                           ondrop="return false"
                                                           onpaste="return false"
                                                           class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>E Token</label>
                                                    <input type="text" name="e_token" placeholder="E Token" style="text-align: right;" value="0"
                                                           onkeypress="return onlyDotsAndNumbers(this,event);" maxlength="10"
                                                           oncopy="return false"
                                                           ondrag="return false"
                                                           ondrop="return false"
                                                           onpaste="return false"
                                                           class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Local Service Charges</label>
                                                    <input type="text" name="local_service_charges" placeholder="Local Service Charges" style="text-align: right;" value="0"
                                                           onkeypress="return onlyDotsAndNumbers(this,event);" maxlength="10"
                                                           oncopy="return false"
                                                           ondrag="return false"
                                                           ondrop="return false"
                                                           onpaste="return false"
                                                           class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Bill Of Entry</label>
                                                    <input type="text" name="bill_of_entry" placeholder="Bill Of Entry" style="text-align: right;" value="0"
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
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Other Charges</label>
                                                    <input type="text" name="other_charges" placeholder="Other Charges" style="text-align: right;" value="0"
                                                           onkeypress="return onlyDotsAndNumbers(this,event);" maxlength="10"
                                                           oncopy="return false"
                                                           ondrag="return false"
                                                           ondrop="return false"
                                                           onpaste="return false"
                                                           class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>VCC Charges</label>
                                                    <input type="text" name="vcc_charges"  placeholder="VCC Charges" style="text-align: right;" value="0"
                                                           onkeypress="return onlyDotsAndNumbers(this,event);" maxlength="10"
                                                           oncopy="return false"
                                                           ondrag="return false"
                                                           ondrop="return false"
                                                           onpaste="return false"
                                                           class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Single VCC Charges</label>
                                                    <input type="text" name="single_vcc_charges" placeholder="Single VCC Charges" style="text-align: right;" value="0"
                                                           onkeypress="return onlyDotsAndNumbers(this,event);" maxlength="10"
                                                           oncopy="return false"
                                                           ondrag="return false"
                                                           ondrop="return false"
                                                           onpaste="return false"
                                                           class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Wash Fine Charges</label>
                                                    <input type="text" name="wash_fine_charges" placeholder="Wash Fine Charges" style="text-align: right;" value="0"
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
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Repairing Cost Charges</label>
                                                    <input type="text" name="repairing_cost_charges" placeholder="Repairing Cost Charges" style="text-align: right;" value="0"
                                                           onkeypress="return onlyDotsAndNumbers(this,event);" maxlength="10"
                                                           oncopy="return false"
                                                           ondrag="return false"
                                                           ondrop="return false"
                                                           onpaste="return false"
                                                           class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Export Services Fees</label>
                                                    <input type="text" name="export_services_fees" placeholder="Export Services Fees" style="text-align: right;" value="0"
                                                           onkeypress="return onlyDotsAndNumbers(this,event);" maxlength="10"
                                                           oncopy="return false"
                                                           ondrag="return false"
                                                           ondrop="return false"
                                                           onpaste="return false"
                                                           class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Detention Charges</label>
                                                    <input type="text" name="detention_charges" placeholder="Detention Charges" style="text-align: right;" value="0"
                                                           onkeypress="return onlyDotsAndNumbers(this,event);" maxlength="10"
                                                           oncopy="return false"
                                                           ondrag="return false"
                                                           ondrop="return false"
                                                           onpaste="return false"
                                                           class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Demurrage Charges</label>
                                                    <input type="text" name="demurrage_charges" placeholder="Demurrage Charges" style="text-align: right;" value="0"
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
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Inspection Charges</label>
                                                    <input type="text" name="inspection_charges" placeholder="Inspection Charges" style="text-align: right;" value="0"
                                                           onkeypress="return onlyDotsAndNumbers(this,event);" maxlength="10"
                                                           oncopy="return false"
                                                           ondrag="return false"
                                                           ondrop="return false"
                                                           onpaste="return false"
                                                           class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-md-3" style="display: none">
                                                <div class="form-group">
                                                    <label>Deliver Order Charges</label>
                                                    <input type="text" name="deliver_order_charges" placeholder="Deliver Order Charges" style="text-align: right;" value="0"
                                                           onkeypress="return onlyDotsAndNumbers(this,event);" maxlength="10"
                                                           oncopy="return false"
                                                           ondrag="return false"
                                                           ondrop="return false"
                                                           onpaste="return false"
                                                           class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Delivery Order Fee</label>
                                                    <input type="text" name="delivery_order_fee" placeholder="Delivery Order Fee" style="text-align: right;" value="0"
                                                           onkeypress="return onlyDotsAndNumbers(this,event);" maxlength="10"
                                                           oncopy="return false"
                                                           ondrag="return false"
                                                           ondrop="return false"
                                                           onpaste="return false"
                                                           class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-md-3" style="display: none">
                                                <div class="form-group">
                                                    <label>Terminal Handling Charges</label>
                                                    <input type="text" name="terminal_handling_charges" placeholder="Terminal Handling Charges" style="text-align: right;" value="0"
                                                           onkeypress="return onlyDotsAndNumbers(this,event);" maxlength="10"
                                                           oncopy="return false"
                                                           ondrag="return false"
                                                           ondrop="return false"
                                                           onpaste="return false"
                                                           class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <button type="submit" class="btn btn-primary">Save Invoice</button>
                                            <input type="reset" class="btn btn-danger" value="RESET">

                                        </div>
                                        <br>

                                    </form>


                                </div>
                                @foreach($clearLog as $clearLogs)
                                <div class="tab-pane" id="delivery">
                                    <form class="form-horizontal" method="POST" action="<?php echo URL::to('/delivery_invoice') ?>">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                     <label>Container No </label>
                                                    <select name="container_id" class="form-control select2search get_container"
                                                            id="container_no2"
                                                            required>
                                                        <option>Select Container</option>
                                                        @foreach($containers as $ro)
                                                            <option @if($ro->id==$clearLogs->container_no)
                                                                    @endif value="{{$ro->id}}">&nbsp;{{$ro->container_number}}&nbsp;
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Customer Name</label>
                                                    <select name="customer_id" class="form-control select2 get_container"
                                                            id="customer_id"
                                                            required>
                                                        <option>Select Customer</option>
                                                        @foreach($customers as $ro)
                                                            <option @if($ro->id==$clearLogs->customer_id)
                                                                    @endif  value="{{$ro->id}}">&nbsp;{{$ro->customer_name}}&nbsp;
                                                            </option>
                                                        @endforeach

                                                    </select>

                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Delivery Charges</label>
                                                    <input type="text" name="delivery_charges" placeholder="Delivery Charges" style="text-align: right;" value="0"
                                                    onkeypress="return onlyDotsAndNumbers(this,event);" maxlength="10"
                                                           oncopy="return false"
                                                           ondrag="return false"
                                                           ondrop="return false"
                                                           onpaste="return false"
                                                    class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <button type="submit" class="btn btn-primary">Save Invoice</button>
                                            <input type="reset" class="btn btn-danger" value="RESET">

                                        </div>
                                        <br>
                                    </form>
                                </div>
                                @endforeach

                            </div>

                        </div>
                </div>
                <!-- /.row -->
            </div>
        </div>
    </div>
    <!-- /.content -->
    @stop
