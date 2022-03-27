<!DOCTYPE html>
<html lang="en">
    
<!-- Mirrored from big-bang-studio.com/neptune/neptune-default/pages-sign-in2.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 17 Jan 2017 10:50:31 GMT -->
<head>
        <!-- Meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="shortcut icon" href="{{ asset('img/logo-small.png') }}"/>
        <!-- Title -->
        <title>Peace Global Logistics</title>

        <!-- Vendor CSS -->
        <link rel="stylesheet" href="{{asset('assets/bootstrap4/css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{asset('assets/themify-icons/themify-icons.css')}}">
        <link rel="stylesheet" href="{{asset('assets/font-awesome/css/font-awesome.min.css')}}">

        <!-- Neptune CSS -->
        <link rel="stylesheet" href="{{asset('assets/css/core.css')}}">

       <style type="text/css">
           .btn{
            height: 120px;
            border-radius: 30px;
            font-size: 15px;
            font-weight: bold;
            text-align: center !important;
           }
           .icon{
            /*position: absolute;*/
            margin-top: 42px !important;
           }
           @media only screen and (max-device-width: 480px) {
            .btn{
                font-size: 12px;
                font-weight: normal;
            }
           }
       </style>
    </head>
    <body class="auth-bg">
        
        <div class="auth">
            <div class="container-fluid">
                <div class="row" style="padding-top:20% !important;">
                    <div class="col-md-6 col-lg-4 col-xs-12 offset-md-4">
                        <div class="row" >
                            <div class="col-xs-6">
                                <a href="{{url('customer_login')}}">
                                    <button type="button" class="btn bg-info btn-block label-left mb-0-25 btn-rounded">
                                        <span class="btn-label"><i class="fa fa-users icon"></i></span>
                                        Login as customer
                                    </button>
                                </a>
                            </div>
                            <div class="col-xs-6">
                                <a href="{{url('admin_login')}}">
                                    <button type="button" class="btn bg-primary btn-block label-left mb-0-45 btn-ronded">
                                        <span class="btn-label"><i class="fa fa-user icon"></i></span>
                                        Login as admin
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Vendor JS -->
        <script type="text/javascript" src="{{asset('assets/js/jquery-3.6.0.min.js')}}">
        </script>
        <script type="text/javascript" src="{{asset('assets/jquery-plugin/tableHTMLExport.js')}}"></script>
        <script type="text/javascript" src="{{asset('assets/tether/js/tether.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('assets/bootstrap4/js/bootstrap.min.js')}}"></script>
    </body>

<!-- Mirrored from big-bang-studio.com/neptune/neptune-default/pages-sign-in2.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 17 Jan 2017 10:50:31 GMT -->
</html>