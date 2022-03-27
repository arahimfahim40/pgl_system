@extends('customer.layout.main')
@section('title','BOL')
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
            $(".love").css("margin-top","-110px");
            window.print(); 
        });
    })
</script>
@stop

@section('content')
<div class="site-content">
  <div class="content-area py-1">
    <div class="container-fluid"> 
    <div class="container">
        <div class="row love" >
            <div class="col-md-6 col-md-offset-2">
                <button type="button" class="btn btn-info no-print" id="print"><i class="fa fa-print"></i>&nbsp;Print</button>&nbsp;
                <a target="_blank" href="{{route('bol_pdf_customer',@$conti->id)}}" type="button" class="btn btn-info no-print" id="bol_pdf"><i class="fa fa-pdf"></i>&nbsp;PDF</a>&nbsp;
            </div>
            <br class="no-print">
            <br class="no-print">
            <div class="col-md-7 col-md-offset-2" style="font-size: 18px; font-weight: bold;">
                <img src="{{asset('img/logo.png')}}" width="100px" height="100px">&nbsp;&nbsp;&nbsp; PGL Bill of Lading / Shipping Instructions
            </div>
            <div class="col-md-12">
                <br class="no-print">
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
                            <th  rowspan="5" colspan="2" id="td1"> FORWARDING AGENT
                                <br>
                                {{isset($conti)?$conti->f_agent : ''}}
                                <br>
                                {{isset($conti)?$conti->f_street_address : ''}}
                                <br>
                                {{isset($conti)?$conti->f_city : ''}}, {{isset($conti)?$conti->f_state : ''}}, {{isset($conti)?$conti->f_zip_code : ''}}
                                <br>
                                Phone: {{isset($conti)?$conti->f_phone_number : ''}}/ Email: {{isset($conti)?$conti->f_email_address : ''}}
                                <br>

                            </th>
                        </tr>
                        <tr>
                            

                        </tr>
                        <tr>
                            <th id="td1" rowspan="6" >
                                CONSIGNEE  
                                <br>
                               <?php $data1=DB::table('tbl_bases')->join('vehicles','tbl_bases.vehicle_id','vehicles.id')->where('tbl_bases.container_id',isset($conti)?$conti->id : '')->first();
                                      $data=DB::table('customers')->where('id',$data1->customer_id)->first();  

                             echo $data->consignee;?> <br>
                                <?php echo $data->cons_street; ?>
                                <br>
                                P. O. Box Number: <?php echo $data->cons_box; ?>
                                <br>
                                <?php echo $data->cons_poc; ?>, <?php echo $data->cons_email; ?>  -  Phone: <?php echo $data->cons_phone; ?>
                                <br>
                                <?php echo $data->cons_city; ?>, <?php echo $data->cons_zip_code; ?>, <?php echo $data->cons_country; ?>
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
                                <?php echo $data->notify_party ;?>
                                <br>
                                <?php echo $data->notify_street ;?>
                                <br>
                                P. O. Box Number:  <?php echo $data->notify_box ;?>
                                <br>
                                <?php echo $data->notify_city ;?>, <?php echo $data->notify_zip ;?>, <?php echo $data->notify_country ;?>
                                <br>
                                <?php echo $data->notify_poc ;?>, <?php echo $data->notify_email ;?> -  Phone: <?php echo $data->notify_phone ;?>
                            </th>

                            <td id="td1"> </td>
                            <td id="td1"></td>
                        </tr>
                        <tr>

                            <th id="td1" rowspan="5" colspan="2">EXPORT REFERENCES, DOMESTIC ROUTING AND INSTRUCTIONS <br>
                            

                            {{ isset($conti)?$conti->pglr_number:''}}{{ strip_tags(isset($conti)?$conti->export_instruc:'')}} {{  isset($conti)?$conti->pglr_number:''}} {{ strip_tags(isset($conti)?$conti->export_instruc:'') }}
                            </th>
                        
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

                            <th colspan="3" style="text-align:center;" id="td1">PARTICULARS FURNISHED BY SHIPPER</th>
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
                                        {{isset($conti)?$conti->scac_code : ''}}
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
                                    <td rowspan="8" style="text-align: right;padding-bottom:100px;" id="td1"><h5></h5><Br>  <?php $i=1; $sum1=0;
                                    $data=DB::table('tbl_bases')->join('vehicles','tbl_bases.vehicle_id','vehicles.id')->where('tbl_bases.container_id',isset($conti)?$conti->id : '')->get();
                                        foreach ($data as $datumo)
                                        {
                                        ?>
                                        <?php echo $i++.')&nbsp;'; echo $datumo->weight."<br>"; ?>
                                        <?php $sum1=$sum1+$datumo->weight; } ?></td>
                                    <td rowspan="8" style="text-align: right;padding-bottom:100px;" id="td1"><h5></h5><Br><?php  $sum=0;
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


                                <tr>
                                <th id="td1"  colspan="4">Basic Instructions :</th>
                            </tr>
                            <tr>
                                <td id="td1" colspan="4">
                                    {{ strip_tags(isset($conti)?$conti->basic_instruc : '')}}

                                </td>
                            </tr>
                            <tr>
                                <td id="td1" colspan="4">The listed commodities were exported from the United States in accordance with the export administrative regulations. Diversion contrary to the U.S. Law is prohibited.</td>
                            </tr>
                            <tr>
                                <td id="td1" colspan="4">Hereby certify having received the above described shipment in outwardly good condition from the shipper shown in section (Shipper/Exporter) for forwarding to the ultimate consignee shown in the section (Consignee) above in witness whereof, the ______________ nonnegotiable FCR's have been signed, and if one (1) is accomplished by delivery of goods, issuance of a delivery order or by some other means, the others shall be avoided if required by the freight forwarder One (1) original FCR must be surrendered. </td>
                            </tr>
                            </tbody></table>

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
@endsection