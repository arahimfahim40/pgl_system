<style>
    table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    #td1, #th1 {
        border: 1px solid #0a0a0a;
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
    td,th{
        font-size: 14px;
    }
</style>
<div class="container">
    <div class="row">

        <div class="col-md-12">
            <br>
            <br>

            <div class="col-md-10 col-md-offset-1 " >
                <table id="customers">
                    <tr>
                        <td  rowspan="5">
                            <img src="{{asset('img/logo.png')}}" width="150px" height="150px">
                        </td>
                        <th >Peace Global Logistics </th>
                        <th >Invoice </th>
                    </tr>
                    <?php $comp_profile=DB::table('pgl_profiles')->first(); ?>
                    <tr>
                        <td>{{$comp_profile->street}} <br>
                            {{$comp_profile->city}}, {{$comp_profile->state}}, {{$comp_profile->zip_code}} <br>
                            {{$comp_profile->email}}</td>
                        <td>Number:&nbsp;&nbsp;{{isset($pgl_invoice)?$pgl_invoice->inv_number :''}} <br>Issue Date:&nbsp;&nbsp;{{isset($pgl_invoice)?$pgl_invoice->inv_date :''}} <br>
                            Due Date:&nbsp;&nbsp;{{ isset($pgl_invoice)?$pgl_invoice->inv_due_date:'' }} <br>
                            <?php $today=Carbon\Carbon::parse(Carbon\Carbon::today());
                            $inv_date_ude=Carbon\Carbon::parse(isset($pgl_invoice)?$pgl_invoice->inv_due_date :'');
                            if($today > $inv_date_ude){
                            ;?>
                            Past Due Days:&nbsp;&nbsp;{{$total=$today->diffInDays($inv_date_ude)}}</td>
                        <?php }else{ ?>
                        Past Due Days:&nbsp;&nbsp;0</td>
                        <?php }?>
                    </tr>
                    <tr>
                            <td></td>
                            <td> Payment Received :$<?=$pgl_invoice->payment_rece?></td>
                        </tr>
                    <tr>
                        <th style="background: rgb(216, 216, 216); color: black; text-align: left;">Bill TO: </th>


                        <th style="background: rgb(216, 216, 216); color: black; text-align: left;">Balance Due &nbsp;$&nbsp;{{ (isset($pgl_invoice)?$pgl_invoice->inv_amount :'') - (isset($pgl_invoice)?$pgl_invoice->payment_rece :'' )}}</th>

                    </tr>
                    <?php $company=DB::table('companies')->join('customers','companies.id','customers.company_id')->where('companies.id',isset($pgl_invoice)?$pgl_invoice->company_id :'')->first(); ?>
                    <tr>
                        <td colspan="2">{{@$company->name}} <br>
                            {{@$company->customer_address}}, {{@$company->comp_city}}, {{@$company->zip_code}} <br>
                            {{@$company->country}} &nbsp;Phone: {{@$company->customer_phone}}</td>

                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>

                        <th  style="background: rgb(216, 216, 216); text-align: center; color: black;" colspan="4" >Cargo Information</th>

                    </tr>
                    <?php $container=DB::table('containers')->where('id',isset($pgl_invoice)?$pgl_invoice->container_id :'')->first(); ?>
                    <tr>
                        <td colspan="2">Container Number:&nbsp;&nbsp;{{@$container->container_number}} <br>
                            Booking Number:&nbsp;&nbsp;{{@$container->booking_number}} <br>
                            Origin:&nbsp;&nbsp;{{@$container->port_loading}} <br>
                            Destination:&nbsp;&nbsp;{{@$container->port_discharge}}</td>

                        <td colspan="2">Consignee:&nbsp;&nbsp;{{@$company->name}} <br>
                            Carrier Name:&nbsp;&nbsp;{{@$container->vessel_name}} <br>
                            ETD:&nbsp;&nbsp;{{@$container->etd_port_loading}} <br>
                            ETA:&nbsp;&nbsp;{{@$container->eta_port_discharge}}</td>

                    </tr>
                </table>
                <div id="yoba">
                    <table width="100%">
                        <tbody><tr>
                            <th style="background: rgb(216, 216, 216); color: black;" id="td1" >No.</th>
                            <th style="background: rgb(216, 216, 216); color: black;" id="td1"  >Description </th>
                            <th style="background: rgb(216, 216, 216); color: black;" id="td1"  >Towing</th>
                            <th style="background: rgb(216, 216, 216); color: black;" id="td1" >Dismantle</th>
                            <th style="background: rgb(216, 216, 216); color: black;" id="td1">Shipping</th>
                            <th style="background: rgb(216, 216, 216); color: black;" id="td1" >Storage</th>
                            <th style="background: rgb(216, 216, 216); color: black;" id="td1" >Other</th>
                            <th style="background: rgb(216, 216, 216); color: black;" id="td1" >Total</th>
                        </tr>
                        <?php
                        $nom=1;
                        $sumoallo=0;
                        $sum1=0;
                        $sum2=0;
                        $sum3=0;
                        $sum4=0;
                        $sum5=0;
                        $sumgrand=0;
                        $data=DB::table('tbl_bases')->join('vehicles','tbl_bases.vehicle_id','vehicles.id')->where('tbl_bases.container_id',isset($pgl_invoice)?$pgl_invoice->container_id :'')->get();
                        foreach ($data as $datumo)
                        {
                        ?>


                        <tr >
                            <td id="td1" ><?php echo $nom++;?></td>
                            <td id="td1">  <?php echo $datumo->year; ?>&nbsp;<?php echo $datumo->make; ?>&nbsp;
                                    <?php echo $datumo->model; ?>&nbsp;VIN#&nbsp;<?php echo $datumo->vin; ?>&nbsp;  <br> Lot No: {{$datumo->lot_number}}
                                  &nbsp;<br> Auction City: {{$datumo->auction_city}}
                                  <br>
                                  
                                  Descr : <?=$datumo->invoice_description;?>
                            </td>
                            <td id="td1" style="text-align:right;">$&nbsp;{{$datumo->tow_amounts}}</td>
                            <td id="td1" style="text-align:right;">$&nbsp;{{$datumo->dismantal_cost}}</td>
                            <td id="td1" style="text-align:right;">$&nbsp;{{$datumo->ship_cost}}</td>
                            <td id="td1" style="text-align:right;">$&nbsp;{{$datumo->pgl_storage_costs}}</td>
                            <td id="td1" style="text-align:right;">$&nbsp;{{$datumo->other_cost}}</td>
                            <td id="td1" style="text-align:right;">$&nbsp;<?php echo $datumo->tow_amounts+$datumo->dismantal_cost+$datumo->ship_cost+$datumo->pgl_storage_costs+$datumo->other_cost;?></td>
                        </tr>

                        <?php $sum1=$sum1+$datumo->tow_amounts; ?>
                        <?php $sum2=$sum2+$datumo->dismantal_cost; ?>
                        <?php $sum3=$sum3+$datumo->ship_cost; ?>
                        <?php $sum4=$sum4+$datumo->pgl_storage_costs; ?>
                        <?php $sum5=$sum5+$datumo->other_cost; ?>

                        <?php } ?>
                        <tr>
                            <th style="background: rgb(216, 216, 216); color: black;"  id="td1"></th>
                            <th style="background: rgb(216, 216, 216); color: black;" id="td1" >Total </th>
                            <th style="background: rgb(216, 216, 216); color: black; text-align:right;"  id="td1">$&nbsp;{{$sum1}}</th>
                            <th style="background: rgb(216, 216, 216); color: black; text-align:right;" id="td1">$&nbsp;{{$sum2}}</th>
                            <th style="background: rgb(216, 216, 216); color: black; text-align:right;" id="td1">$&nbsp;{{$sum3}}</th>
                            <th style="background: rgb(216, 216, 216); color: black; text-align:right;" id="td1">$&nbsp;{{$sum4}}</th>
                            <th style="background: rgb(216, 216, 216); color: black; text-align:right;" id="td1">$&nbsp;{{$sum5}}</th>
                            <th style="background: rgb(216, 216, 216); color: black; text-align:right;" id="td1">$&nbsp;{{ $sum1+$sum2+$sum3+$sum4+$sum5 }}</th>
                        </tr>
                        </tbody>
                    </table>
                       <table width="100%">
                             <tbody>
                            <tr style="background: rgb(254, 231, 153); color: black;">
                                <th><br> <span style="text-align:left; float:left; padding-left:-200px;">Additional Note : {{$pgl_invoice->description}}</span></th>
                                
                            </tr>
                            <tr style="background: rgb(254, 231, 153); color: black;">
                                <td style="padding-left:35%; width:100%">
                                    <br><br><br>
                                <b>Wire Transfer Information:</b>
                                     <br>
                                    Bank Name: {{$comp_profile->bank_name}}<br>
                                    Acount Name:{{$comp_profile->account_name}}<br>
                                    Account #: {{$comp_profile->account_number}} <br>
                                    ABA Routing: {{$comp_profile->aba}} <br>
                                    SWIFT Code: {{$comp_profile->swift}}<br>
                                    {{$comp_profile->b_street}} <br>
                                    {{$comp_profile->b_city}}, {{$comp_profile->b_state}}, {{$comp_profile->b_zip}} <br>
                                    {{$comp_profile->b_country}}
                                </td>
                            </tr>
                             </tbody>
                        </table>
                        <table width="100%">
                             <tbody>
                            <tr>
                                <th style="background: rgb(216, 216, 216); color: black;" >Phone: <br> {{$comp_profile->phone}}</th>
                                <th style="background: rgb(216, 216, 216); color: black;" >Fax: <br>{{$comp_profile->fax}}</th>
                                <th style="background: rgb(216, 216, 216); color: black;" >Website:<br>{{$comp_profile->website}}</th>
                                <th style="background: rgb(216, 216, 216); color: black;" >Facebook:<br>{{$comp_profile->facebook}}</th>
                            </tr>
                            
                            </tbody>
                        </table>

                </div>

            </div>
        </div>
    </div>
</div>
