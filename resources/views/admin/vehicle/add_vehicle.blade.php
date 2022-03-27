@extends('admin.layout.main')
@section('title','Add Vehicle')
@section('style')
<link rel="stylesheet" href="{{asset('assets/formwizard/css/jquery-ui.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/formwizard/css/style.css')}}"/>
<style>
   .form-group label{
    font-weight: bold;
    }
    .loading{
        display: none;
    }
    .requited_filed{
        color: red;
        font-weight: bold;
    }
</style>
@stop
@section('content')
<div class="site-content">
  <div class="content-area py-1">
	<div class="container-fluid"> 
        <!-- loading div -->
        <div class="loading" id="loading" style='position:fixed; margin-top:15%; margin-left:38%; z-index: 100000'><img width='70px' src="{{asset('img/loading.gif')}}" alt='Loading ...'> 
        </div> 
        <div class="wizard-v4-content col-md-12 col-lg-12 col-sm-12">
            <div class="wizard-form" >
                <div class="wizard-header">
                    <h4 class="heading">Add Vehicle Information</h4>
                </div>
                <form class="form-register add_vehicle_form" action="{{url('add_new_vehicle')}}" method="post" enctype="multipart/form-data">
                    {!! csrf_field() !!}
                    <div id="form-total">
                        <!-- SECTION 1 -->
                        <h2>
                            <span class="step-icon"><i class="fa fa-user"></i></span>
                            <span class="step-text">Customer/General info</span>
                        </h2>
                        <section>
                            <div class="inner">
                                <h3>Assigning Customer + General Information</h3>
                                 <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="company">Select Company </label>
                                            <span class="requited_filed">*</span>
                                            <select name="company" class="company form-control select2" id="company" required>
                                                <option ></option>
                                                @foreach($companies as $ro)
                                                    <option value="{{$ro->id}}">&nbsp;{{$ro->name}}&nbsp;</option>
                                                @endforeach
                                            </select>
                                        </div>
                                     <div class="form-group" id="customer">
                                         <label for="customer">Select Customer</label>
                                         <span class="requited_filed">*</span>
                                         <select name="customer" class="form-control select2" id="customer_select" required>
                                             <option></option>
                                             @foreach($customers as $ro)
                                                <option value="{{$ro->id}}">&nbsp;{{$ro->customer_name}}&nbsp;</option>
                                             @endforeach
                                         </select>
                                     </div>
                                        <input type="hidden" name="status" value="On the way" />
                                        <div class="form-group">
                                            <label for="vin">VIN</label>
                                            <span class="requited_filed">*</span>
                                            <input type="text" name="vin" placeholder="enter vin" class="form-control" id="vin" required />
                                            <span id="vin_exist" style="color: red;font-weight: bold;">{{@$success}}</span>
                                        </div>
                                        <div class="form-group">
                                            <label for="year">Year</label>
                                            <input type="text" name="year" placeholder="enter year" class="form-control" id="year" />

                                        </div>
                                        <div class="form-group">
                                            <label for="make">Make</label>
                                            <input type="text" name="make" placeholder="enter make" class="form-control" id="make" />

                                        </div>

                                        <div class="form-group">
                                            <label for="Model">Model</label>
                                            <input type="text" name="model" placeholder="enter Model" class="form-control" id="Model" />

                                        </div>
                                        <div class="form-group">
                                            <label for="color">Color</label>
                                            <input type="text" name="color" placeholder="enter color" class="form-control" id="color" />

                                        </div>
                                        <div class="form-group">
                                            <label for="color">Vehicle Price</label>
                                            <input type="text" id="price" name="vprice" placeholder="enter Vehicle Price" class="form-control" id="color" />
                                        </div>
                                        <div class="form-group">
                                            <label for="lot">Lot Number</label>
                                            <input type="text" name="lotn" placeholder="enter Lot Number" class="form-control" id="lot" />

                                        </div>
                                        <div class="form-group">
                                            <label>Purchase Date:</label>

                                            <div class="input-group date">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                <input type="date" onchange="cal()" name="purdate" class="purchasedate form-control pull-right" id="purchase_date">
                                            </div>
                                            <!-- /.input group -->
                                        </div>

                                        <div class="form-group">
                                            <label>Payment Date:</label>

                                            <div class="input-group date">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                <input type="date" onchange="cal()" name="payment_date" class="purchasedate form-control pull-right" id="payment_date">
                                            </div>
                                            <!-- /.input group -->
                                        </div>

                                        <div class="form-group">
                                            <label>Pickup Due Date:</label>

                                            <div class="input-group date">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                <input type="date" onchange="cal()" name="pickup_due_date" class="purchasedate form-control pull-right" id="pickup_due_date">
                                            </div>
                                            <!-- /.input group -->
                                        </div>
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Report Date To PGL:</label>

                                            <div class="input-group date">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                <input type="text" name="rpgldate" class="reproteds form-control pull-right" id="reproted" readonly=""  value="{{date('y-m-d  h:i:s')}}">
                                            </div>

                                            <!-- /.input group -->
                                        </div>
                                        <?php $row=DB::table('users')
                                             ->where('id',Auth::guard('admin')->id())->first(); ?>
                                        <div class="form-group">
                                            <label>Reported By:</label>

                                            <input type="text" name="reported" readonly="" class="form-control" placeholder="Reported By" value="{{$row->username}}">
                                            <!-- /.input group -->
                                        </div>
                                        <div class="form-group">
                                            <label>Numbers Of Days Pickup from Purchase:</label>

                                            <input type="text" name="number_days_pur" readonly id="numdays2" class="form-control" placeholder="days">
                                            <!-- /.input group -->
                                        </div>
                                        <div class="form-group">
                                            <label>Numbers Of Days Pickup from Reported:</label>

                                            <input type="text" name="number_days_rep" readonly id="numdays3" class="form-control" placeholder="days">
                                            <!-- /.input group -->
                                        </div>

                                        <div class="form-group">
                                            <label>Auction</label>
                                                <input type="text" name="auc" class="form-control" />
                                            <!-- /.input group -->
                                        </div>

                                        <div class="form-group">
                                            <label for="customer">Auction City</label>
                                            <input type="text" name="aucity" class="form-control" id="aucity"/>
                                            
                                        </div>

                                        <div class="form-group">
                                            <label for="customer">Ship As</label>
                                            <select name="shipas" class="form-control select2" >
                                                <option></option>

                                                    <option value="whole car">Whole Car</option>
                                                <option value="Dismantle">Dismantle</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="customer">Point of loading</label>
                                            <span class="requited_filed">*</span>
                                            <select name="ploading" class="ploading form-control select2" required="required">
                                                @foreach($locations as $location)
                                                <option value="{{$location->id}}">{{$location->location}}</option>
                                                  @endforeach
                                            </select>
                                        </div>
                                        <div class="hidden" id="pointof"></div>
                                        <div class="form-group">
                                            <label for="vin"> Destination Port</label>
                                            <input type="text" name="dport" placeholder="enter  destination Port" class="form-control" id="Destination Port" />

                                        </div>
                                        <div class="form-group">
                                            <label for="vin">Buyer Number</label>
                                            <input type="text" name="buyer_number" placeholder="enter Buyer Number" class="form-control" id="Buyer Number" />

                                        </div>
                                        <div class="form-group">
                                            <label for="chose file">Auction Invoice (link)</label>
                                            <input type="link" name="auction_invoice" class="form-control" placeholder="link for auction invoice"/>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Enter Note :</label>
                                            <textarea name="note" id="" cols="30" rows="10" class="textarea wysihtml5-editor placeholder form-control"></textarea>
                                        </div>
                                    </div>
                                    <!-- /.col -->
                                </div>            
                                <!-- /.row -->
                            </div>
                        </section>
                        <!-- SECTION 2 -->
                        <h2>
                            <span class="step-icon"><i class="fa fa-car"></i></span>
                            <span class="step-text">Vehicles info</span>
                        </h2>
                        <section>
                            <div class="inner">
                                <h3>Vehicles Information</h3>
                                 <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Pickup Date:</label>
                                            <div class="input-group date">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                <input type="date" onchange="cal()" name="pdate" class="pick_date form-control pull-right" id="pick_date">
                                            </div>
                                            <!-- /.input group -->
                                        </div>
                                        <div class="form-group">
                                            <label for="hnumber">Description</label>

                                            <input type="text" name="desco" value="" placeholder="" class="form-control" id="" />
                                        </div>
                                        <div class="form-group">
                                            <label for="hnumber">Hat Number</label>
                                            <input type="text" name="htnumber" placeholder="enter hat number" class="form-control" id="htnumber" />

                                        </div>
                                            <div class="form-group">
                                            <label for="hnumber">Customer Remarks</label>
                                            <textarea name="c_remark" placeholder="Customer Remarks" class="form-control" id="c_remark"  ></textarea>

                                        </div>
                                        <!-- here  -->
                                        
                                        <div class="form-group">
                                            <label for="hnumber">Title Status</label>
                                            <input type="text" name="title_status" placeholder="enter title status" class="form-control" id="title_status" />

                                        </div>

                                        <div class="form-group">
                                            <label for="location">Towed</label>
                                            <select name="towed" class="form-control select2" style="width: 100%;">
                                                <option></option>
                                                <option value="yes">Yes</option>
                                                <option value="no">No</option>
                                            </select>
                                        </div>


                                        <div class="form-group">
                                            <label for="location">Towed By</label>
                                            <select name="towed"  style="width: 100%;" class="form-control select2">
                                                <option></option>
                                                <option value="pgl">PGL</option>
                                                <option value="customer">Customer</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>Date Posted In Central Dispatch:</label>

                                            <div class="input-group date">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                <input type="date" name="dpicd" class="form-control pull-right" id="datepicker">
                                            </div>
                                            <!-- /.input group -->
                                        </div>

                                        <div class="form-group">
                                            <label>Posted By In Central Dispatch:</label>

                                                <input type="text" name="cdname" class="form-control pull-right" >
                                            <!-- /.input group -->
                                        </div>
                                        <div class="form-group">
                                            <label>Towing Request Date:</label>

                                            <div class="input-group date">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                <input type="date" name="towingrdate" class="form-control pull-right" id="datepicker">
                                            </div>
                                            <!-- /.input group -->
                                        </div>
                                        <div class="form-group">
                                            <label>Delivery Date:</label>

                                            <div class="input-group date">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                <input type="date" name="ddate" class="deliver_date form-control pull-right" id="deliver_date">
                                            </div>

                                            <!-- /.input group -->
                                        </div>
                                        <div class="form-group">
                                            <label for="towed">Towed From</label>
                                            <input type="text" name="towedf" placeholder="enter Towed From" class="form-control" id="towed" />

                                        </div>
                                        <span id="aucityspan"></span>

                                    </div>
                                    <div class="col-md-6">




                                        <div class="form-group">
                                            <label for="location">Towing  Company</label>
                                            <input type="text" name="towingcompany" class="form-control" />
                                        </div>

                                        <div class="form-group">
                                            <label for="towamount">Tow Amount</label>
                                            <input type="text" name="towamount" placeholder="enter Tow Amount" class="form-control" id="towamount" />

                                        </div>

                                        <div class="form-group">
                                            <label for="chnumber">Check No.-Issued to Tow</label>
                                            <input type="text" name="chnumber" placeholder="enter Check Number" class="form-control" id="chnumber" />
                                        </div>

                                        <div class="form-group">
                                            <label for="location">Title</label>
                                            <select name="title" style="width: 100%;" class="form-control select2">
                                                <option ></option>
                                                <option value="yes">Yes</option>
                                                <option value="no">No</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Title Number:</label>

                                            <input type="text" name="tnumber"  class="form-control" placeholder="enter title number">
                                            <!-- /.input group -->
                                        </div>
                                        <div class="form-group">
                                            <label>Title State:</label>

                                            <input type="text" name="tstate" class="form-control" placeholder="enter title state">
                                            <!-- /.input group -->
                                        </div>

                                        <div class="form-group">
                                            <label>Title Receive Date:</label>

                                            <div class="input-group date">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                <input type="date" name="trdate"  class="form-control pull-right" id="datepicker">
                                            </div>
                                            <!-- /.input group -->
                                        </div>


                                        <input type="hidden" id="today" name="today" value="<?php echo date('Y-m-d'); ?>">
                                        <div class="form-group">
                                            <label for="weight">Weight</label>
                                            <input type="text" name="weight" placeholder="enter weight" class="form-control" id="weight" />

                                        </div>

                                        <div class="form-group">
                                            <label for="license">License plate/Tag Number</label>
                                            <input type="text" name="license" placeholder="enter License number" class="form-control" id="license" />

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <!-- SECTION 3 -->
                        <h2>
                            <span class="step-icon"><i class="fa fa-check"></i></span>
                            <span class="step-text">Check options</span>
                        </h2>
                        <section>
                            <div class="inner">
                                <h3>Check Options</h3>
                                <div class="row">
                                    <div class="col-md-6" style="padding-left: 200px">
                                        <div class="form-group" >
                                         <label for="Keys" style="background-color: #00A6C7; color: white">Keys :&nbsp;</label>
                                         <input type="checkbox"  class="iradio_flat-green flat-red" name="Keys" value="Yes" />
                                        </div>
                                        <div class="form-group" >
                                            <label for="radio" style="background-color: #00A6C7; color: white">Radio :&nbsp;</label>
                                            <input type="checkbox"  class="iradio_flat-green flat-red" name="radio" value="Yes" />
                                        </div>
                                        <div class="form-group" >
                                            <label for="casette" style="background-color: #00A6C7; color: white">Cassettes :&nbsp;</label>
                                            <input type="checkbox"  class="iradio_flat-green flat-red" name="casette" value="Yes" />
                                        </div>
                                        <div class="form-group" >
                                            <label for="cdp" style="background-color: #00A6C7; color: white">CD Player :&nbsp;</label>
                                            <input type="checkbox"  class="iradio_flat-green flat-red" name="cdp" value="Yes" />
                                        </div>
                                        <div class="form-group" >
                                            <label for="cdch" style="background-color: #00A6C7; color: white">CD Changer :&nbsp;</label>
                                            <input type="checkbox"  class="iradio_flat-green flat-red" name="cdch" value="Yes" />
                                        </div>
                                        <div class="form-group" >
                                            <label for="fmt" style="background-color: #00A6C7; color: white">Floor Mat :&nbsp;</label>
                                            <input type="checkbox"  class="iradio_flat-green flat-red" name="fmt" value="Yes" />
                                        </div>
                                        <div class="form-group" >
                                            <label for="gns" style="background-color: #00A6C7; color: white">GPS Navigation System :&nbsp;</label>
                                            <input type="checkbox"  class="iradio_flat-green flat-red" name="gns" value="Yes" />
                                        </div>
                                    </div>
                                    <div class="col-md-6" style="padding-left: 200px">

                                        <div class="form-group" >
                                            <label for="mirror" style="background-color: #00A6C7; color: white">Mirror :&nbsp;</label>
                                            <input type="checkbox"  class="iradio_flat-green flat-red" name="mirror" value="Yes" />
                                        </div>
                                        <div class="form-group" >
                                            <label for="stj" style="background-color: #00A6C7; color: white">Spare Tire/ Jack :&nbsp;</label>
                                            <input type="checkbox"  class="iradio_flat-green flat-red" name="stj" value="Yes" />
                                        </div>
                                        <div class="form-group" >
                                            <label for="speaker" style="background-color: #00A6C7; color: white">Speaker :&nbsp;</label>
                                            <input type="checkbox"  class="iradio_flat-green flat-red" name="speaker" value="Yes" />
                                        </div>
                                        <div class="form-group" >
                                            <label for="wc" style="background-color: #00A6C7; color: white">Wheel Cover :&nbsp;</label>
                                            <input type="checkbox"  class="iradio_flat-green flat-red" name="wc" value="Yes" />
                                        </div>
                                        <div class="form-group" >
                                            <label for="other" style="background-color: #00A6C7; color: white">Other :&nbsp;</label>
                                            <input type="checkbox"  class="iradio_flat-green flat-red" name="other" value="Yes" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <!-- SECTION 4 -->
                        <h2>
                            <span class="step-icon"><i class="ti-receipt"></i></span>
                            <span class="step-text">Condition of Vehicles</span>
                        </h2>
                        <section>
                            <div class="inner">
                                <h3>Condition of Vehicles</h3>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="txt1">TEXT BOX 1</label>
                                            <input type="text" class="form-control" placeholder="Damaged" name="txt1">
                                        </div>

                                        <div class="form-group">
                                            <label for="txt2">TEXT BOX 2</label>
                                            <input type="text" class="form-control" placeholder="Damaged" name="txt2">
                                        </div>
                                        <div class="form-group">
                                            <label for="txt3">TEXT BOX 3</label>
                                            <input type="text" class="form-control" placeholder="Cracked" name="txt3">
                                        </div>
                                        <div class="form-group">
                                            <label for="txt4">TEXT BOX 4</label>
                                            <input type="text" class="form-control" placeholder="Hole" name="txt4">
                                        </div>
                                        <div class="form-group">
                                            <label for="txt5">TEXT BOX 5</label>
                                            <input type="text" class="form-control" placeholder="Broken" name="txt5">
                                        </div>
                                        <div class="form-group">
                                            <label for="txt6">TEXT BOX 6</label>
                                            <input type="text" class="form-control" placeholder="Damaged" name="txt6">
                                        </div>
                                        <div class="form-group">
                                            <label for="txt7">TEXT BOX 7</label>
                                            <input type="text" class="form-control" placeholder="Damaged" name="txt7">
                                        </div>
                                        <div class="form-group">
                                            <label for="txt8">TEXT BOX 8</label>
                                            <input type="text" class="form-control" placeholder="Damaged" name="txt8">
                                        </div>
                                        <div class="form-group">
                                            <label for="txt9">TEXT BOX 9</label>
                                            <input type="text" class="form-control" placeholder="Damaged" name="txt9">
                                        </div>
                                        <div class="form-group">
                                            <label for="txt10">TEXT BOX 10</label>
                                            <input type="text" class="form-control" placeholder="Damaged" name="txt10">
                                        </div>
                                        <div class="form-group">
                                            <label for="txt11">TEXT BOX 11</label>
                                            <input type="text" class="form-control" placeholder="Damaged" name="txt11">
                                        </div>
                                         <div class="form-group">
                                            <label for="keypresent">Key Present ? </label>
                                            <select name="keypresent" class="form-control select2" style="width: 100%;">
                                                <option value="0">No</option>
                                                <option value="1">Yes</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="txt12">TEXT BOX 12</label>
                                            <input type="text" class="form-control" placeholder="Damaged" name="txt12">
                                        </div>
                                        <div class="form-group">
                                            <label for="txt13">TEXT BOX 13</label>
                                            <input type="text" class="form-control" placeholder="Damaged" name="txt13">
                                        </div>
                                        <div class="form-group">
                                            <label for="txt14">TEXT BOX 14</label>
                                            <input type="text" class="form-control" placeholder="Damaged" name="txt14">
                                        </div>
                                        <div class="form-group">
                                            <label for="txt15">TEXT BOX 15</label>
                                            <input type="text" class="form-control" placeholder="Damaged" name="txt15">
                                        </div>
                                        <div class="form-group">
                                            <label for="txt16">TEXT BOX 16</label>
                                            <input type="text" class="form-control" placeholder="Damaged" name="txt16">
                                        </div>
                                        <div class="form-group">
                                            <label for="txt17">TEXT BOX 17</label>
                                            <input type="text" class="form-control" placeholder="Damaged" name="txt17">
                                        </div>
                                        <div class="form-group">
                                            <label for="txt18">TEXT BOX 18</label>
                                            <input type="text" class="form-control" placeholder="Damaged" name="txt18">
                                        </div>
                                        <div class="form-group">
                                            <label for="txt19">TEXT BOX 19</label>
                                            <input type="text" class="form-control" placeholder="Damaged" name="txt19">
                                        </div>
                                        <div class="form-group">
                                            <label for="txt20">TEXT BOX 20</label>
                                            <input type="text" class="form-control" placeholder="Damaged" name="txt20">
                                        </div>
                                        <div class="form-group">
                                            <label for="txt21">TEXT BOX 21</label>
                                            <input type="text" class="form-control" placeholder="Damaged" name="txt21">
                                        </div>

                                         <div class="form-group">
                                            <label for="photos">Choose Photos (1024kb)</label>
                                            <input type="file" class="form-control " name="photos[]" multiple>
                                        </div> 

                                         <div class="form-group">
                                            <label for="photo-link">Photos Link</label>
                                            <input type="text" class="form-control" placeholder="link of vehicles photo" name="photo-link">
                                        </div>    
                                    </div>
                                </div>
                            </div>
                        </section>

                        <!-- Step 5.  cost information -->
                        <h2>
                            <span class="step-icon"><i class="fa fa-dollar"></i></span>
                            <span class="step-text">Cost Information</span>
                        </h2>
                        <section>
                            <div class="inner">
                                <h3>Cost Information</h3>
                                <div class="row">
                                           <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="vehicle price">Vehicle Price and Auction Fee</label>
                                        <input type="text"  name="vehicle_price" class="txt form-control pricest5"/>
                                    </div>
                                        <div class="form-group">
                                            <label for="vehicle price">Tow Amount</label>
                                            <input type="text" name="tow_amounts" class="txt form-control" />
                                        </div>
                                        <div class="form-group">
                                            <label for="vehicle price">Dismantal Cost</label>
                                            <input type="text" name="dcost" class="txt form-control" />
                                        </div>
                                        <div class="form-group">
                                            <label for="vehicle price">Shipping Cost</label>
                                            <input type="text" name="shipcost" class="txt form-control" />
                                        </div>
                                        
                                            <input type="hidden" name="astoragecost" class="txt form-control" />
                                        
                                        <div class="form-group">
                                            <label for="vehicle price"> Storage at POL Origin</label>
                                            <input type="text" name="pglscost" class="txt form-control" />
                                        </div>
                                         <div class="form-group">
                                            <label for="vehicle price"> Storage at POD </label>
                                            <input type="number" name="storage_pod_cost" class="txt form-control" />
                                        </div>
                                        <div class="form-group">
                                            <label for="vehicle price"> Custom Cost</label>
                                            <input type="text" name="dcustomcost" class="txt form-control" />
                                        </div>

                                       


                                    </div>
                                    <div class="col-md-6">
                                            <input type="hidden" name="dstoragecost" class="txt form-control" />
                                       
                                       
                                            <input type="hidden" name="ddcost" class="txt form-control" />
                                        
                                        <div class="form-group">
                                            <label for="vehicle price">Other Cost</label>
                                            <input type="text" name="othercost" class="txt form-control" />
                                        </div>
                                        <div class="form-group">
                                            <label for="vehicle price">Total Cost Of Vehcile</label>
                                            <input type="text" name="totalcost" id="sum" class="form-control" />
                                        </div>


                                        <div class="form-group">
                                            <label for="vehicle price">Sales Cost </label>
                                            <input type="text" name="salescost" id="slaescost" class="form-control" />
                                        </div>
                                        <div class="form-group">
                                            <label for="vehicle price">Profit / loss </label>
                                            <input type="text" name="profit" id="profit" class="form-control" />
                                        </div>
                                        <div class="form-group">
                                            <label for="vehicle price">Percent Profit </label>
                                            <input type="text" name="percent" id="percent" class="form-control" />
                                        </div>
                                         <div class="form-group">
                                            <label for="invoice_description"> Invoice Description</label>
                                            <textarea class="form-control" name="invoice_description" rows="3"></textarea>
                                        </div>

                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Additional Information :</label>
                                            <textarea name="inform" id="" cols="30" rows="10" class="textarea wysihtml5-editor placeholder form-control"></textarea>
                                        </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </form>
            </div>
        </div>
    <!-- </div> -->
	 </div>
	</div>
  </div>
</div>		
@stop
@section('js')
    <script src="{{asset('assets/formwizard/js/jquery.steps.js')}}"></script>
    <script src="{{asset('assets/formwizard/js/jquery-ui.min.js')}}"></script>
    <script src="{{asset('assets/formwizard/js/main.js')}}"></script>
    <script>
        $(document).ready(function(){
             $('.actions ul li a').click(function(e){
                var valueBtn=$(this).attr('href')
                if(valueBtn=='#finish'){
                    if($('#company').val()=='' || $('#vin').val()==''){
                        $('#loading').addClass("loading");
                        alert('Please fill all the required field');
                         return; 
                    }
                    else{
                         $('#loading').removeClass("loading");
                         $('form.add_vehicle_form').submit();
                    }
                }
            });
        });
    </script>
    <script>
        $(document).ready(function(){
            $('#company').change(function(){
                var company_id=$(this).val();
               var request = $.ajax({
                  url: "{{route('single_customer_admin')}}",
                  method: "GET",
                  dataType:"HTML",
                  data: {company_id:company_id},
                }); 
                request.done(function( msg ) {
                    $('#customer_select').html(msg);
                });
                request.fail(function( jqXHR, textStatus ) {
                    alert('please select a customer')
              });
           });
        });
    </script>
    <script>
        $(document).ready(function(){
            $('#vin').focusout(function(){
                $('#vin_exist').html("<div style='color:blue !important'><img width='30px' src= '"+"{{asset('img/loading.gif')}}"+"' alt='Loading ...'> </div> ");
                var vin=$(this).val();
               var request = $.ajax({
                  url: "{{route('single_vehicle_vin')}}",
                  method: "GET",
                  data: {vin:vin},
                }); 
                request.done(function( msg ) {
                    if(msg)
                    $('#vin_exist').text('This VIN already exist ! ');
                    else  $('#vin_exist').text('');
                });
                request.fail(function( jqXHR, textStatus ) {
                    alert(textStatus)
              });
           });
        });
    </script>
    <script >
        $(document).ready(function(){
        //iterate through each textboxes and add keyup
        //handler to trigger sum event
        $(".txt").each(function() {

            $(this).keyup(function(){
                calculateSum();
            });
        });
    });
    function calculateSum() {
        var sum = 0;
        //iterate through each textboxes and add the values
        $(".txt").each(function () {
            //add only if the value is number
            if (!isNaN(this.value) && this.value.length != 0) {
                sum += parseFloat(this.value);
            }
        });
        $("#sum").val(sum.toFixed(2));
    }
      $(document).ready(function(){
            $('#slaescost').on('keyup', function(e) {
               var sumoftotal=$("#sum").val();
               var salescost=$("#slaescost").val();
               var c=salescost-sumoftotal;
               $("#profit").val(c.toFixed(2));
            });
     });
    $(document).ready(function(){
       $('#slaescost').on('keyup', function(e) {
            var sumoftotal=$("#sum").val();
            var profitcost=$("#profit").val();
            var c=(profitcost*100)/sumoftotal;
            $('#percent').val(c.toFixed(2));
        });
    });
    </script>
@stop
