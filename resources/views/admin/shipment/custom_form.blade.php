@extends('admin.layout.main')
@section('title','Custom form')
@section('js')
    <script>
        $(document).ready(function(){
         $('#print').click(function(){
             $(".row").css("margin-top","-110px");
             $('.no-print').css('visibility','hidden');
             window.print(); 
            setTimeout(function(){
                $(".row").css("margin-top","0px");
                $('.no-print').css('visibility','visible');
            },50);
        });
    })
    </script>
@stop
<style type="text/css">
 table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    #td1, #th1 {
        border: 2px solid #0a0a0a;
        text-align: left;
        padding: 0px;
        font-size:14px;
    }
    #tr1:nth-child(even) {
        background-color: #dddddd;
    }
    #customers {
        font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }
</style>
@section('content')
<div class="site-content">
  <div class="content-area py-1">
 <div class="container">
        <br class="no-print">
        <div class="row">
            <div class="col-md-6 col-md-offset-2">
                <button type="button" class="btn btn-info btn-rounded no-print" id="print"><i class="fa fa-print"></i>&nbsp;Print</button>&nbsp;
            </div>
            <br class="no-print">
            <br class="no-print">
            <br class="no-print">
            <div class="col-md-6 col-md-offset-2" style="font-size: 18px; font-weight: bold;">
                <img src="{{asset('img/logo.png')}}" width="100px" height="100px">&nbsp;&nbsp;&nbsp; PGL Custom Form
            </div>

            <div class="col-md-12">
                <br>
                <br>

                <div class="col-md-10 col-md-offset-1 " >
                    <table id="customers">
                        <tr>
                            <th id="td1" rowspan="6">
                                SHIPPER / EXPORTER 
                                <br>
                                {{isset($conti)?$conti->shipper_exporter : ''}}
                                <br>
                                {{isset($conti)?$conti->shipper_street_address : ''}}
                                <br>
                                {{isset($conti)?$conti->shipper_city : ''}}, {{isset($conti)?$conti->shipper_state : ''}}, {{isset($conti)?$conti->shipper_zip_code : ''}}
                                <br>
                                {{isset($conti)?$conti->shipper_email_address : ''}}
                                <br>
                                Phone: {{isset($conti)?$conti->shipper_phone_number : ''}} - Fax: {{isset($conti)?$conti->shipper_fax_number : ''}}
                            </th>
                            <th   id="td1"> BOOKING NUMEBR <br>
                                {{isset($conti)?$conti->booking_number : ''}}</th>
                            <th  id="td1"> BILL OF LADDING NO. <br>
                                {{isset($conti)?$conti->bolading_number : ''}}</th>
                        </tr>
                        <tr>
                            <td rowspan="2" id="td1" colspan="2">VESSEL / VOYAGE# / STEAMSHIP LINE / FLAG <br>    {{isset($conti)?$conti->vessel_name : ''}}/{{isset($conti)?$conti->voyage_number : ''}}#/{{isset($conti)?$conti->steamship_line : ''}}/{{isset($conti)?$conti->flag : ''}}
                                </td>


                        </tr>
                        <tr>

                        </tr>
                        <tr>

                            <td id="td1">PLACE OF RECEIPT<br> {{isset($conti)?$conti->place_receipt : ''}}</td>
                            <td id="td1">COUNTRY OF ORIGIN<br>{{isset($conti)?$conti->country_origin : ''}}</td>
                        </tr>

                        <tr>
                       
                        </tr>
                        <tr>


                        </tr>
                        <tr>
                            <th id="td1" rowspan="6" >
                                CONSIGNEE  
                                <br>
                               <?php $data1=DB::table('tbl_bases')->join('vehicles','tbl_bases.vehicle_id','vehicles.id')->where('tbl_bases.container_id',isset($conti)?$conti->id : '')->first();
                                      $data=DB::table('customers')->where('id',$data1->customer_id)->first();  

                             ?>{{isset($data->consignee)?$data->consignee : ''}} <br>
                                {{isset($data->cons_street)?$data->cons_street : ''}}
                                <br>
                                P. O. Box Number: {{isset($data->cons_box)?$data->cons_box : ''}} 
                                <br>
                                {{isset($data->cons_poc)?$data->cons_poc : ''}}, {{isset($data->cons_email)?$data->cons_email : ''}}  -  Phone: {{isset($data->cons_phone)?$data->cons_phone : ''}}
                                <br>
                               {{isset($data->cons_city)?$data->cons_city : ''}}, {{isset($data->cons_zip_code)?$data->cons_zip_code : ''}}, {{isset($data->cons_country)?$data->cons_country : ''}}
                            </th>

                        </tr>
                        <tr>

                        </tr>
                        <tr>


                        </tr>
                        <tr>


                            <th  id="td1"> PORT OF LOADING <br>
                            {{isset($conti)?$conti->port_loading : ''}}</th>
                            <th  id="td1">PORT OF DISCHARGE <br>
                            {{ isset($conti)?$conti->port_discharge:'' }}</th>
                        </tr>

                        <tr>

                            <td id="td1"></td>
                            
                            <td id="td1"></td>

                        </tr>
                        <tr>
                            <th   id="td1"> ETD AT PORT OF LOADING
                                <br>
{{ isset($conti)?$conti->etd_port_loading:'' }}

                            </th>
                            <th  id="td1">ETA AT PORT OF DISCHARGE
                                <br>
{{ isset($conti)?$conti->eta_port_discharge:'' }}
                            </th>
                        </tr>
                        <tr>
                            <th id="td1" rowspan="6">NOTIFY PARTY
                                <br>
                                {{isset($data->notify_party)?$data->notify_party : ''}}
                                <br>
                                {{isset($data->notify_street)?$data->notify_street : ''}}
                                <br>
                                P. O. Box Number:  {{isset($data->notify_box)?$data->notify_box : ''}}
                                <br>
                               {{isset($data->notify_city)?$data->notify_city : ''}}, {{isset($data->notify_zip)?$data->notify_zip : ''}}, {{isset($data->notify_country)?$data->notify_country : ''}}
                                <br>
                                {{isset($data->notify_poc)?$data->notify_poc : ''}}, {{isset($data->notify_email)?$data->notify_email : ''}} -  Phone: {{isset($data->notify_phone)?$data->notify_phone : ''}}
                            </th>
                            <tr>
                            <th id="td1" rowspan="5" colspan="2">EXPORT REFERENCES NUMBER: <br>
                            

                            {{ isset($conti)?$conti->pglr_number:''}} <br>
                                
                                
                            </th>
                            </tr>
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
                    </table>
                    <div id="yoba">
                        
                            <table width="100%">
                                <tbody><tr >

                                    <th style="text-align: center;" id="td1" >MARKS & NUMBERS</th>
                                    <th style="text-align: center;"  id="td1" >Description of Packages and Goods</th>
                                    <th style="text-align: center;"  id="td1" >Title Number</th>
                                    <th style="text-align: center;"  id="td1" >Title State</th>

                                    <th  style="text-align: center;" id="td1" >Weight KGs</th>
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
                                        <!--br>
                                        HS_Code:
                                        <br>
                                         87032112
                                        <br>-->
                                        AES ITN Number:
                                        <br>
                                        {{isset($conti)?$conti->aes_itn_number : ''}}
                                        <br>
                                        SCAC Code:
                                        <br>
                                        {{isset($conti)?$conti->scac_code : ''}}
                                        <br>
                                         <!--MEASUREMENT:
                                        <br>
                                         {{ isset($conti)?$conti->meas:'' }}-->
                                         
                                    </td>
                                    
                                    <td rowspan="8" style="text-align: left;padding-bottom:100px;font-size:12px;" id="td1"><h5 style="text-align:center;">{{isset($conti)?$conti->n_units_load : ''}} Listed below</h5>
                                        <?php $i=1; $data=DB::table('tbl_bases')->join('vehicles','tbl_bases.vehicle_id','vehicles.id')->where('tbl_bases.container_id',isset($conti)?$conti->id : '')->get();
                                        foreach ($data as $datumo)
                                         {
                                        ?>
                                        <?php echo $i++.')&nbsp;'; echo @$datumo->year; ?>&nbsp;<?php echo @$datumo->make; ?>&nbsp;
                                            <?php echo @$datumo->model; ?>&nbsp;VIN#&nbsp;<?php echo @$datumo->vin."<br>"; ?>
                                        <?php } ?>
                                    </td> 
                                    <td rowspan="8" style="text-align: left;padding-bottom:100px;font-size:12px;" id="td1"><h5></h5><Br>
                                        <?php $i=1; $data=DB::table('tbl_bases')->join('vehicles','tbl_bases.vehicle_id','vehicles.id')->where('tbl_bases.container_id',isset($conti)?$conti->id : '')->get();
                                        foreach ($data as $datumo)
                                         {
                                        ?>
                                        <?php echo $i++.')&nbsp;'; echo @$datumo->title_number."<br>"; ?>
                                        <?php } ?>
                                    </td>
                                     <td rowspan="8" style="text-align: left;padding-bottom:100px;font-size:12px;" id="td1"><h5></h5><Br>
                                        <?php $i=1; $data=DB::table('tbl_bases')->join('vehicles','tbl_bases.vehicle_id','vehicles.id')->where('tbl_bases.container_id',isset($conti)?$conti->id : '')->get();
                                        foreach ($data as $datumo)
                                         {
                                        ?>
                                        <?php echo $i++.')&nbsp;'; echo @$datumo->title_state."<br>"; ?>
                                        <?php } ?>
                                    </td>
                                    
                                    
                                    <td rowspan="8" style="text-align: left;padding-bottom:100px;" id="td1"><h5></h5><Br>  <?php $i=1; $sum1=0;
                                    $data=DB::table('tbl_bases')->join('vehicles','tbl_bases.vehicle_id','vehicles.id')->where('tbl_bases.container_id',isset($conti)?$conti->id : '')->get();
                                        foreach ($data as $datumo)
                                        {
                                        ?>
                                        <?php echo $i++.')&nbsp;'; echo @$datumo->weight."<br>"; ?>
                                        <?php $sum1=(int)@$sum1+(int)@$datumo->weight; } ?></td>
                                        
                                        
                                    <td rowspan="8" style="text-align: left;padding-bottom:100px;" id="td1"><h5></h5><Br>
                                           <?php  $sum=0;
                                           $data=DB::table('tbl_bases')->join('vehicles','tbl_bases.vehicle_id','vehicles.id')->where('tbl_bases.container_id',isset($conti)?$conti->id : '')->get();
                                           foreach ($data as $datumo)
                                            {
                                            ?>
                                           $&nbsp;<?php echo @$datumo->vehicle_price; ?><br>

                                         <?php $sum=(int)$sum+(int)$datumo->vehicle_price; } ?>
                                         
                                         
                                         <!-- I remove this value  -> vehicle_price   -->
                                        
                                    </td>

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
                                    <td></td>
                                     <td></td>
                                    <td id="td1" style="text-align: center;"><?php echo @$sum1; ?></td>
                                    <td id="td1" style="text-align: center;">$&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo @$sum; ?></td>
                                </tr>


                                <tr>
                           </tr>
                            </tbody></table>

                    </div>

                </div>
            </div>
        </div>
    </div>
 </div>
</div>
@endsection