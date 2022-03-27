<!DOCTYPE html>
<html lang="en">
	
<head>
		<!-- Meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta http-equiv="x-ua-compatible" content="ie=edge">
		<meta name="description" content="">
		<meta name="author" content="">
		<link rel="shortcut icon" href="{{ asset('img/logo-small.png') }}"/>

		<!-- Title -->
		<title>Acess Denied </title>

		<!-- Vendor CSS -->
		<link rel="stylesheet" href="{{asset('assets/bootstrap4/css/bootstrap.min.css')}}">
		<link rel="stylesheet" href="{{asset('assets/themify-icons/themify-icons.css')}}">
		<link rel="stylesheet" href="{{asset('assets/font-awesome/css/font-awesome.min.css')}}">
		<!-- Neptune CSS -->
		<link rel="stylesheet" href="{{asset('assets/css/core.css')}}">
	</head>
	<body class="bg-warning">
		<div class="error-message text-xs-center">
			<h1 class="mb-3">403<span><i class="ti-na"></i></span></h1>
			<h4 class="text-uppercase">Access Denied</h4>
			<div class="error-message-text mb-3">Sorry, you don't have permission to access on this page.</div>
			<a href="{{url('dashboards')}}" class="btn btn-outline-white w-min-md">Go to home page</a>
		</div>

		<!-- Vendor JS -->
		<script type="text/javascript" src="{{asset('assets/jquery/jquery-1.12.3.min.js')}}"></script>
		<script type="text/javascript" src="{{asset('assets/tether/js/tether.min.js')}}"></script>
		<script type="text/javascript" src="{{asset('assets/bootstrap4/js/bootstrap.min.js')}}"></script>
	</body>
</html>