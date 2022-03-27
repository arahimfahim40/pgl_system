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
        Your {{$data2["desc"]}} with VIN# {{$data2["vin"]}} has been received to PGL warehouse at {{$data2["terminal"]}} and the status has been changed to On HAND with NO TITLE.
        <br>
        PGL will not be able to ship your car until we receive the TITLE, please make sure to do all your follow up for early receipt of your TITLE.
        <br>
     
        <?php $profile=DB::table('pgl_profiles')->first(); ?>
        Please log-into your PGL account in {{$profile->website}} and review the pictures and conditional report along with all other information.
        <br>
        We will provide you with the updated information as soon as we get,<br>


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