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
        Dear  <?php if(isset($poc) ){echo $poc;} ?> and <?php if(isset($comp) ){echo $comp;} ?><br>
        Thanks for choosing PGL as your shipper for {{$make}}&nbsp; {{$model}}&nbsp;{{$year}}&nbsp;{{$color}} with VIN# {{$vin}}.
        <br> We received your request and the Status of your vehicle is ON THEY WAY to  <?php if(isset($loc) ){echo $loc;} ?>.
        <br>
        We will provide you with the updated information as soon as we get,<br>
    </p>
    <p>Sincerely,<br>

        Peace Global Logistics <br>
        <?php $profile=DB::table('pgl_profiles')->first(); ?>
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
