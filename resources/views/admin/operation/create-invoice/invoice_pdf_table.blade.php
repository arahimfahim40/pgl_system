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

    td, th {
        font-size: 14px;
    }
</style>

<div class="container">
    <div class="row">
        <div class="col-md-12">

            <table style="width:100%; text-align:right; font-weight: bold;">
                <tr>
                    <td>
                        <span>P G L C SHIPPING LLC.</span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <span>OFFICE 804, AL SOUAD BLDG. INDUSTRIAL AREA 4, AL QUSAIS</span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <span style=""> P.O.BOX:,DUBAI-U.A.E </span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <span> Tel: +971 4 5488069, Fax: </span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <span>email : pglcshipping@peacegl.com </span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <span> Website: www.peacegl.com </span>
                    </td>
                </tr>

            </table>
            <table style="width:100%; text-align:center">
                <tr>
                    <td style="text-decoration: underline;font-size:20px;font-weight: bold;">TAX INVOICE</td>
                </tr>
                <tr>
                    {{--                    <td style="font-size:12px; font-weight:600"><span>TRN No 345345</span></td>--}}
                </tr>
            </table>
        </div>
    </div>

    <table style="width:100%; text-align:center">
        <tr>
            <td>
                <table style="width:50%; text-align:center;" border="1px">
                    <tr>
                        <?php $mytime = Carbon\Carbon::now();
                        $last = 0; // This is fetched from database
                        $last++;
                        $invoice_number = sprintf('%07d', $last);
                        ?>
                        <td>Invoice No:</td>
                        <td> PGL{{ str_pad($delivery->id,4,"0",STR_PAD_LEFT) }}</td>
                    </tr>
                    <tr>
                        <td>Invoice Date:</td>
                        <td><?php echo $mytime->toDateString(); ?></td>
                    </tr>
                </table>
            </td>
            <td>
                <table style="width:50%; text-align:center;float: right;" border="1px">
                    <tr>
                        <td>Job Number</td>
                        <td>SC-22-0155</td>
                    </tr>
                </table>
            </td>
        </tr>
        <br>
        <br>
    </table>

    <table style="width:100%; text-align:center;float: right;" border="1px">
        <tr>
            <td>
                <table style="width:100%; text-align:left;" border="none">
                    <td><b>{{ $delivery['getCustomer']->consignee  }} </b>
                        <br>
                        {{ $delivery['getCustomer']->cons_city }},
                    </td>
                    <td><b>Origin</b>: <span>{{ $delivery['container']->place_receipt  }}</span> <br>
                        <b>Destination</b>:<span>{{ $delivery['container']->port_discharge  }}</span> <br>
                        <b>ETA/ETS </b>:<span> {{ $delivery['container']->eta_port_discharge  }} <br>
                        <b>VESSEL </b>:<span> {{ $delivery['container']->vessel_name  }}</span>
                        <br>
                        <b>Voy. No </b>:<span>{{ $delivery['container']->voyage_number  }}
                    <td>
                </table>
            </td>
        </tr>
    </table>
    <br><br><br><br><br><br><br>

    <table style="width:100%; text-align:center;float: right;" border="1px">
        <tr>
            <td>
                <table style="width:100%; text-align:left;">
                    <tr>
                        <td><b>Shipper </b>: {{ $delivery['container']->shipper_exporter  }}<br><br>
                            <b>Notify </b>: SAME AS CONSIGNEE
                        </td>
                        <td><b>Consignee </b>: {{ $delivery['getCustomer']->consignee  }}
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    {{--                        <tr>--}}
    {{--                            <td id="td1"><b>No(Pcs)</b> <span></span><span></span><span>4</span></td>--}}
    {{--                            <td id="td1">--}}
    {{--                                <b>Wt(Kgs) </b> <span> 7006<br></span>--}}
    {{--                            </td>--}}

    {{--                        </tr>--}}
    {{--                        <tr>--}}
    {{--                            <td id="td1"><b>HBL NO</b> <span>AE10371MK7376</span></td>--}}
    {{--                            <td id="td1">--}}
    {{--                                <b>B.E. No </b> <span>  1050207482722<br></span>--}}
    {{--                            </td>--}}

    {{--                        </tr>--}}
    <br>
    <br> <br> <br>
    <table style="width:100%; text-align:center;float: right;" border="1px">
        <tr>
            <td>
                <table style="width:100%; text-align:left;">
                    <tr>
                        <td><b>Containers</b>:<br>
                            {{ $delivery['container']->container_number}},
                        </td>
                        <td><b>Cargo Desc</b>:<br> {{ $delivery['container']->poc_cargo_release  }}</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <br> <br><br>
    {{--                    <td style=" color: black;" id="td1">--}}
    {{--                        <b> CBM : </b>--}}
    {{--                        <br>--}}
    {{--                        <br>--}}
    {{--                    </td>--}}
    <div id="yoba">
        <div class="row">
            <div class="col-md-12">
                <table width="100%" border="1px">
                    <thead>
                    <tr>
                        <th id="td1">SNO.</th>
                        <th id="td1">DESCRIPTION OF SERVICE</th>
                        <th id="td1">Qty</th>
                        <th id="td1">Rate</th>
                        <th id="td1">Amount(AED)</th>
                        <th id="td1">VAT%</th>
                        <th id="td1">TAX Amount</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>1</td>
                        <td>Delivery Order Fee</td>
                        <td>1.00</td>
                        <td>{{  number_format((float)$delivery->delivery_charges, 2, '.', '')  }}</td>
                        <td>{{  number_format((float)$delivery->delivery_charges, 2, '.', '') }}</td>
                        <td>0</td>
                        <td>0</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <br><br>
    <br>
    <hr>
    <div id="yoba">
        <div class="row">
            <div class="col-md-12">
                <table width="100%" border="1">
                    <thead>
                    <th colspan="2" style="background: rgb(216, 216, 216); color: black;" id="td1">VAT-Type</th>
                    <th colspan="2" style="background: rgb(216, 216, 216); color: black;" id="td1">VAT-Type</th>
                    <th colspan="2" style="background: rgb(216, 216, 216); color: black;" id="td1">Base Amount</th>
                    <th colspan="2" style="background: rgb(216, 216, 216); color: black;" id="td1">VAT Amount</th>
                    <th colspan="2" id="td1">Amount Excl. VAT :</th>
                    <th colspan="2" id="td1">{{  number_format((float)$delivery->delivery_charges, 2, '.', '') }}.00</th>
                    </thead>
                    <tbody>
                    <tr>
                        <td colspan="2">VAT-SR Standard Rate</td>
                        <td colspan="2">5</td>
                        <td colspan="2">0.00</td>
                        <td colspan="2">0.00</td>
                        <td colspan="2">VAT @ 0 % :</td>
                        <td colspan="2">{{number_format((float)$delivery->delivery_charges, 2, '.', '')}} </td>
                    </tr>
                    <tr>
                        <td colspan="2">VAT-ZR Zero Rate</td>
                        <td colspan="2">0</td>
                        <td colspan="2">{{number_format((float)$delivery->delivery_charges, 2, '.', '')}} </td>
                        <td colspan="2">0.00</td>
                        <td colspan="2">Net Total :</td>
                        <td colspan="2">{{number_format((float)$delivery->delivery_charges, 2, '.', '')}} </td>
                    </tr>
                    <tr >
                        <td colspan="12">
                            <?php
                            $number = number_format((float)$delivery->delivery_charges, 2, '.', '');
                            $no = floor($number);
                            $point = round($number - $no, 2) * 100;
                            $hundred = null;
                            $digits_1 = strlen($no);
                            $i = 0;
                            $str = array();
                            $words = array('0' => '', '1' => 'one', '2' => 'two',
                                '3' => 'three', '4' => 'four', '5' => 'five', '6' => 'six',
                                '7' => 'seven', '8' => 'eight', '9' => 'nine',
                                '10' => 'ten', '11' => 'eleven', '12' => 'twelve',
                                '13' => 'thirteen', '14' => 'fourteen',
                                '15' => 'fifteen', '16' => 'sixteen', '17' => 'seventeen',
                                '18' => 'eighteen', '19' =>'nineteen', '20' => 'twenty',
                                '30' => 'thirty', '40' => 'forty', '50' => 'fifty',
                                '60' => 'sixty', '70' => 'seventy',
                                '80' => 'eighty', '90' => 'ninety');
                            $digits = array('', 'hundred', 'thousand', 'lakh', 'crore');
                            while ($i < $digits_1) {
                                $divider = ($i == 2) ? 10 : 100;
                                $number = floor($no % $divider);
                                $no = floor($no / $divider);
                                $i += ($divider == 10) ? 1 : 2;
                                if ($number) {
                                    $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
                                    $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
                                    $str [] = ($number < 21) ? $words[$number] .
                                        " " . $digits[$counter] . $plural . " " . $hundred
                                        :
                                        $words[floor($number / 10) * 10]
                                        . " " . $words[$number % 10] . " "
                                        . $digits[$counter] . $plural . " " . $hundred;
                                } else $str[] = null;
                            }
                            $str = array_reverse($str);
                            $result = implode('', $str);
                            $points = ($point) ?
                                " Fils " . $words[$point / 10] . " " .
                                $words[$point = $point % 10] : '';
                            echo "<span style='text-transform: capitalize'>".$result . "Rupees  " . $points . " Paise Only". "</span>";

                            ?>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <br>
    ** Thanking you for choosing P G L C SHIPPING LLC. as your logistics service provider.
    <br>
    ** Any discrepancy please notify within 7 days of date of Invoice, otherwise it will be considered as final.
    <br>
    <br>
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <table width="100%" border="1px">
                    <tr>
                        <th style="text-align: left;text-decoration: underline;">Bank Details :</th>
                    </tr>
                    <tr>
                        <th style="text-align: left;">BANK NAME: EMIRATES ISLAMIC BANK</th>
                    </tr>
                    <tr>
                        <th style="text-align: left;">AC NAME : P G L C SHIPPING LLC.</th>
                    </tr>
                    <tr>
                        <th style="text-align: left;">AED AC.NO : 3708433485501,</th>
                    </tr>
                    <tr>
                        <th style="text-align: left;"> IBAN: AE030340003708433485501 IBAN:
                            MEBLAED
                        </th>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <br>
    <br>

    <div class="row">
        <div class="col-md-12">
            <table width="100%">
                <tbody>
                <tr>
                    <th style="text-align: left; font-weight: lighter;">Prepared by : OPR</th>
                    <th style="text-align: right;">For P G L C SHIPPING LLC.</th>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
