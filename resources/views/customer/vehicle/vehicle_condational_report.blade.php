@extends('customer.layout.main')
@section('title','Condational report')
<style type="text/css">
    .condition_report {
        width: 8in;
        height: 13in;
        margin-right: auto;
        margin-left: auto;
        padding: 2px;
        font-family: Arial, Helvetica, sans-serif;
        font-size: 12px;
    }
    .condition_report .customer_part {
        float: left;
        width: 100%;
        margin-top: 40px;
    }
    .condition_report .top_processes {
        width: 758px;
        float: left;
        padding: 5px;
    }
    .condition_report .top_processes.ui-state-highlight .filer #got {
        float: right;
    }
    #print {
        float: left;
    }
    .condition_report .cond_here {
        float: left;
        width: 8in;
        margin-top: 3px;
    }
    .lefti   {
        float: left;
    }
    .righti  {
        float: right;
    }
    .condition_report .cond_here .lefti.title {
        font-size: 30px;
        font-weight: bold;
        margin-top: 20px;
        margin-left: 35px;
    }
    .condition_report .peso {
        font-size: 30px;
        font-weight: bold;
        margin-top: 20px;
        margin-left: 35px;
        margin-bottom: 30px;
    }
    .condition_report .customer_part .pics {
        float: left;
        width: 100%;
        margin-top: 10px;
    }
    .condition_report .customer_part .pics .pica {
        float: left;
        margin-left: 55px;
        width: 300px;
        height: 230px;
        margin-top: 10px;
    }
    .condition_report .cond_here .basic_info {
        float: left;
        width: 8in;
        margin-top: 10px;
    }
    .condition_report .cond_here .basic_info .part1 {
        float: left;
        width: 55%;
    }
    .condition_report .cond_here .basic_info .part2 {
        float: left;
        width: 44%;
        margin-left: 1%;
    }
    .condition_report .customer_part .part2 {
        float: left;
        width: 44%;
        margin-left: 1%;
    }
    .condition_report .cond_here .basic_info .checklist {
        width: 99%;
        float: left;
        margin-top: 5px;
        border: 1px solid #000;
        margin-left: 3px;
    }
    .condition_report .cond_here .basic_info .dimen {
        width: 99%;
        float: left;
        margin-left: 3px;
        border-right-width: 1px;
        border-bottom-width: 1px;
        border-left-width: 1px;
        border-right-style: solid;
        border-bottom-style: solid;
        border-left-style: solid;
        border-right-color: #000;
        border-bottom-color: #000;
        border-left-color: #000;
    }
    .condition_report .cond_here .basic_info .sign {
        width: 99%;
        float: left;
        margin-left: 3px;
        margin-top: 30px;
    }
    .condition_report .cond_here .basic_info .sign table tr .leni {
        float: left;
        width: 350px;
    }
    .condition_report .cond_here .basic_info .sign table tr .leni1 {
        float: left;
        width: 140px;
        margin-left: 15px;
    }
    .condition_report .cond_here .basic_info .papugay {
        width: 99%;
        float: left;
        margin-top: 5px;
        border: 1px solid #000;
        margin-left: 3px;
    }
    .condition_report .cond_here .basic_info .condition {
        width: 99%;
        float: left;
        margin-left: 3px;
        border-right-width: 1px;
        border-bottom-width: 1px;
        border-left-width: 1px;
        border-right-style: solid;
        border-bottom-style: solid;
        border-left-style: solid;
        border-right-color: #000;
        border-bottom-color: #000;
        border-left-color: #000;
    }
    .condition_report .cond_here .basic_info .picas1 {
        width: 50%;
        float: left;
        margin-left: 3px;
        border-right-width: 1px;
        border-bottom-width: 1px;
        border-left-width: 1px;
        border-right-style: solid;
        border-bottom-style: solid;
        border-left-style: solid;
        border-right-color: #000;
        border-bottom-color: #000;
        border-left-color: #000;
    }
    .condition_report .cond_here .basic_info .picas2 {
        width: 375px;
        float: left;
        border-right-width: 1px;
        border-bottom-width: 1px;
        border-right-style: solid;
        border-bottom-style: solid;
        border-right-color: #000;
        border-bottom-color: #000;
    }
    .condition_report .cond_here .basic_info .picas3 {
        float: left;
        margin-left: 3px;
        border-right-width: 1px;
        border-bottom-width: 1px;
        border-left-width: 1px;
        border-right-style: solid;
        border-bottom-style: solid;
        border-left-style: solid;
        border-right-color: #000;
        border-bottom-color: #000;
        border-left-color: #000;
        width: 50%;
    }
    .condition_report .cond_here .basic_info .picas4 {
        float: left;
        border-right-width: 1px;
        border-bottom-width: 1px;
        border-right-style: solid;
        border-bottom-style: solid;
        border-right-color: #000;
        border-bottom-color: #000;
        width: 375px;
    }
    .condition_report .cond_here .basic_info .picas4 #yoba {
        float: left;
        width: 100%;
        border-top-width: 1px;
        border-top-style: solid;
        border-top-color: #000;
    }
    .condition_report .cond_here .basic_info .picas3 #yoba  {
        border-top-width: 1px;
        border-top-style: solid;
        border-top-color: #000;
        float: left;
        width: 100%;
    }
    .condition_report .cond_here .basic_info #yoba table tr .line_right {
        border-right-width: 1px;
        border-right-style: solid;
        border-right-color: #000;
    }
    .condition_report .cond_here .basic_info .picas4 .lefti {
        float: left;
    }
    .condition_report .cond_here .basic_info table thead tr .biga  {
        font-size: 14px;
    }
    .condition_report .cond_here .basic_info table thead tr .biga1 {
        font-size: 12px;
    }
    .line_under   {
        border-bottom-width: 1px;
        border-bottom-style: solid;
        border-bottom-color: #000;
        font-family: "Courier New", Courier, monospace;
    }
    .condition_report .cond_here .basic_info .picas1 #piss {
        width: 227px;
        border-left-width: 1px;
        border-left-style: solid;
        border-left-color: #000;
        height: 125px;
    }
    .condition_report .cond_here .basic_info .picas2 #piss2 {
        width: 194px;
        border-left-width: 1px;
        border-left-style: solid;
        border-left-color: #000;
        height: 125px;
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
            $(".love").css("margin-top","-100px");
            window.print(); 
        });
    })
</script>
@stop
@section('content')
<div class="site-content">
  <div class="content-area py-1">
    <div class="container-fluid"> 
    <div class="love condition_report " >
        <div class="top_processes ui-state-highlight">
            <button type="button" class="btn btn-info" id="print"><i class="fa fa-print"></i>&nbsp;Print</button>&nbsp;
        </div>
        <input type="hidden" name="id" value="{{isset($signle_vehicle)? $signle_vehicle->id : ''}}">
        <div class="cond_here">
            <input type='hidden' id='vina' value='JTEZU14R340033747'/>
            <input type='hidden' id='cusa' value='900804'/>
            <div class="cond_logo lefti">
                <img src="{{asset('img/logo.png')}}" width="100px" height="100px" alt="ArianaW Logo">
            </div>

            <div class="lefti title">Vehicle Condition Report</div>
            <div class="basic_info">

                <div class="part1">
                    <table width="100%">

                        <tr>
                            <td width="18%"><b>Customer</b></td>
                            <td width="82%" class= "line_under" id="Customer Name"><?php $customer=DB::table('customers')->where('id',isset($signle_vehicle)? $signle_vehicle->customer_id : '')->get(); ?> @foreach($customer as $custo)&nbsp;&nbsp;{{$custo->customer_name}}&nbsp;  @endforeach</td>
                        </tr>

                    </table>

                    <table width="100%">
                        <tr>
                            <td width="18%"><b>Address</b></td>
                            <td width="37%" class= "line_under" id="Address L1"><?php $customer=DB::table('customers')->where('id',isset($signle_vehicle)? $signle_vehicle->customer_id : '')->get(); ?> @foreach($customer as $custo) {{$custo->customer_address}} @endforeach</td>
                           {{-- <td width="27%" class= "line_under" id="City">CARSON, </td>
                            <td width="7%" class= "line_under" id="State">CA 90247</td>
                            <td width="11%" class= "line_under" id="Zip Code"></td>--}}
                        </tr>
                    </table>

                    <table width="100%">
                        <tr>
                            <td width="18%"><b>Phone #</b></td>
                            <td width="44%" class= "line_under" id="Phone Number"><?php $customer=DB::table('customers')->where('id',isset($signle_vehicle)? $signle_vehicle->customer_id : '')->get(); ?> @foreach($customer as $custo) {{$custo->customer_phone}} @endforeach</td>
                            <td width="14%"><b>Weight</b></td>
                            <td width="24%" class= "line_under" id="Weight">{{isset($signle_vehicle)? $signle_vehicle->weight : ''}}</td>
                        </tr>
                    </table>

                    <table width="100%">
                        <tr>
                            <td width="18%"><b>Lot #</b></td>
                            <td width="44%" class= "line_under" id="Lot Number">{{isset($signle_vehicle)? $signle_vehicle->lot_number : ''}}</td>
                            <td width="14%"><b>Inv #</b></td>
                            <td width="24%" class= "line_under" id="Hat Number">{{isset($signle_vehicle)? $signle_vehicle->htnumber : ''}}</td>
                        </tr>
                    </table>
                    </div>


                <div class="part2">
                    <table width="100%">
                        <tr>
                            <td width="18%"><b>Year</b></td>
                            <td width="38%" class= "line_under" id="Year">{{isset($signle_vehicle)? $signle_vehicle->year : ''}}</td>
                            <td width="11%"><b>Color</b></td>
                            <td width="33%" class= "line_under" id="Color">{{isset($signle_vehicle)? $signle_vehicle->color : ''}}</td>
                        </tr>
                    </table>

                    <table width="100%">
                        <tr>
                            <td width="18%"><b>Model</b></td>
                            <td width="38%" class= "line_under" id="Model">{{isset($signle_vehicle)? $signle_vehicle->model : ''}}</td>
                            <td width="11%"><b>Make</b></td>
                            <td width="33%" class= "line_under" id="Make">{{isset($signle_vehicle)? $signle_vehicle->make : ''}}</td>
                        </tr>
                    </table>

                    <table width="100%">
                        <tr>
                            <td width="18%"><b>VIN</b></td>
                            <td width="82%" class= "line_under" id="VIN">{{isset($signle_vehicle)? $signle_vehicle->vin : ''}}</td>
                        </tr>
                    </table>

                    <table width="100%">
                        <tr>
                            <td width="18%"><b>License#</b></td>
                            <td width="82%" class= "line_under" id="License Number">{{isset($signle_vehicle)? $signle_vehicle->licence_number : ''}}</td>
                        </tr>
                    </table>

                </div>
                <div class="checklist">
                    <table width="100%">

                        <tr>
                            <th class="biga">CHECK OPTIONS INCLUDED IN VEHICLE</th>
                        </tr>
                    </table>

                    <table width="100%">

                        <tr>
                            <td><input disabled="true" {{$signle_vehicle->car_keys =='Yes' ? 'checked' :''}}  name="Keys"  type="checkbox"/>Keys</td>
                            <td><input disabled="true" name="Casette" {{$signle_vehicle->casette =='Yes' ? 'checked' :''}}  type="checkbox"/>Casette</td>
                            <td><input disabled="true" name="CD Changer" {{$signle_vehicle->cd_charger =='Yes' ? 'checked' :''}}  type="checkbox"/>CD Changer</td>
                            <td><input disabled="true" name="GPS Navigation System" {{$signle_vehicle->gps =='Yes' ? 'checked' :''}}  type="checkbox"/>GPS Navigation System</td>
                            <td><input disabled="true" name="Spare Tire/Jack"  {{$signle_vehicle->spare_tire =='Yes' ? 'checked' :''}} type="checkbox"/>Spare Tire/Jack</td>
                            <td><input disabled="true" name="Wheel Covers" {{$signle_vehicle->wheel_covers =='Yes' ? 'checked' :''}}  type="checkbox"/>Wheel Covers</td>
                        </tr>

                        <tr>
                            <td><input disabled="true" {{$signle_vehicle->radio =='Yes' ? 'checked' :''}}  name="Radio" type="checkbox"/>Radio</td>
                            <td><input disabled="true" {{$signle_vehicle->cd_player =='Yes' ? 'checked' :''}}  name="CD CPlayer" type="checkbox"/>CD CPlayer</td>
                            <td><input disabled="true" {{$signle_vehicle->floor_mat =='Yes' ? 'checked' :''}}  name="Floow Mat" type="checkbox"/>Floow Mat</td>
                            <td><input disabled="true" {{$signle_vehicle->mirror =='Yes' ? 'checked' :''}}  name="Mirror" type="checkbox"/>Mirror</td>
                            <td><input disabled="true" {{$signle_vehicle->speaker =='Yes' ? 'checked' :''}}  name="Speakers" type="checkbox"/>Speakers</td>
                            <td><input disabled="true" {{$signle_vehicle->other =='Yes' ? 'checked' :''}}  name="Other..." type="checkbox"/>Other..</td>
                        </tr>

                    </table>

                </div>
                <div class="condition">
                    <table width="100%">

                        <tr>
                            <th class="biga">CONDITION OF VEHICLE</th>
                        </tr>
                        <tr>
                            <th class="biga1">Indicate any damage to the vehicle in the space provided using your own words or the following legend. If None write None</th>
                        </tr>
                    </table>

                    <table id="Sik" width="100%">

                        <tr>
                            <td>H - Hairline Scratch</td>
                            <td>PT - Pitted</td>
                            <td>B - Bent</td>
                            <td>GC - Glass Cracked</td>
                            <td>SM - Smashed</td>
                            <td>R - Rusty</td>
                        </tr>
                        <tr>
                            <td>S - Scratched</td>
                            <td>ST - Stained</td>
                            <td>M - Missing</td>
                            <td>D - Dented</td>
                            <td>BR - Broken</td>
                            <td>DM - Damaged</td>
                            <td>T -Torm</td>
                        </tr>

                    </table>


                </div>
                <div class="picas1">
                    <span class="lefti"><img src="{{asset('img/carinfophoto/front.jpg')}}" height="120"/></span>
                    <span  id="piss2">
      <div class="line_under"><table><tr>
        <td>1</td><td align='center' id="1">&nbsp;&nbsp;{{isset($signle_vehicle)?$signle_vehicle->txt1 :''}}</td></tr></table></div>
      <div class="line_under"> <table><tr>
        <td>2</td><td  align='center' id="2">&nbsp;&nbsp;{{isset($signle_vehicle)?$signle_vehicle->txt2 :''}}</td></tr></table></div>
      <div class="line_under"> <table><tr>
        <td>3</td><td  align='center' id="3">&nbsp;&nbsp;{{isset($signle_vehicle)?$signle_vehicle->txt3 :''}}</td></tr></table></div>
      <div class="line_under"> <table><tr>
        <td>4</td><td  align='center' id="4">&nbsp;&nbsp;{{isset($signle_vehicle)?$signle_vehicle->txt4 :''}}</td></tr></table></div>

      <div class="line_under"> <table><tr><td>5</td><td  align='center' id="5">&nbsp;&nbsp;{{isset($signle_vehicle)?$signle_vehicle->txt5 :''}}</td></tr></table></div>


      </span>
                </div>

                <div class="picas2">
                    <span class="lefti"><img src="{{asset('img/carinfophoto/back.jpg')}}" height="120"/></span>
                    <span class="lefti" id="piss2">
      <div class="line_under"><table><tr>
        <td>6</td><td  align='center' id="6">&nbsp;&nbsp;{{isset($signle_vehicle)?$signle_vehicle->txt6:''}}</td></tr></table></div>
      <div class="line_under"> <table><tr>
        <td>7</td><td  align='center' id="7">&nbsp;&nbsp;{{isset($signle_vehicle)?$signle_vehicle->txt7 :''}}</td></tr></table></div>
      <div class="line_under"> <table><tr>
        <td>8</td><td  align='center' id="8">&nbsp;&nbsp;{{isset($signle_vehicle)?$signle_vehicle->txt8 :''}}</td></tr></table></div>
      <div class="line_under"> <table><tr>
        <td>9</td><td  align='center' id="9">&nbsp;&nbsp;{{isset($signle_vehicle)?$signle_vehicle->txt9 :''}}</td></tr></table></div>
      <div class="line_under"> <table><tr><td>10</td><td  align='center' id="10">&nbsp;&nbsp;{{isset($signle_vehicle)?$signle_vehicle->txt10 :''}}</td></tr></table></div>

      </span>
                </div>

                <div class="picas3">
                    <div class="lefti">
                        <img src="{{asset('img/carinfophoto/dside.jpg')}}" width="384" height="141"/></div>
                    <div id="yoba">
                        <table width="100%">
                            <tr>
                                <td width="6%">11</td><td class="line_right"  align='center' width="28%">&nbsp;&nbsp;{{isset($signle_vehicle)?$signle_vehicle->txt11 :''}}</td>
                                <td width="6%">12</td><td class="line_right"  align='center' width="27%">&nbsp;&nbsp;{{isset($signle_vehicle)?$signle_vehicle->txt12 :''}}</td>
                                <td width="6%">13</td><td  align='center' width="27%">&nbsp;&nbsp;{{isset($signle_vehicle)?$signle_vehicle->txt13 :''}}</td>
                            </tr>
                        </table>
                    </div>

                    <div id="yoba">
                        <table width="100%">
                            <tr>
                                <td width="6%">14</td><td  align='center' class="line_right" width="28%">&nbsp;&nbsp;{{isset($signle_vehicle)?$signle_vehicle->txt14 :''}}</td>
                                <td width="6%">15</td><td  align='center' class="line_right" width="27%">&nbsp;&nbsp;{{isset($signle_vehicle)?$signle_vehicle->txt15 :''}}</td>
                                <td width="6%">16</td><td   align='center' width="27%">&nbsp;&nbsp;{{isset($signle_vehicle)?$signle_vehicle->txt16 :''}}</td>
                            </tr>
                        </table>
                    </div>

                </div>

                <div class="picas4">
                    <div class="lefti"><img src="{{asset('img/carinfophoto/pside.jpg')}}" width="372" height="141"
                        /></div>
                    <div id="yoba">
                        <table width="100%">
                            <tr>
                                <td width="6%">17</td><td  align='center' class="line_right" width="28%">&nbsp;&nbsp;{{isset($signle_vehicle)?$signle_vehicle->txt17 :''}}</td>
                                <td width="6%">18</td><td  align='center' class="line_right" width="27%">&nbsp;&nbsp;{{isset($signle_vehicle)?$signle_vehicle->txt18 :''}}</td>
                                <td width="6%">19</td><td  align='center' width="27%">&nbsp;&nbsp;{{isset($signle_vehicle)?$signle_vehicle->txt19 :''}}</td>
                            </tr>
                        </table>
                    </div>

                    <div id="yoba">
                        <table width="100%">
                            <tr>
                                <td width="6%">20</td><td  align='center' class="line_right" width="28%">&nbsp;&nbsp;{{isset($signle_vehicle)?$signle_vehicle->txt20 :''}}</td>
                                <td width="6%">21</td><td  align='center' class="line_right" width="27%">&nbsp;&nbsp;{{isset($signle_vehicle)?$signle_vehicle->txt21 :''}}</td>
                                <td width="6%">&nbsp;</td><td  width="27%"></td>
                            </tr>
                        </table>
                    </div>

                </div>
                <div class="papugay">
                    <table width="100%">
                        <tr><td><b>1.</b> Liability-Shipper (customer) must have door-to-door insurance while goods are in warehouse and during transit. Peace Global Logistic will not
                                assume any responsibility for uninsured or underinsured shipment(s).</td></tr>

                        <tr><td><b>2.</b> Rates for individual cars are based on consolidation; company is not responsible for exact shipping dates. Company is not responsible for delays
                                in shipping schedules and/or transit time or custom charges and delays..</td></tr>
                    </table>

                </div>

                <div class="dimen"><table width="100%">
                        <tr>
                            <td>
                                <b>DIMENSIONS: </b>
                                The above is an accurate representation of the condition of the vehicle at the time of loading. NOTICE: The OWNER'S or AUTHORIZED AGENT'S
                                Signature of the origin is also to the following RELEASE: this will authorize CARRIER to drive my vehicle either at origin destination between point
                                (s) of loading/unloading and the point(s) of pick-up/delivery.
                            </td>
                        </tr>
                    </table>

                </div>

                <div class="sign"><table width="100%">
                        <tr>
                            <td>
                                This above Vehicle has been delivered in the condition described.
                            </td>
                        </tr>
                    </table></div>

                <div class="sign"><table>
                        <tr>
                            <td class="leni line_under">

                                <?php $row=DB::table('users')->where('id',isset($signle_vehicle)?$signle_vehicle->user_id :'')->get(); ?>
                                @foreach($row as $value)

                                {{$value->username}}

                                @endforeach

                            </td>
                            <td class="leni1 line_under">
                                {{isset($signle_vehicle)?$signle_vehicle->created_at :'' }}      </td>
                        </tr>
                        <td align="center" class="leni ">
                            <b>Completed By</b>
                        </td>
                        <td align= "center" class="leni1 ">
                            <b>Date</b>
                        </td>
                        </tr>


                    </table></div>
            </div>

        </div>

        <br style="page-break-before:always;" />

        <div class="customer_part">

            <div class="part2">
                <table width="100%">
                    <tr>
                        <td width="18%"><b>Date</b></td>
                        <td width="82%" class= "line_under" id="Year">{{isset($signle_vehicle)?$signle_vehicle->created_at :''}}</td>

                    </tr>
                </table>
                <table width="100%">
                    <tr>
                        <td width="18%"><b>Year</b></td>
                        <td width="38%" class= "line_under" id="Year">{{isset($signle_vehicle)?$signle_vehicle->year :''}}</td>
                        <td width="11%"><b>Color</b></td>
                        <td width="33%" class= "line_under" id="Color">{{isset($signle_vehicle)?$signle_vehicle->color :''}}</td>
                    </tr>
                </table>

                <table width="100%">
                    <tr>
                        <td width="18%"><b>Model</b></td>
                        <td width="38%" class= "line_under" id="Model">{{isset($signle_vehicle)?$signle_vehicle->model :''}}</td>
                        <td width="11%"><b>Make</b></td>
                        <td width="33%" class= "line_under" id="Make">{{isset($signle_vehicle)?$signle_vehicle->make :''}}</td>
                    </tr>
                </table>

                <table width="100%">
                    <tr>
                        <td width="18%"><b>VIN</b></td>
                        <td width="82%" class= "line_under" id="VIN">{{isset($signle_vehicle)?$signle_vehicle->vin :''}}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
</div>
</div>
@endsection