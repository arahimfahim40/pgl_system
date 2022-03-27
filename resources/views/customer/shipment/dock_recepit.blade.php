@extends('customer.layout.main')
@section('title','Dock Recepit')
<style>
    table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    #td1, #th1 {
        border: 2px solid #0a0a0a;
        text-align: left;
        padding: 0px;
    }

    #tr1:nth-child(even) {
        background-color: #dddddd;
    }
    #customers {
        font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }
    .hide{
        display: none !important;
    }
</style>
@section('js')
<script type="text/javascript">
    $(document).ready(function(){
        // $(".vehicles").addClass('active');
        // print section
         $('#print').click(function(){
            $(this).addClass('hide');
            $('no-print').addClass('hide');
            $(".love").css("margin-top","-50px");
            window.print(); 
        });
    })
</script>
@stop
@section('content')
<div class="site-content">
  <div class="content-area py-1">
    <div class="container-fluid"> 
    <div class="container" style="font-size:4px; padding-bottom:100px;">
        <div class="row love">
            <br class="no-print">
            <div class="col-md-6 col-md-offset-2 no-print">
                &nbsp;&nbsp; <button type="button" class="btn btn-info no-print" id="print"><i class="fa fa-print"></i>&nbsp;Print</button>
            </div>
            <br class="no-print">
            <br class="no-print">
            <div class="col-md-6 col-md-offset-2" style="font-size: 18px; font-weight: bold;">
            </div>

            <div class="col-md-12">
                <br>
                <br>

                <div class="col-md-10 col-md-offset-1 " >
                    <table id="customers">

                        <tr>
                            <td id="td1" rowspan="5">
                                SHIPPER / EXPORTER  
                            </td>
                            <td id="td1">BOOKING NUMEBR <br>{{ isset($conti)?$conti->booking_number:'' }}</td>
                            <td id="td1">BILL OF LADDING NO. <br>{{isset($conti)?$conti->bolading_number : ''}}</td>

                        </tr>
                        <tr>


                        </tr>
                        <tr>

                            <td id="td1" rowspan="3" colspan="2">EXPORT REFERENCES AND INSTRUCTIONS<br>{{ isset($conti)?$conti->pglr_number : ''}}/{{ strip_tags(isset($conti)?$conti->export_instruc : '')}}</td>

                        </tr>

                        <tr>

                        </tr>
                        <tr>


                        </tr>

                        <tr>
                            <td id="td1" rowspan="5">CONSIGNEE<br>
                            <?php $data1=DB::table('tbl_bases')->join('vehicles','tbl_bases.vehicle_id','vehicles.id')->where('tbl_bases.container_id',isset($conti)?$conti->id : '')->first();
                                      $data=DB::table('customers')->where('id',$data1->customer_id)->first();  

                            ?>
                                
                                
                            </td>
                            <td id="td1" rowspan="4" colspan="2"> FORWARDING AGENT 
                               
                            </td>

                        </tr>
                        <tr>


                        </tr>
                        <tr>

                        </tr>

                        <tr>


                        </tr>
                        <tr>
                            <th id="td1" colspan="2">COUNTRY OF ORIGIN <br>{{isset($conti)?$conti->country_origin : ''}} </th>


                        </tr>
                        <tr>

                        </tr>
                        <tr>
                            <td id="td1" rowspan="5">NOTIFY PARTY
                            </td>

                        </tr>
                        <tr>

                            <td id="td1">POINT OF LOADING <br>{{isset($conti)?$conti->port_loading : ''}}</td>
                            <td id="td1">PORT OF DISCHARGE <br>{{isset($conti)?$conti->port_discharge : ''}}</td>

                        </tr>
                        <tr>

                            <td id="td1" >VESSEL: <br>{{isset($conti)?$conti->vessel_name : ''}}</td>
                            <td id="td1">VOYAGE NO: <br>{{isset($conti)?$conti->voyage_number : ''}}</td>
                        </tr>
                        <tr>
                            <td id="td1" rowspan="2" >ETD AT LOADING PORT (Sailing date) <br>{{isset($conti)?$conti->etd_port_loading : ''}}</td>
                            <td id="td1" rowspan="2">ETA AT PORT OF DISCHARGE <br>{{isset($conti)?$conti->eta_port_discharge : ''}}</td>


                        </tr>
                        <tr>

                        </tr>
                        <tr>

                            <th style="text-align: center;" colspan="3" id="td1">Particulars Furnished by Shipper</th>

                        </tr>

                    </table>
                        <div id="yoba">
                            <table width="100%">
                                <tbody><tr >

                                    <th style="text-align: center;" id="td1" >MARKS & NUMBERS</th>
                                    <th style="text-align: center;"  id="td1" >Description of Packages and Goods</th>

                                    <th  style="text-align: center;" id="td1" >Gross Weight
                                        KGs</th>
                                    <th style="text-align: center;"  id="td1">Value $</th>
                                </tr>
                                <tr>
                                    <td id="td1" style="text-align: center;" rowspan="9">CONTAINER NO.: <br>{{isset($conti)?$conti->container_number : ''}}
                                        <br>
                                        Container Size/Type:
                                        <br>
                                        {{isset($conti)?$conti->c_size : ''}}
                                        <br>
                                        SEAL Number:
                                        <br>
                                        {{isset($conti)?$conti->seal_number : ''}}
                                        <br>
                                        AES ITN Number:
                                        <br>
                                        {{isset($conti)?$conti->aes_itn_number : ''}}
                                        <br>
                                        SCAC Code:
                                        <br>
                                        {{ isset($conti)?$conti->scac_code:'' }}
                                        <br>
                                        MEASUREMENT:
                                        <br>
                                         {{ isset($conti)?$conti->meas:'' }}

                                    </td>
                                    
                                    <td rowspan="8" style="text-align: left;padding-bottom:100px;font-size:12px;" id="td1"><h5 style="text-align:center;">{{isset($conti)?$conti->n_units_load : ''}} Listed below</h5>
                                        <?php $i=1; $data=DB::table('tbl_bases')->join('vehicles','tbl_bases.vehicle_id','vehicles.id')->where('tbl_bases.container_id',isset($conti)?$conti->id : '')->get();
                                        foreach ($data as $datumo)
                                         {
                                        ?>
                                        <?php echo $i++.')&nbsp;'; echo $datumo->year; ?>&nbsp;<?php echo $datumo->make; ?>&nbsp;
                                            <?php echo $datumo->model; ?>&nbsp;VIN#&nbsp;<?php echo $datumo->vin; ?>&nbsp;Title#&nbsp;<?php echo $datumo->title_number."<br>"; ?>
                                        <?php } ?>
                                    </td>
                                    <td rowspan="8" style="text-align: right;padding-bottom:100px;" id="td1"> <h5></h5><Br> <?php
                                    $i=1; $sum1=0;
                                    $data=DB::table('tbl_bases')->join('vehicles','tbl_bases.vehicle_id','vehicles.id')->where('tbl_bases.container_id',isset($conti)?$conti->id : '')->get();
                                        foreach ($data as $datumo)
                                        {
                                        ?>
                                        <?php echo $i++.')&nbsp;'; echo $datumo->weight."<br>"; ?>
                                        <?php $sum1=$sum1+$datumo->weight; } ?></td>
                                    <td rowspan="8" style="text-align: right;padding-bottom:100px;" id="td1"> <h5></h5><Br><?php  $sum=0;
                                    $data=DB::table('tbl_bases')->join('vehicles','tbl_bases.vehicle_id','vehicles.id')->where('tbl_bases.container_id',isset($conti)?$conti->id : '')->get();
                                        foreach ($data as $datumo)
                                        {
                                            ?>
                                       $&nbsp;<?php echo $datumo->vehicle_price; ?><br>

                                        <?php $sum=$sum+$datumo->vehicle_price; } ?></td>

                                </tr>

                                <tr>


                                </tr>
                                <tr>

                                </tr>
                                <tr>

                                </tr>
                                <tr>

                                </tr>
                                <tr>

                                </tr>
                                <tr>

                                </tr>
                                <tr>

                                </tr>
                                <tr>

                                    <td id="td1">TOTAL KGs & VALUE IN US$</td>
                                    <td id="td1" style="text-align: right;"><?php echo $sum1; ?></td>
                                    <td id="td1" style="text-align: right;">$&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $sum; ?></td>
                                </tr>


                                </tbody></table>
                            <table>
                                <tr>
                                    <td id="td1" colspan="2" style="width: 50%; text-align: center;">Delivered By: </td>

                                    <td id="td1" rowspan="4"  colspan="2">
                                        RECEIVED THE ABOVE DESCRIBED GOODS OR PACKAGES SUBJECT TO ALL
                                        THE TERMS OF THE UNDERSIGNED'S REGULAR FORM OF DOCK RECEIPT
                                        AND BILL OF LADING WHICH SHALL CONSTITUTE THE CONTRACT UNDER
                                        WHICH THE GOODS ARE RECEIVED, COPIES OF WHICH ARE AVAILABLE FROM
                                        THE CARRIER ON REQUEST AND MAY BE INSPECTED AT ANY OF ITS OFFICES.
                                        ALL VEHICLES IN THIS CONTAINER HAVE BEEN DRAIN AND BATTERIES HAVE
                                        HAVE BEEN DISCONNECTED AND PROPERLY STOWED IN THE CONTAINER.</td>
                                </tr>
                                <tr>
                                    <td id="td1" colspan="2">Lighter Truck:</td>

                                </tr>
                                <tr>
                                    <td id="td1">
                                        Arrived Date:
                                    </td>
                                    <td id="td1">Time</td>
                                </tr>
                                <tr>
                                    <td id="td1">Unloaded Date:</td>
                                    <td id="td1">Time</td>
                                </tr>
                                <tr>
                                    <td id="td1" rowspan="3"  colspan="2"> <br>
                                        <br>Checked By __________________________________ <br>
                                        <br>
                                        <br>


                                        Placed in Ship On Dock Location: _____________________</td>
                                    <td id="td1" rowspan="3" colspan="2">By __________________________________ <br>
                                        <br><br>Date _______________________________________</td>
                                </tr>

                            </table>

                        </div>
                </div>
            </div>
        </div>
    </div>
  </div>
</div>
</div>
@endsection