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
                    {{--        <td style="font-size:12px; font-weight:600"><span>TRN No 345345</span></td>--}}
                </tr>
            </table>
        </div>
    </div>

    <table style="width:100%; text-align:center">
        <tr>
            <td>
                <table style="width:50%; text-align:center" border="1px">
                    <tr>
                        <td>Job Number</td>
                        <td>SC-22-0155</td>
                    </tr>

                </table>
            </td>
            <td>
                <table style="width:50%; text-align:center;float: right;" border="1px">
                    <tr>
                    <?php $mytime = Carbon\Carbon::now();
                        // $last = 1; // This is fetched from database
                        $invoice_number = $createInvoices['clearLog']['getContainer']->id;
                       // dd($invoice_number);
                        // $invoice_number = sprintf('%07d', $last++);
                        // dd($invoice_number);
                        ?> -->
                            <td>Invoice No:</td>

                        <td> PGL{{ str_pad($createInvoices->id,4,"0",STR_PAD_LEFT) }}</td>
                    </tr>
                    <tr>
                        <td>Invoice Date:</td>
                        <td><?php echo $mytime->toDateString(); ?></td>
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
                <table style="width:100%; text-align:left;">
                    <td><b>{{ $createInvoices['clearLog']['getCustomer']->consignee }}</b>
                        <br>
                        {{ $createInvoices['clearLog']['getCustomer']->cons_city }},</td>
                    <td><b>Shipper </b>: {{ $createInvoices['clearLog']['getContainer']->shipper_exporter  }}<br><br>
                        <b>Consignee </b>: {{ $createInvoices['clearLog']['getCustomer']->consignee }}
                        <br><br>
                        <b>Notify </b>: SAME AS CONSIGNEE
                        <br><br>
                    </td>
                </table>
            </td>
        </tr>
    </table>
    <br>
    <br>
    <br>
    <br> <br> <br> <br>

    <table style="width:100%; text-align:center;float: right;" border="1px">
        <tr>
            <td>
                <table style="width:100%; text-align:left;" >
                    <tr>
                        <td><b>Origin</b>:</td>
                        <td>{{ $createInvoices['clearLog']['getContainer']->place_receipt  }}</td>
                    </tr>
                    <tr>
                        <td><b>No(Pcs) : </b>:</td>
                        <td>4</td>
                    </tr>
                    <tr>
                        <td><b>HBL NO</b>:</td>
                        <td>AE10371MK7376</td>
                    </tr>
                </table>
            </td>
            <td>
                <table style="width:100%; text-align:left;" border="1px">
                    <tr>
                        <td><b>ETA/ETS </b>:</td>
                        <td> {{ $createInvoices['clearLog']['getContainer']->eta_port_discharge  }}</td>
                    </tr>
                    <tr>
                        <td><b>Wt(Kgs)</b>:</td>
                        <td>7006</td>
                    </tr>
                    <tr>
                        <td><b>B.E. No</b>:</td>
                        <td>1050207482722</td>
                    </tr>
                </table>
            </td>
            <td>
                <table style="width:100%; text-align:left;" border="1px">
                    <tr>
                        <td><b>Destination</b>:</td>
                        <td>{{$createInvoices['clearLog']['getContainer']->port_discharge}}</td>
                    </tr>
                    <tr>
                        <td><b>VESSEL</b>:</td>
                        <td>{{ $createInvoices['clearLog']['getContainer']->vessel_name  }}</td>
                    </tr>
                    <tr>
                        <td><b>Voy. No</b>:</td>
                        <td> {{ $createInvoices['clearLog']['getContainer']->voyage_number  }} </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <br>
    <br> <br> <br>
    <table style="width:100%; text-align:center;float: right;" border="1px">
        <tr>
            <td>
                <table style="width:100%; text-align:left;">
                    <tr>
                        <?php if(isset($createInvoices->clearLog->getContainer->container_number)){ ?>
                        <td><b>Containers</b>:
                            {{ $createInvoices['clearLog']['getContainer']->container_number  }}
                            <?php } ?>
                            &nbsp;&nbsp;&nbsp;
                            <b>CBM</b>:</td><br><br>
                        <td><b>Cargo Desc</b>:{{ $createInvoices['clearLog']['getContainer']->poc_cargo_release  }}</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <br><br>
    <br>
    <div id="yoba">
        <div class="row">
            <div class="col-md-12">
                <table width="100%">
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
                    <tbody >
                    <?php $id = 1; ?>
                    <?php
                    if($createInvoices->custom_duty > 0){ ?>
                        $total = 12345.6789;
                        echo "Total charge is \$", number_format($total), "\n";
                        number_format(
                            float $num,
                            int $decimals = 0,
                            ?string $decimal_separator = ".",
                            ?string $thousands_separator = ","
                        ): string
                    <tr>
                        <td>{{ $id++ }}</td>
                        <td>Custom Duty</td>
                        <td>1.00</td>
                        <td>{{  number_format((float)$createInvoices->custom_duty, 2, '.', '')   }}</td>
                        <td>{{  number_format((float)$createInvoices->custom_duty, 2, '.', '')   }}</td>
                        <td>0.00</td>
                        <td>0.00</td>

                    </tr>
                    <?php  } ?>
                    <?php
                    if($createInvoices->port_handling > 0){ ?>
                    <tr>
                        <td>{{ $id++ }}</td>
                        <td>Port Handling</td>
                        <td>1.00</td>
                        <td>{{ number_format((float) $createInvoices->port_handling, 2, '.', '') }}</td>
                        <td>{{ number_format((float) $createInvoices->port_handling, 2, '.', '') }}</td>
                        <td>0.00</td>
                        <td>0.00</td>

                    </tr>
                    <?php  } ?>
                    <?php
                    if($createInvoices->vcc > 0){ ?>
                    <tr>
                        <td>{{ $id++ }}</td>
                        <td>VCC</td>
                        <td>1.00</td>
                        <td>{{  number_format((float) $createInvoices->vcc, 2, '.', '') }}</td>
                        <td>{{ number_format((float) $createInvoices->vcc, 2, '.', '') }}</td>
                        <td>0.00</td>
                        <td>0.00</td>

                    </tr>
                    <?php  } ?>
                    <?php
                    if($createInvoices->transporter_charges > 0){ ?>
                    <tr>
                        <td>{{ $id++ }}</td>
                        <td>Transporter Charges</td>
                        <td>1.00</td>
                        <td>{{  number_format((float) $createInvoices->transporter_charges, 2, '.', '')  }}</td>
                        <td>{{  number_format((float) $createInvoices->transporter_charges, 2, '.', '') }}</td>
                        <td>0.00</td>
                        <td>0.00</td>

                    </tr>
                    <?php  } ?>
                    <?php
                    if($createInvoices->e_token > 0){ ?>
                    <tr>
                        <td>{{ $id++ }}</td>
                        <td>E Token</td>
                        <td>1.00</td>
                        <td>{{  number_format((float) $createInvoices->e_token, 2, '.', '')  }}</td>
                        <td>{{ number_format((float) $createInvoices->e_token, 2, '.', '') }}</td>
                        <td>0.00</td>
                        <td>0.00</td>

                    </tr>
                    <?php  } ?>
                    <?php
                    if($createInvoices->local_service_charges > 0){ ?>
                    <tr>
                        <td>{{ $id++ }}</td>
                        <td>Local Service Charges</td>
                        <td>1.00</td>
                        <td>{{ number_format((float) $createInvoices->local_service_charges, 2, '.', '')  }}</td>
                        <td>{{ number_format((float) $createInvoices->local_service_charges, 2, '.', '')  }}</td>
                        <td>5.00</td>
                        <td><?php  echo number_format((float) (5 / 100) * $createInvoices->local_service_charges, 2, '.', '');  ?></td>

                    </tr>
                    <?php  } ?>
                    <?php
                    if($createInvoices->bill_of_entry > 0){ ?>
                    <tr>
                        <td>{{ $id++ }}</td>
                        <td>Bill Of Entry</td>
                        <td>1.00</td>
                        <td>{{ number_format((float) $createInvoices->bill_of_entry, 2, '.', '')   }}</td>
                        <td>{{  number_format((float) $createInvoices->bill_of_entry, 2, '.', '')  }}</td>
                        <td>0.00</td>
                        <td>0.00</td>

                    </tr>
                    <?php  } ?>
                    <?php
                    if($createInvoices->other_charges > 0){ ?>
                    <tr>
                        <td>{{ $id++ }}</td>
                        <td>Other Charges</td>
                        <td>1.00</td>
                        <td>{{  number_format((float) $createInvoices->other_charges, 2, '.', '')  }}</td>
                        <td>{{  number_format((float) $createInvoices->other_charges, 2, '.', '')  }}</td>
                        <td>0.00</td>
                        <td>0.00</td>

                    </tr>
                    <?php  } ?>
                    <?php
                    if($createInvoices->vcc_charges > 0){ ?>
                    <tr>
                        <td>{{ $id++ }}</td>
                        <td>VCC Charges</td>
                        <td>1.00</td>
                        <td>{{  number_format((float) $createInvoices->vcc_charges, 2, '.', '')   }}</td>
                        <td>{{ number_format((float) $createInvoices->vcc_charges, 2, '.', '')  }}</td>
                        <td>0.00</td>
                        <td>0.00</td>

                    </tr>
                    <?php  } ?>
                    <?php
                    if($createInvoices->single_vcc_charges > 0){ ?>
                    <tr>
                        <td>{{ $id++ }}</td>
                        <td>Single VCC Charges</td>
                        <td>1.00</td>
                        <td>{{ number_format((float) $createInvoices->single_vcc_charges, 2, '.', '')   }}</td>
                        <td>{{  number_format((float) $createInvoices->single_vcc_charges, 2, '.', '') }}</td>
                        <td>0.00</td>
                        <td>0.00</td>

                    </tr>
                    <?php  } ?>
                    <?php
                    if($createInvoices->wash_fine_charges > 0){ ?>
                    <tr>
                        <td>{{ $id++ }}</td>
                        <td>Wash Fine Charges</td>
                        <td>1.00</td>
                        <td>{{  number_format((float) $createInvoices->wash_fine_charges, 2, '.', '') }}</td>
                        <td>{{ number_format((float) $createInvoices->wash_fine_charges, 2, '.', '')  }}</td>
                        <td>0.00</td>
                        <td>0.00</td>

                    </tr>
                    <?php  } ?>
                    <?php
                    if($createInvoices->repairing_cost_charges > 0){ ?>
                    <tr>
                        <td>{{ $id++ }}</td>
                        <td>Repairing Cost Charges</td>
                        <td>1.00</td>
                        <td>{{ number_format((float) $createInvoices->repairing_cost_charges, 2, '.', '')  }}</td>
                        <td>{{ number_format((float) $createInvoices->repairing_cost_charges, 2, '.', '') }}</td>
                        <td>0.00</td>
                        <td>0.00</td>

                    </tr>
                    <?php  } ?>
                    <?php
                    if($createInvoices->export_services_fees > 0){ ?>
                    <tr>
                        <td>{{ $id++ }}</td>
                        <td>Export Services Fees</td>
                        <td>1.00</td>
                        <td>{{ number_format((float) $createInvoices->export_services_fees, 2, '.', '')  }}</td>
                        <td>{{  number_format((float) $createInvoices->export_services_fees, 2, '.', '') }}</td>
                        <td>0.00</td>
                        <td>0.00</td>

                    </tr>
                    <?php  } ?>
                    <?php
                    if($createInvoices->detention_charges > 0){ ?>
                    <tr>
                        <td>{{ $id++ }}</td>
                        <td>Detention Charges</td>
                        <td>1.00</td>
                        <td>{{  number_format((float) $createInvoices->detention_charges, 2, '.', '') }}</td>
                        <td>{{  number_format((float) $createInvoices->detention_charges, 2, '.', '') }}</td>
                        <td>0.00</td>
                        <td>0.00</td>

                    </tr>
                    <?php  } ?>
                    <?php
                    if($createInvoices->demurrage_charges > 0){ ?>
                    <tr>
                        <td>{{ $id++ }}</td>
                        <td>Demurrage Charges</td>
                        <td>1.00</td>
                        <td>{{  number_format((float) $createInvoices->demurrage_charges, 2, '.', '') }}</td>
                        <td>{{  number_format((float) $createInvoices->demurrage_charges, 2, '.', '') }}</td>
                        <td>0.00</td>
                        <td>0.00</td>

                    </tr>
                    <?php  } ?>
                    <?php
                    if($createInvoices->inspection_charges > 0){ ?>
                    <tr>
                        <td>{{ $id++ }}</td>
                        <td>Inspection Charges</td>
                        <td>1.00</td>
                        <td>{{ number_format((float) $createInvoices->inspection_charges, 2, '.', '') }}</td>
                        <td>{{ number_format((float) $createInvoices->inspection_charges, 2, '.', '') }}</td>
                        <td>0.00</td>
                        <td>0.00</td>

                    </tr>
                    <?php  } ?>
                    <?php
                    if($createInvoices->deliver_order_charges > 0){ ?>
                    <tr>
                        <td>{{ $id++ }}</td>
                        <td>Deliver Order Charges</td>
                        <td>1.00</td>
                        <td>{{  number_format((float) $createInvoices->deliver_order_charges, 2, '.', '') }}</td>
                        <td>{{  number_format((float) $createInvoices->deliver_order_charges, 2, '.', '') }}</td>
                        <td>0.00</td>
                        <td>0.00</td>

                    </tr>
                    <?php  } ?>
                    <?php
                    if($createInvoices->delivery_order_fee > 0){ ?>
                    <tr>
                        <td>{{ $id++ }}</td>
                        <td>Delivery Order Fee</td>
                        <td>1.00</td>
                        <td>{{ number_format((float) $createInvoices->delivery_order_fee, 2, '.', '') }}</td>
                        <td>{{ number_format((float) $createInvoices->delivery_order_fee, 2, '.', '') }}</td>
                        <td>0.00</td>
                        <td>0.00</td>

                    </tr>
                    <?php  } ?>
                    <?php
                    if($createInvoices->terminal_handling_charges > 0){ ?>
                    <tr>
                        <td>{{ $id++ }}</td>
                        <td>Terminal Handling Charges</td>
                        <td>1.00</td>
                        <td>{{ number_format((float) $createInvoices->terminal_handling_charges, 2, '.', '') }}</td>
                        <td>{{ number_format((float) $createInvoices->terminal_handling_charges, 2, '.', '') }}</td>
                        <td>0.00</td>
                        <td>0.00</td>

                    </tr>
                    <?php  } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <br>
    <br>

    <?php
    $sum = $createInvoices->terminal_handling_charges+$createInvoices->delivery_order_fee + $createInvoices->deliver_order_charges + $createInvoices->inspection_charges +$createInvoices->demurrage_charges + $createInvoices->export_services_fees + $createInvoices->repairing_cost_charges + $createInvoices->wash_fine_charges + $createInvoices->single_vcc_charges +  $createInvoices->vcc_charges +
        +$createInvoices->bill_of_entry + $createInvoices->other_charges + $createInvoices->custom_duty + $createInvoices->port_handling + $createInvoices->vcc + $createInvoices->transporter_charges + $createInvoices->e_token;
    $sum = number_format((float) $sum, 2, '.', '')+$createInvoices->local_service_charges;
    ?>

    <div id="yoba">
        <div class="row">
            <div class="col-md-12">
                <table width="100%" border="1">
                    <thead>
                    <th colspan="2" style="background: rgb(216, 216, 216); color: black;" id="td1">VAT-Type</th>
                    <th colspan="2" style="background: rgb(216, 216, 216); color: black;" id="td1">VAT-Type</th>
                    <th colspan="2" style="background: rgb(216, 216, 216); color: black;" id="td1">Base Amount</th>
                    <th colspan="2" style="background: rgb(216, 216, 216); color: black;" id="td1">VAT Amount</th>
                    <!--          <th colspan="2" id="td1" > </th>-->
                    <th colspan="2" id="td1" >Amount Excl. VAT :</th>
                    <th colspan="2" id="td1" ><?php echo number_format((float)$sum, 2, '.', ''); ?></th>
                    </thead>
                    <tbody>
                    <tr>
                        <td colspan="2">VAT-SR Standard Rate</td>
                        <td colspan="2">5</td>
                        <td colspan="2">{{number_format((float) $createInvoices->local_service_charges, 2, '.', '')}} </td>
                        <td colspan="2"><?php  echo number_format((float) (5 / 100) * $createInvoices->local_service_charges, 2, '.', '');  ?></td>
                        <td colspan="2">VAT @ 0 % :</td>
                        <td colspan="2"><?php  echo number_format((float) (5 / 100) * $createInvoices->local_service_charges, 2, '.', '');  ?></td>
                    </tr>
                    <tr>
                        <td colspan="2">VAT-ZR Zero Rate</td>
                        <td colspan="2">0</td>
                        <td colspan="2">{{ number_format((float) $sum - $createInvoices->local_service_charges, 2, '.', '')}}</td>
                        <td colspan="2">0.00</td>
                        <td colspan="2">Net Total :</td>
                        <td colspan="2">{{$sum + number_format((float) (5 / 100) * $createInvoices->local_service_charges, 2, '.', '') }}</td>
                    </tr>
                    <tr >
                        <td colspan="12">
                        <?php
                            $number = $sum + number_format((float) (5 / 100) * $createInvoices->local_service_charges, 2, '.', '');
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
                <table width="100%"  border="1px">
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

    <br>
    <br>
</div>

