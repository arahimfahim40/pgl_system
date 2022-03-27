<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>
<body>
<div class="center">
    <p>
        Dear  {{ $data2["poc"] }} and {{$data2["company"]}},<br>
        The below listed vehicle(s) have been processed and loaded into Booking Number   {{ $data2["booking_number"] }}&nbsp;-&nbsp; and Container Number  <?php $container=DB::table('containers')->where('id',$data2['cont_id'])->first(); echo $container->container_number;?>  at {{$data2["terminal"]}}<br>
        and will be shipped to <?php echo $container->port_discharge; ?> on <?php echo $container->etd_port_loading; ?>  and expected arrival date is <?php echo $container->eta_port_discharge; ?>.
        <br>
        List of the vehicles: <br>
        <?php $data=DB::table('tbl_bases')->join('vehicles','tbl_bases.vehicle_id','vehicles.id')->where('tbl_bases.container_id',$data2['cont_id'])->get();
        foreach ($data as $datumo)
        {
            ?>

        <?php echo $datumo->year; ?>&nbsp;<?php echo $datumo->make; ?>&nbsp;
        <?php echo $datumo->model; ?>&nbsp;VIN#&nbsp;<?php echo $datumo->vin; ?>&nbsp;Title#&nbsp;<?php echo $datumo->title_number."<br>"; ?>&nbsp;
        <?php } ?>
        <?php $profile=DB::table('pgl_profiles')->first(); ?>
    <br>
        Please log-into your PGL account in {{$profile->website}} and review the pictures and conditional report along with all other information.
        <br>
        Will provide you with the updated information as soon as we get <br>
    </p>

    <p>Sincerely,<br>

        Peace Global Logistics <br>

        {{$profile->email}} <br>
        {{$profile->phone}} <br>
        {{$profile->fax}} <br>
        {{$profile->website}} <br>
        {{$profile->facebook}} <br>
        {{$profile->street}} <br>
        {{$profile->city}},{{$profile->state}},
        {{$profile->zip_code}} <br>
    </p>
</div>
</body>
</html>