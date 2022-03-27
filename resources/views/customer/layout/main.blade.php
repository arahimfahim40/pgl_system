<!DOCTYPE html>
<html lang="en">
	
<!-- Mirrored from big-bang-studio.com/neptune/neptune-default/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 17 Jan 2017 10:20:07 GMT -->
<head>
		<!-- Meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta http-equiv="x-ua-compatible" content="ie=edge">
		<meta name="description" content="">
		<meta name="author" content="">
		<link rel="shortcut icon" href="{{ asset('img/logo-small.png') }}"/>

		<!-- Title -->
		<title>@yield('title')</title>
		<!-- Vendor CSS -->
		<link rel="stylesheet" href="{{asset('assets/bootstrap4/css/bootstrap.min.css')}}">
		<link rel="stylesheet" href="{{asset('assets/themify-icons/themify-icons.css')}}">
		<link rel="stylesheet" href="{{asset('assets/font-awesome/css/font-awesome.min.css')}}">
		<link rel="stylesheet" href="{{asset('assets/animate.css/animate.min.css')}}">
		<link rel="stylesheet" href="{{asset('assets/jscrollpane/jquery.jscrollpane.css')}}">
		<link rel="stylesheet" href="{{asset('assets/waves/waves.min.css')}}">
		<link rel="stylesheet" href="{{asset('assets/switchery/dist/switchery.min.css')}}">
		<link rel="stylesheet" href="{{asset('assets/morris/morris.css')}}">
		<link rel="stylesheet" href="{{asset('assets/jvectormap/jquery-jvectormap-2.0.3.css')}}">

		<!-- style link for table -->
		<!-- <link rel="stylesheet" href="{{asset('assets/DataTables/css/dataTables.bootstrap4.min.css')}}">
		<link rel="stylesheet" href="{{asset('assets/DataTables/Responsive/css/responsive.bootstrap4.min.css')}}">
		<link rel="stylesheet" href="{{asset('assets/DataTables/Buttons/css/buttons.dataTables.min.css')}}">
		<link rel="stylesheet" href="{{asset('assets/DataTables/Buttons/css/bu ttons.bootstrap4.min.css')}}"> -->
		<!-- Neptune CSS -->
		<link rel="stylesheet" href="{{asset('assets/css/core.css')}}">
		<style type="text/css">
			div.dataTables_filter label{
				display: none !important;
			}
			div.dataTables_wrapper div.dt-buttons{
		    margin-top: 12px;
		    float: right !important;
			  }
			 table.dataTable thead th.sorting:after {
			    display: none;
			 }
			 div.dataTables_info,div.dataTables_paginate{
			 	display: none !important;
			 }
		</style>
		 @yield('style')
	</head>
	<body class="fixed-sidebar fixed-header skin-default content-appear">
		<div class="wrapper">

			<!-- Preloader -->
			<div class="preloader"></div>
			<!-- Sidebar -->
			<div class="site-overlay"></div>
			<div class="site-sidebar">
				<div class="custom-scroll custom-scroll-light">
					<ul class="sidebar-menu">
						<li>
							<a href="{{route('dashboard')}}" class="waves-effect  waves-light">
								<span class="s-icon"><i class="ti-layout-tab"></i></span>
								<span class="s-text">Dashboard</span>
							</a>
						</li>
						<li class="with-sub">
							<a href="#" class="waves-effect  waves-light vehicles">
								<span class="s-caret"><i class="fa fa-angle-down"></i></span>
								<span class="tag tag-purple t_all_vehicle">0</span>
								<span class="s-icon"><i class="fa fa-car"></i></span>
								<span class="s-text">Vehicles</span>
							</a>
							<ul>
								<li><a href="{{route('all_vehicle_customer')}}">All 
								<span class="tag tag-warning t_all_vehicle" style="float:right;">0</span> 
								</a>
								</li>
								<li><a href="{{route('on_theway_vehicle_customer')}}" id="on_the_way">On the way <span class="tag tag-warning t_on_the_way" style="float:right;">0</span></a>
								</li>
								<li><a href="{{route('pending_vehicle_customer')}}" id="pending">Pending <span class="tag tag-warning t_pending" style="float:right;">0</span></a>
								</li>
								<li><a href="{{route('onhand_notitle_vehicle_customer')}}" id="on_hand_no">On hand no/title <span class="tag tag-warning t_on_hand_no" style="float:right;">0</span></a>
								</li>
								<li><a href="{{route('onhand_withtitle_vehicle_customer')}}" id="on_hand_with">On hand with/title <span class="tag tag-warning t_on_hand_with" style="float:right;">0</span></a></li>
								<li><a href="{{route('shipped_vehicle_customer')}}" id="shipped">Shipped <span class="tag tag-warning t_shipped" style="float:right;">0</span></a>
								</li>
								<li><a href="{{route('vehicle_cost_analysis_customer')}}">Cost anlysis</a>
								</li>
								<li><a href="{{route('dateline_vehicle_customer')}}">Datelines</a>
								</li>
							</ul>
						</li>
						<li class="with-sub">
							<a href="#" class="waves-effect  waves-light">
								<span class="s-caret"><i class="fa fa-angle-down"></i></span>
								<span class="tag tag-danger t_all_ship">0</span>
								<span class="s-icon"><i class="ti-package"></i></span>
								<span class="s-text">Shipments</span>
							</a>
							<ul>
								<li><a href="{{route('shipment_customer','5')}}">All <span class="tag tag-warning t_all_ship" style="float:right;">0</span></a></li>
								<li><a href="{{route('shipment_customer','0')}}">Atloading <span class="tag tag-warning t_loading_ship" style="float:right;">0</span></a></li>
								<li><a href="{{route('shipment_customer','1')}}">On the way <span class="tag tag-warning t_on_the_way_ship" style="float:right;">0</span> </a></li>
								<li><a href="{{route('shipment_customer','2')}}">Arrived <span class="tag tag-warning t_arrived_ship" style="float:right;">0</span></a></li>
							</ul>
						</li>
						<li class="with-sub">
							<a href="#" class="waves-effect  waves-light">
								<span class="s-caret"><i class="fa fa-angle-down"></i></span>
								<span class="tag tag-success t_all_inv">0</span>
								<span class="s-icon"><i class="ti-gallery"></i></span>
								<span class="s-text">Invoices</span>
							</a>
							<ul>
								<li><a href="{{route('invoice_customer','5')}}">All
								<span class="tag tag-warning t_all_inv" style="float:right;">0</span>
								</a></li>
								<li><a href="{{route('invoice_customer','0')}}">Open
								<span class="tag tag-warning t_open_inv" style="float:right;">0</span>
								</a></li>
								<li><a href="{{route('invoice_customer','2')}}">Past Due
								<span class="tag tag-warning t_pastdue_inv" style="float:right;">0</span>
								</a></li>
								<li><a href="{{route('invoice_customer','3')}}">Paid 
								<span class="tag tag-warning t_paid_inv" style="float:right;">0</span>
								</a></li>
							</ul>
						</li>
						<li class="with-sub">
							<a href="#" class="waves-effect  waves-light">
								<span class="s-caret"><i class="fa fa-angle-down"></i></span>
								<span class="s-icon"><i class="ti-email"></i></span>
								<span class="s-text">Rates</span>
							</a>
							<ul>
								<li><a href="{{route('shipping_rate_customer')}}">Shipping Rates</a></li>
								<li><a href="{{route('towing_rate_customer')}}">Towing Rates</a></li>
							</ul>
						</li>
						<!-- <li class="with-sub">
							<a href="#" class="waves-effect  waves-light">
								<span class="s-caret"><i class="fa fa-angle-down"></i></span>
								<span class="s-icon"><i class="ti-star"></i></span>
								<span class="s-text">Messages</span>
							</a>
							<ul>
								<li><a href="{{route('messages_customer')}}">Sended</a></li>
								<li><a href="icons-ionicons.html">Received</a></li>
								
							</ul>
						</li> -->
					</ul>
				</div>
			</div>
			<!-- Header -->
			<div class="site-header">
				<nav class="navbar navbar-light">
					<div class="navbar-left" style="text-align:left !important; padding-left:1%;">
						<a class="navbar-brand" href="#">
							<div class="avatar" style="font-size: 14px;">
								<i class="status bg-success"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<span class="text-warning">{{Auth::user()->customer_name}}</span>
							</div>
						</a>
						<div class="toggle-button dark sidebar-toggle-first float-xs-left hidden-md-up">
							<span class="hamburger"></span>
						</div>
						<div class="toggle-button-second dark float-xs-right hidden-md-up">
							<i class="ti-arrow-left"></i>
						</div>
						<div class="toggle-button dark float-xs-right hidden-md-up" data-toggle="collapse" data-target="#collapse-1">
							<span class="more"></span>
						</div>
					</div>
					<div class="navbar-right bg-primary navbar-toggleable-sm collapse" id="collapse-1">
						<div class="toggle-button light sidebar-toggle-second float-xs-left hidden-sm-down">
							<span class="hamburger"></span>
						</div>
						<ul class="nav navbar-nav float-md-right">
							<li class="nav-item dropdown">
								<a class="nav-link" href="#" data-toggle="dropdown" aria-expanded="false">
									<i class="ti-email message_customer"></i>
									<span class="hidden-md-up ml-1">Notifications</span>
									<span class="tag tag-danger top count_message_customer"><?=DB::table('notifications')
								        ->where(['customer_id'=>Auth::id(),'type'=>1,'status'=>0])->count();
							        ?></span>
								</a>
								<div class="dropdown-messages dropdown-tasks dropdown-menu dropdown-menu-right animated fadeInUp meessage_customer_detail">
									<div class="m-item">
										<div class="mi-icon bg-info meessage_customer_detail"><i class="ti-comment"></i></div>
										<div class="mi-text"><a class="text-black" href="#"></a> <span class="text-muted"></span> <a class="text-black" href="#"></a>
										</div>
										<div class="mi-time">5 min ago</div>
									</div>
									<a class="dropdown-more" href="#">
										<strong>View all notifications</strong>
									</a>
								</div>
							</li>
							<li class="nav-item dropdown hidden-sm-down">
								<a href="#" data-toggle="dropdown" aria-expanded="false">
									<span class="avatar box-32">
										<img src="{{ route('profile.customer', Auth::user()->photo)}}" onerror="this.src='{{asset('img/avatars/profile.png')}}'"/>
									</span>
								</a>
								<div class="dropdown-menu dropdown-menu-right animated fadeInUp">
									<!-- <a class="dropdown-item" href="#">
										<i class="ti-email mr-0-5"></i> Inbox
									</a> -->
									<a class="dropdown-item" href="#">
										<i class="ti-user mr-0-5"></i> Profile 
									</a>
									<a class="dropdown-item" href="{{route('logout')}}"><i class="ti-power-off mr-0-5"></i> Sign out</a>
									<a class="dropdown-item text-warning" target="_blank" href="http://pglsystem.com/customer_login">
										<i class="ti-home mr-0-5"></i> Load old system
									</a>
								</div>
							</li>
						</ul>
						<ul class="nav navbar-nav">
							<li class="nav-item hidden-sm-down">
								<a class="nav-link toggle-fullscreen" href="#">
									<i class="ti-fullscreen"></i>
								</a>
							</li>
						</ul>
						<!-- <div class="header-form float-md-left ml-md-2">
							<form>
								<input type="text" class="form-control b-a" placeholder="Search for...">
								<button type="submit" class="btn bg-white b-a-0">
									<i class="ti-search"></i>
								</button>
							</form>
						</div> -->
					</div>
				</nav>
			</div>

			@yield('content')

		</div>

		<!-- Vendor JS -->
		<!-- <script type="text/javascript" src="{{asset('assets/jquery/jquery-1.12.3.min.js')}}">
		</script> -->
		<script type="text/javascript" src="{{asset('assets/js/jquery-3.6.0.min.js')}}">
		</script>
		<script type="text/javascript" src="{{asset('assets/jquery-plugin/tableHTMLExport.js')}}"></script>
		<!--  -->


		<script type="text/javascript" src="{{asset('assets/tether/js/tether.min.js')}}"></script>
		<script type="text/javascript" src="{{asset('assets/bootstrap4/js/bootstrap.min.js')}}"></script>
		<script type="text/javascript" src="{{asset('assets/detectmobilebrowser/detectmobilebrowser.js')}}"></script>
		<script type="text/javascript" src="{{asset('assets/jscrollpane/jquery.mousewheel.js')}}"></script>
		<script type="text/javascript" src="{{asset('assets/jscrollpane/mwheelIntent.js')}}"></script>
		<script type="text/javascript" src="{{asset('assets/jscrollpane/jquery.jscrollpane.min.js')}}"></script>
		<script type="text/javascript" src="{{asset('assets/jquery-fullscreen-plugin/jquery.fullscreen-min.js')}}"></script>
		<script type="text/javascript" src="{{asset('assets/waves/waves.min.js')}}"></script>
		<script type="text/javascript" src="{{asset('assets/switchery/dist/switchery.min.js')}}"></script>
		<!-- <script type="text/javascript" src="{{asset('assets/flot/jquery.flot.min.js')}}"></script>
		<script type="text/javascript" src="{{asset('assets/flot/jquery.flot.resize.min.js')}}"></script>
		<script type="text/javascript" src="{{asset('assets/flot.tooltip/js/jquery.flot.tooltip.min.js')}}"></script>
		<script type="text/javascript" src="{{asset('assets/CurvedLines/curvedLines.js')}}"></script> -->
		<script type="text/javascript" src="{{asset('assets/TinyColor/tinycolor.js')}}"></script>
		<script type="text/javascript" src="{{asset('assets/sparkline/jquery.sparkline.min.js')}}"></script>
		<script type="text/javascript" src="{{asset('assets/raphael/raphael.min.js')}}"></script>
		<script type="text/javascript" src="{{asset('assets/morris/morris.min.js')}}"></script>
		<script type="text/javascript" src="{{asset('assets/jvectormap/jquery-jvectormap-2.0.3.min.js')}}"></script>
		<script type="text/javascript" src="{{asset('assets/jvectormap/jquery-jvectormap-world-mill.js')}}"></script>
		<script type="text/javascript" src="{{asset('assets/peity/jquery.peity.js')}}"></script>
		<!-- js for table -->
		 <script type="text/javascript" src="{{asset('assets/DataTables/js/jquery.dataTables.min.js')}}"></script>
		 

		 <!-- before commented -->
		<!-- <script type="text/javascript" src="{{asset('assets/DataTables/js/dataTables.bootstrap4.min.js')}}"></script>
		<script type="text/javascript" src="{{asset('assets/DataTables/Responsive/js/dataTables.responsive.min.js')}}"></script>
		<script type="text/javascript" src="{{asset('assets/DataTables/Responsive/js/responsive.bootstrap4.min.js')}}"></script> -->
		





		<!-- <script type="text/javascript" src="{{asset('assets/DataTables/Buttons/js/dataTables.buttons.min.js')}}"></script>
		<script type="text/javascript" src="{{asset('assets/DataTables/Buttons/js/buttons.bootstrap4.min.js')}}"></script> 
		<script type="text/javascript" src="{{asset('assets/DataTables/JSZip/jszip.min.js')}}"></script>
		<script type="text/javascript" src="{{asset('assets/DataTables/pdfmake/build/pdfmake.min.js')}}"></script>
		<script type="text/javascript" src="{{asset('assets/DataTables/pdfmake/build/vfs_fonts.js')}}"></script>
		<script type="text/javascript" src="{{asset('assets/DataTables/Buttons/js/buttons.html5.min.js')}}"></script> -->


         <!--before commented  -->
		<!-- <script type="text/javascript" src="{{asset('assets/DataTables/Buttons/js/buttons.print.min.js')}}"></script>
		<script type="text/javascript" src="{{asset('assets/DataTables/Buttons/js/buttons.colVis.min.js')}}"></script> -->
		



		<script type="text/javascript" src="{{asset('assets/js/tables-datatable.js')}}"></script> 


		<!-- Neptune JS -->
		<script type="text/javascript" src="{{asset('assets/js/app.js')}}"></script>
		<!-- <script type="text/javascript" src="{{asset('assets/js/demo.js')}}"></script> -->
		<script type="text/javascript" src="{{asset('assets/js/index.js')}}"></script>
		@yield('js')
		<script type="text/javascript">
				var request = $.ajax({
	              url: "{{route('veh_ship_inv_total_customer')}}",
	              method: "GET",
	              dataType:'json'
	            }); 
	            request.done(function( msg) {
	            	$('.t_all_vehicle').text(msg.allvehicle);
	            	$('.t_on_the_way').text(msg.onthewayvehicle);
	            	$('.t_on_hand_no').text(msg.onhandnotitlevehicle);
	            	$('.t_on_hand_with').text(msg.onhandwithtitlevehicle);
	            	$('.t_shipped').text(msg.shippedvehicle);
	            	$('.t_pending').text(msg.pendingvehicle);

	            	$('.t_all_ship').text(msg.allshipment);
	            	$('.t_loading_ship').text(msg.loadingshipment);
	            	$('.t_on_the_way_ship').text(msg.onthewayshipment);
	            	$('.t_arrived_ship').text(msg.arrivedshipment);

	            	$('.t_all_inv').text(msg.allinvoice);
	            	$('.t_open_inv').text(msg.openinvoice);
	            	$('.t_past_due_inv').text(msg.pastdueinvoice);
	            	$('.t_paid_inv').text(msg.paidinvoice);
	                
	            });
	            request.fail(function( jqXHR, textStatus ) {
	            	alert('fail to load the total');
	            });
	            // get messages
	            $('.message_customer').click(function(){
	            	$('.meessage_customer_detail').html("<div style='text-align:center'><img width='40px' src='img/loading.gif' alt='Loading ...'> </div>");  
		            var request = $.ajax({
		              url: "{{route('message_customer')}}",
		              method: "GET",
		              dataType:'json'
		            }); 
		            request.done(function( msg) {
		            	$('.meessage_customer_detail').html(msg);
		            });
		            request.fail(function( jqXHR, textStatus ) {
		            	$('.meessage_customer_detail').html('');
		            	alert(textStatus);
		            });
	           });
		</script>
	</body>
</html>