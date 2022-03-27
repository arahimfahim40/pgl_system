@extends('admin.layout.main')
@section('title','Release Document')
@section('js')
<script>
    $(document).ready(function(){
     $('#print').click(function(){
         $('.no-print').css('visibility','hidden');
        $(".love").css("margin-top","-120px");
        window.print();
        setTimeout(function(){
            $(".love").css("margin-top","0px");
            $('.no-print').css('visibility','visible');
        },50); 
    });
  });
</script>
@stop
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
    .stamps{
        vertical-align: center;
        position: relative;
        float: right;
        margin-right: 5px;
        margin-bottom: 3px;
        font-size:10px !important;   
    }
    .titles{
        color: blue;
        margin-bottom: 3px !important;
    }
    .release_document td,th{
        font-size: 12px !important;
        padding-left: 3px !important;
    }
    @media print {
    .titles{
        color: blue !important;
        margin-bottom: 3px !important;
        -webkit-print-color-adjust: exact;
        }
    }
    .hide{
        display: none;
    }
}
</style>
@section('content')
<div class="site-content">
   <div class="content-area py-1">
    <div class="container"> 
        <br class="no-print">
        <div class="row love">
            <div class="col-md-6 col-md-offset-2 no-print">
                <button type="button" class="btn btn-info btn-rounded no-print" id="print"><i class="fa fa-print"></i>&nbsp;Print</button>&nbsp;
            </div>
            <br class="no-print">
            <br class="no-print">
            <br class="no-print">
            <div class="col-md-6 col-md-offset-2" style="font-size: 18px; font-weight: bold;">
                <img src="{{asset('img/logo.png')}}" width="80px" height="80px">
            </div>
            <div class="col-md-12">
                <br class="no-print">
                <div id="out" style="text-align: center;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span class="titles">BILL OF LADDING </span></div>
                <div class="col-md-10 col-md-offset-1" id="tabContainer">
                    <table id="customers" class="release_document">
                        <tr>
                            <th id="td1" rowspan="5">
                                <span class="titles">SHIPPER / EXPORTER</span> 
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
                            
                            <th  id="td1" colspan="2"> <span class="titles">BILL OF LADDING NO</span> <br>
                                AE  {{substr(@$conti->booking_number,-5)}}
                                <?php if(strpos($conti->steamship_line,'ONE')!== false){
                                    echo "OL";
                                    }
                                    elseif(strpos($conti->steamship_line,'MEARSK')!== false){
                                    echo "MK";
                                    }
                                    elseif(strpos($conti->steamship_line,'MAERSK')!== false){
                                    echo "MK";
                                    }
                                    elseif(strpos($conti->steamship_line,'HAPAG')!== false){
                                    echo "HG";
                                    }
                                    elseif(strpos($conti->steamship_line,'YANGMING')!== false){
                                    echo "YM";
                                    }
                                    elseif(strpos($conti->steamship_line,'MSC')!== false){
                                    echo "MC";
                                    }
                                    else{
                                        echo substr($conti->steamship_line,0,2);
                                    }
                                ?>  
                                    
                                {{substr(@$conti->inv_number,-4)}}
                            </th>
                            
                        </tr>
                        <tr></tr>
                        <tr></tr>
                        <tr>
                            <td id="td1"> <span class="titles">PLACE OF RECEIPT</span><br> 
                                {{@$conti->place_receipt}}</td>
                            <td id="td1"> <span class="titles">COUNTRY OF ORIGIN</span><br>
                                {{$conti->country_origin}}</td>
                        </tr>

                        <tr>
                            <th  rowspan="5" colspan="2" id="td1"><span class="titles">CONTACT FOR CARGO RELASE </span><br>
                               P G L C SHIPPING L.L.C <br>
                                AL Qusais Industrial Area 4,AL Saoud <br>
                                Office 804 <br>
                                UAE,Dubai<br>
                                Phone:  + 971 045488069<br>
                                Email:  pglcshipping@peacegl.com
                            </th>
                        </tr>
                        
                        <tr>
                            <th id="td1" rowspan="6" >
                                <span class="titles">CONSIGNEE</span> 
                                <br>
                               <?php $data1=DB::table('tbl_bases')
                               ->join('vehicles','tbl_bases.vehicle_id','vehicles.id')
                               ->where('tbl_bases.container_id',@$conti->id)
                               ->first();
                                $data=DB::table('customers')
                                ->where('id',@$data1->customer_id)
                                ->first();?>
                                {{@$data->consignee}} <br>
                                {{@$data->cons_street}}
                                <br>
                                P. O. Box Number: {{@$data->cons_box}} 
                                <br>
                                {{@$data->cons_poc}}, {{@$data->cons_email}}  -  Land Phone: {{@$data->cons_phone}}
                                <br>
                               {{@$data->cons_city}}, {{@$data->cons_zip_code}}, {{@$data->cons_country}}
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
                            <th id="td1"><span class="titles">ETD AT PORT OF LOADING</span>
                                <br>
                                {{@$conti->etd_port_loading}}

                            </th>
                            <th id="td1"><span class="titles">ETA AT PORT OF DISCHARGE</span>
                                <br>
                                 {{@$conti->eta_port_discharge}}
                            </th>
                        </tr>
                        <tr>
                            <th id="td1" rowspan="4"><span class="titles">NOTIFY PARTY</span>
                                <br>
                                {{@$data->notify_party}}
                                <br>
                                {{@$data->notify_street}}
                                <br>
                                P. O. Box Number:  {{@$data->notify_box}}
                               <br>
                               {{@$data->notify_city}}, {{@$data->notify_zip}}, {{@$data->notify_country}}
                                <br>
                                {{@$data->notify_poc}}, {{@$data->notify_email}} -  Phone: {{@$data->notify_phone}}
                                  
                            </th>
                            <td></td>
                            <td></td>
                            
                        </tr>
                        <tr>

                            <th id="td1" rowspan="5" colspan="2" style="vertical-align: text-top;">
                                 <span class="titles">VESSEL :</span> {{@$conti->vessel_name}} 
                                 <hr style="border: 1px solid #0a0a0a; margin: 0px ;">
                                <span class="titles">VOYAGE :</span> {{@$conti->voyage_number}} 
                                <hr style="border: 1px solid #0a0a0a; margin: 0px;">
                                <span class="titles">FLAG :</span> {{@$conti->flag}}  
                                <hr style="border: 1px solid #0a0a0a; margin: 0px;">
                                <span class="titles">PORT OF LOADING :</span>
                                {{@$conti->port_loading}}
                                <hr style="border: 1px solid #0a0a0a; margin: 0px;">
                                <span class="titles">PORT OF DISCHARGE :</span>
                                {{ @$conti->port_discharge}} 
                                <hr style="border: 1px solid #0a0a0a; margin: 0px;">
                               <span class="titles">Date : </span>
                               {{date('Y-m-d')}} 
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
                            <th colspan="3" style="text-align:center;" id="td1"><span class="titles">PARTICULARS FURNISHED BY SHIPPER </span></th>
                        </tr>
                    </table>
                    <div id="yoba">
                        
                            <table width="100%">
                                <tbody>
                                <tr>
                                    <th style="text-align: center;" id="td1"><span class="titles">MARKS & NUMBERS</span></th>
                                    <th style="text-align: center;"  id="td1"><span class="titles">Description of Packages and Goods</span>
                                    </th>

                                    <th  style="text-align: center;" id="td1" colspan="2"><span class="titles">Gross Weight KGs</span></th>
                                    
                                </tr>
                                <tr>
                                    <td id="td1" style="text-align: left; padding-left:10px; vertical-align: text-top;" rowspan="">CONTAINER NO: <br>{{isset($conti)?$conti->container_number : ''}}
                                        <br>
                                        Container Size/Type:
                                        <br>
                                        {{isset($conti)?$conti->c_size : ''}}
                                        <br>
                                        SEAL Number:
                                        <br>
                                        {{isset($conti)?$conti->seal_number : ''}}
                                        <br>
                                    </td>
                                    
                                    <td  style="text-align: left;font-size:12px;" id="td1"><h5 style="text-align:center;">{{@$conti->n_units_load}} Listed below</h5>
                                        <?php $i=1; $data=DB::table('tbl_bases')->join('vehicles','tbl_bases.vehicle_id','vehicles.id')->where('tbl_bases.container_id',isset($conti)?$conti->id : '')->get();
                                        foreach ($data as $datumo)
                                         {
                                        ?>
                                        <?php echo $i++.')&nbsp;'; 
                                        echo @$datumo->year; ?>&nbsp;
                                        <?php echo @$datumo->make; ?>&nbsp;
                                            <?php echo @$datumo->model; ?>
                                            &nbsp; <?php echo @$datumo->color; ?>
                                            &nbsp;VIN#&nbsp;<?php echo @$datumo->vin; ?>&nbsp; <br>
                                        <?php } ?>
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
                                    <td rowspan="" colspan="" style="text-align: left; padding-left:10px; vertical-align: text-top;" id="td1"><h5></h5>  
                                        <?php $i=1; $sum1=0;
                                    $data=DB::table('tbl_bases')->join('vehicles','tbl_bases.vehicle_id','vehicles.id')->where('tbl_bases.container_id',isset($conti)?$conti->id : '')->get();
                                        foreach ($data as $datumo)
                                        {
                                        ?>
                                        <?php echo $i++.')&nbsp;'; echo @$datumo->weight."<br>"; ?>
                                        <?php $sum1=(float)@$sum1+(float)@$datumo->weight; } ?>
                                    </td>
                                </tr>
                                <tr>
                                     <td id="td1"></td>
                                    <td id="td1">TOTAL KGs </td>
                                    <td id="td1" style="text-align: left;"> &nbsp;&nbsp;&nbsp;<?php echo @$sum1; ?></td>
                                    
                                </tr>


                                <tr>
                                <th id="td1"  colspan="4" style="text-align: center;"><span class="titles">Basic Instructions :</span></th>
                            </tr>
                            <tr>
                                <td id="td1" colspan="4">
                                    {{ strip_tags(isset($conti)?$conti->basic_instruc : '')}}

                                </td>
                            </tr>
                            <tr>
                                <td id="td1" colspan="4" style="font-size: 12px; padding: 2px;"><span class="titles">IN ACCEPTING THIS BILL OF LOADING,the Shipper, Consignee, Holder hereof, and Owner of the goods, agree to be bounded by all of it's stipulation, exceptions and conditions whether written, printed or stamped of the fornt or back hereof as well as the provision of the above Carrier's published Traiff Rules and Regulations, as fully as if they were all signed by such Shipper, Consignee, Holder or Owner, and it is further agreed that containers are stowed on Deck, as per Clause 6.<br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;IN WITNESS WHEREOF, the Master of the said vessel has affirmed this Bill of Loading and authorized signature.
                                    <span class="stamps">
                                        <img src="{{asset('assets/images/stamp.jpg')}}" height="80px">
                                    </span>
                                    <H4 style="margin-left: 30%"><b>By</b> : PEACE GLOBAL LOGISTICS LLC </H4>
                                </span>
                                    <b style="margin-left: 30%">AS AGENT : </b> <br>
                                </td>
                            </tr>
                            <tr>
                                <td id="td1" colspan="4" style="font-size: 12px; padding: 2px;">Hereby certify having received the above described shipment in outwardly good condition from the shipper shown in section (Shipper/Exporter) for forwarding to the ultimate consignee shown in the section (Consignee) above in witness whereof, the ______________ nonnegotiable FCR's have been signed, and if one (1) is accomplished by Peace Global Logistics as agent, issuance of a delivery order or by some other means, the others shall be avoided if required by the freight forwarder One (1) original FCR must be surrendered. </td>
                            </tr>
                            </tbody></table>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
</div>
    <br><br>
    @endsection

