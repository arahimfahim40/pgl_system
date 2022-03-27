<!DOCTYPE html>
<html lang="en">
<<<<<<< HEAD

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
    <link rel="stylesheet" href="{{asset('assets/select2/dist/css/select2.min.css')}}">

    <link rel="stylesheet" href="{{asset('assets/toastr/toastr.min.css')}}">

    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
    <!-- Neptune CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/core.css')}}">

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <style type="text/css">
        .search_reload:hover {
            cursor: pointer;
            font-weight: bold;
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
                    <a href="{{route('dashboard_admin')}}" class="waves-effect  waves-light">
                        <span class="s-icon"><i class="fa fa-home"></i></span>
                        <span class="s-text">Dashboard</span>
                    </a>
                </li>

                @if(Auth::guard('admin')->user()->hasPermissions(['Admin','customer-management']))
                    <li>
                        <a href="{{route('company_admin')}}" class="waves-effect  waves-light">
                            <span class="s-icon"><i class="ti-layout-tab"></i></span>
                            <span class="s-text">Company </span>
                        </a>
                    </li>
                @endif
                @if(Auth::guard('admin')->user()->hasPermissions(['Admin','log-management']))
                    <li class="with-sub">
                        <a href="#" class="waves-effect  waves-light">
                            {{--  <span class="s-caret"><i class="fa fa-angle-down"></i></span>  --}}
                            <span class="s-icon"><i class="fa fa-cube"></i></span>
                            <span class="s-text dropdown-toggle"
                                  title="Operation Department">Operation Department</span>
                        </a>
                        <ul>
                            <li><a href="{{route('clear_log_list')}}">Clear Log</a></li>
                            @if(Auth::guard('admin')->user()->hasPermissions(['Admin','create-invoice-log']))
                                <li><a href="{{route('create_invoice_list')}}">Create Invoice</a></li>
                            @endif
                        </ul>
                    </li>
                @endif
                @if(Auth::guard('admin')->user()->hasPermissions(['Admin','finance-management']))
                    <li class="with-sub">
                        <a href="#" class="waves-effect  waves-light">
                            {{--  <span class="s-caret"><i class="fa fa-angle-down"></i></span>  --}}
                            <span class="s-icon"><i class="fa fa-cube"></i></span>
                            <span class="s-text dropdown-toggle" title="Operation Department">Finance Department</span>
                        </a>
                        <ul>
                            <li><a href="{{route('invoices_list_admin','1')}}">All Invoice</a></li>
                            <li><a href="{{route('invoices_list_admin','2')}}">Pending Invoice</a></li>
                            <li><a href="{{route('invoices_list_admin','3')}}">Open Invoice</a></li>
                            <li><a href="{{route('invoices_list_admin','4')}}">Past Due Invoice</a></li>
                            <li><a href="{{route('invoices_list_admin','5')}}">Paid Invoice</a></li>
                        </ul>
                    </li>
                @endif
                @if(Auth::guard('admin')->user()->hasPermissions(['Admin','customer-management']))
                    <li>
                        <a href="{{route('customer_admin')}}" class="waves-effect  waves-light">
                            <span class="s-icon"><i class="fa fa-users"></i></span>
                            <span class="s-text">Customer </span>
                        </a>
                    </li>
                @endif
                @if(Auth::guard('admin')->user()->hasPermissions(['Admin','vehicles-management']))
                    <li class="with-sub">
                        <a href="#" class="waves-effect  waves-light vehicles">
                            <span class="s-caret"><i class="fa fa-angle-down"></i></span>
                            <span class="tag tag-purple t_all_vehicle">0</span>
                            <span class="s-icon"><i class="fa fa-car"></i></span>
                            <span class="s-text">Vehicles</span>
                        </a>
                        <ul>
                            @if(Auth::guard('admin')->user()->hasPermissions(['Admin','add-vehicles']))
                                <li>
                                    <a href="{{url('add_vehicle')}}">Add new</a>
                                </li>
                            @endif
                            <li>
                                <a href="{{route('tow_cost_report_admin')}}" class="waves-effect  waves-light">
                                    <span class="s-text">Tow Cost Report</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('all_vehicle_admin')}}">All
                                    <span class="tag tag-warning t_all_vehicle" style="float:right;">0</span>
                                </a>
                            </li>
                            <li><a href="{{route('on_theway_vehicle_admin')}}" id="on_the_way">On the way <span
                                            class="tag tag-warning t_on_the_way" style="float:right;">0</span></a>
                            </li>
                            <li><a href="{{route('pending_vehicle_admin')}}" id="pending">Pending <span
                                            class="tag tag-warning t_pending" style="float:right;">0</span></a>
                            </li>
                            <li><a href="{{route('onhand_notitle_vehicle_admin')}}" id="on_hand_no">On hand no/title
                                    <span class="tag tag-warning t_on_hand_no" style="float:right;">0</span></a>
                            </li>
                            <li><a href="{{route('onhand_withtitle_vehicle_admin')}}" id="on_hand_with">On hand
                                    with/title <span class="tag tag-warning t_on_hand_with"
                                                     style="float:right;">0</span></a></li>
                            <li><a href="{{route('shipped_vehicle_admin')}}" id="shipped">Shipped <span
                                            class="tag tag-warning t_shipped" style="float:right;">0</span></a>
                            </li>
                            <li><a href="{{route('vehicle_cost_analysis_admin')}}">Cost anlysis</a>
                            </li>
                            <li><a href="{{route('dateline_vehicle_admin')}}">Datelines</a>
                            </li>
                            <li>
                                <a href="{{url('vehicle_summary')}}">Summary</a>
                            </li>
                        </ul>
                    </li>
                @endif
                @if(Auth::guard('admin')->user()->hasPermissions(['Admin','shipment-management']))
                    <li class="with-sub">
                        <a href="#" class="waves-effect  waves-light">
                            <span class="s-caret"><i class="fa fa-angle-down"></i></span>
                            <span class="tag tag-danger t_all_ship">0</span>
                            <span class="s-icon"><i class="ti-package"></i></span>
                            <span class="s-text">Shipments</span>
                        </a>
                        <ul>
                            @if(Auth::guard('admin')->user()->hasPermissions(['Admin','add-shipment']))
                                <li>
                                    <a href="{{url('add_shipment')}}">Add new</a>
                                </li>
                            @endif
                            <li><a href="{{route('shipment_admin',['10','10'])}}">All <span
                                            class="tag tag-warning t_all_ship" style="float:right;">0</span></a></li>
                            <li><a href="{{route('shipment_admin',['3','10'])}}">Pending <span
                                            class="tag tag-warning t_pending_ship" style="float:right;">0</span></a>
                            </li>
                            <li class="with-sub">
                                <a href="#" class="waves-effect  waves-light">
                                    <span class="tag tag-warning t_loading_ship"
                                          style="float:right; border-radius: 3px;"></span>
                                    <span class="s-icon"><i class="fa fa-circle-o"></i></span>
                                    <span class="s-text">At loading</span>
                                </a>
                                <ul>
                                    <li><a href="{{route('shipment_admin',['0','10'])}}">All <span
                                                    class="tag tag-info t_loading_ship"
                                                    style="float:right;">0</span></a>
                                    </li>
                                    <?php $location = DB::table('locations')->get(); ?>
                                    @foreach($location as $loca)
                                        <li>
                                            <a href="{{route('shipment_admin',['0',$loca->location])}}">{{$loca->location}}
                                                <span class="tag tag-info" style="float:right;">
						                  @if($loca->location=='Savannah, GA')
                                                        {{DB::table('containers')->where('status',0)->where('port_loading','like', '%'.'Savannah'.'%')->count()}}</span></a>
                                            @else
                                            {{DB::table('containers')->where('status',0)->where('port_loading','like', '%'.$loca->location.'%')->count()}}</span></a>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            </li>

                            <li class="with-sub">
                                <a href="#" class="waves-effect  waves-light">
                                    <span class="tag tag-warning t_checked_ship"
                                          style="float:right; border-radius: 3px;">0</span>
                                    <span class="s-icon"><i class="fa fa-circle-o"></i></span>
                                    <span class="s-text">Checked</span>
                                </a>
                                <ul>
                                    <li><a href="{{route('shipment_admin',['4','10'])}}">All
                                            <span class="tag tag-info t_checked_ship" style="float:right;">0</span></a>
                                    </li>
                                    <?php $location = DB::table('locations')->get(); ?>
                                    @foreach($location as $loca)
                                        <li>
                                            <a href="{{route('shipment_admin',['4',$loca->location])}}">{{$loca->location}}
                                                <span class="tag tag-info" style="float:right;">
						                  @if($loca->location=='Savannah, GA')
                                                        {{DB::table('containers')->where('status',4)->where('port_loading','like', '%'.'Savannah'.'%')->count()}}</span></a>
                                            @else
                                            {{DB::table('containers')->where('status',4)->where('port_loading','like', '%'.$loca->location.'%')->count()}}</span></a>
                                            @endif
                                        </li>
                                    @endforeach
                                    <li><a href="{{route('shipment_admin',['5','10'])}}">Final checked
                                            <span class="tag tag-info t_finalchecked_ship" style="float:right;">0</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li><a href="{{route('shipment_admin',['9','10'])}}">Submit Si <span
                                            class="tag tag-warning t_submitsi_ship" style="float:right;">0</span></a>
                            </li>
                            <li><a href="{{route('shipment_admin',['1','10'])}}">On the way <span
                                            class="tag tag-warning t_on_the_way_ship" style="float:right;">0</span> </a>
                            </li>
                            <li><a href="{{route('shipment_admin',['2','10'])}}">Arrived <span
                                            class="tag tag-warning t_arrived_ship" style="float:right;">0</span></a>
                            </li>
                            <li>
                                <a href="{{route('shipment_summary')}}">Summary</a>
                            </li>
                        </ul>
                    </li>
                @endif
                @if(Auth::guard('admin')->user()->hasPermissions(['Admin','invoices-management']))
                    <li class="with-sub">
                        <a href="#" class="waves-effect  waves-light">
                            <span class="s-caret"><i class="fa fa-angle-down"></i></span>
                            <span class="tag tag-success t_all_inv">0</span>
                            <span class="s-icon"><i class="ti-gallery"></i></span>
                            <span class="s-text">Invoices</span>
                        </a>
                        <ul>
                            @if(Auth::guard('admin')->user()->hasPermissions(['Admin','add-invoice']))
                                <li>
                                    <a href="{{route('add_invoice_admin')}}">Add new</a>
                                </li>
                            @endif
                            <li><a href="{{route('invoice_admin','5')}}">All
                                    <span class="tag tag-warning t_all_inv" style="float:right;">0</span>
                                </a></li>
                            <li><a href="{{route('invoice_admin','4')}}">Pending
                                    <span class="tag tag-warning t_pending_inv" style="float:right;">0</span></a>
                            </li>
                            <li><a href="{{route('invoice_admin','0')}}">Open
                                    <span class="tag tag-warning t_open_inv" style="float:right;">0</span>
                                </a></li>
                            <li><a href="{{route('invoice_admin','2')}}">Past Due
                                    <span class="tag tag-warning t_past_due_inv" style="float:right;">0</span>
                                </a></li>
                            <li><a href="{{route('invoice_admin','3')}}">Paid
                                    <span class="tag tag-warning t_paid_inv" style="float:right;">0</span>
                                </a></li>
                        </ul>
                    </li>
                @endif
                @if(Auth::guard('admin')->user()->hasPermissions(['Admin','rates-management']))
                    <li class="with-sub">
                        <a href="#" class="waves-effect  waves-light">
                            <span class="s-caret"><i class="fa fa-angle-down"></i></span>
                            <span class="s-icon"><i class="ti-email"></i></span>
                            <span class="s-text">Rates</span>
                        </a>
                        <ul>
                            <li><a href="{{route('shipping_rate_admin')}}">Shipping Rates</a></li>
                            <li><a href="{{route('towing_rate_admin')}}">Towing Rates</a></li>
                        </ul>
                    </li>
                @endif
                @if(Auth::guard('admin')->user()->hasPermissions(['Admin','setting']))
                    <li class="with-sub">
                        <a href="#" class="waves-effect  waves-light">
                            <span class="s-caret"><i class="fa fa-angle-down"></i></span>
                            <span class="s-icon"><i class="fa fa-cog"></i></span>
                            <span class="s-text">Setting</span>
                        </a>
                        <ul>
                            <li><a href="{{route('location_admin')}}">Locations</a></li>
                            <li><a href="{{route('status_admin')}}">Status</a></li>
                        </ul>
                    </li>
                @endif
                @if(Auth::guard('admin')->user()->hasPermissions(['Admin','report-center']))
                    <li class="with-sub">
                        <a href="#" class="waves-effect  waves-light">
                            <span class="s-caret"><i class="fa fa-angle-down"></i></span>
                            <span class="s-icon"><i class="ti-bar-chart-alt"></i></span>
                            <span class="s-text">Report center</span>
                        </a>
                        <ul>
                            <li><a href="#">Customer report</a></li>
                            <li><a href="#">Vehicle report</a></li>
                            <li><a href="#">Shipment report</a></li>
                            <li><a href="#">Invoice report</a></li>
                        </ul>
                    </li>
                @endif
                @if(Auth::guard('admin')->user()->hasPermissions(['Admin','company-management']))
                    <li>
                        <a href="{{route('pgl_profile')}}" class="waves-effect  waves-light">
                            <span class="s-icon"><i class="ti-calendar"></i></span>
                            <span class="s-text">PGL Profile</span>
                        </a>
                    </li>
                @endif
                @if(Auth::guard('admin')->user()->hasPermissions(['Admin','user-management']))
                    <li class="with-sub">
                        <a href="{{route('user_admin')}}" class="waves-effect  waves-light">
                            <span class="s-icon"><i class="fa fa-users"></i></span>
                            <span class="s-text">User</span>
                        </a>
                    </li>
                @endif
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
                        <span class="text-warning">{{Auth::guard('admin')->user()->username}}</span>
                    </div>
                </a>
                <div class="toggle-button dark sidebar-toggle-first float-xs-left hidden-md-up">
                    <span class="hamburger"></span>
                </div>
                <div class="toggle-button-second dark float-xs-right hidden-md-up">
                    <i class="ti-arrow-left"></i>
                </div>
                <div class="toggle-button dark float-xs-right hidden-md-up" data-toggle="collapse"
                     data-target="#collapse-1">
                    <span class="more"></span>
                </div>
            </div>
            <div class="navbar-right bg-info navbar-toggleable-sm collapse" id="collapse-1">
                <div class="toggle-button light sidebar-toggle-second float-xs-left hidden-sm-down">
                    <span class="hamburger"></span>
                </div>
                <ul class="nav navbar-nav float-md-right">
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="#" data-toggle="dropdown" aria-expanded="false">
                            <i class="ti-email message_admin"></i>
                            <span class="hidden-md-up ml-1">Notifications</span>
                            <span class="tag tag-danger top count_message_admin"><?=DB::table('notifications')
                                    ->where(['customer_id' => Auth::guard('admin')->id(), 'type' => 1, 'status' => 0])->count();
                                ?></span>
                        </a>
                        <div class="dropdown-messages dropdown-tasks dropdown-menu dropdown-menu-right animated fadeInUp meessage_admin_detail">
                            <div class="m-item">
                                <div class="mi-icon bg-info meessage_admin_detail"><i class="ti-comment"></i></div>
                                <div class="mi-text"><a class="text-black" href="#"></a> <span
                                            class="text-muted"></span> <a class="text-black" href="#"></a>
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
										<img src="{{ url('profile.customer',Auth::guard('admin')->user()->photo)}}"
                                             onerror="this.src='{{asset('img/avatars/profile.png')}}'"/>
									</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right animated fadeInUp">
                            <!-- <a class="dropdown-item" href="#">
                                <i class="ti-email mr-0-5"></i> Inbox
                            </a> -->
                            <a class="dropdown-item" href="#">
                                <i class="ti-user mr-0-5"></i> Profile
                            </a>
                            <a class="dropdown-item" href="{{route('admin_logout')}}"><i
                                        class="ti-power-off mr-0-5"></i> Sign out</a>
                            <a class="dropdown-item text-warning" target="_blank" href="http://pglsystem.com/login">
                                <i class="ti-home mr-0-5"></i> Load old Admin
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
<!-- <script type="text/javascript" src="{{asset('assets/jquery/jquery-2.2.4.min.js')}}"> -->

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
<script type="text/javascript" src="{{asset('assets/TinyColor/tinycolor.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/sparkline/jquery.sparkline.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/raphael/raphael.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/morris/morris.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/jvectormap/jquery-jvectormap-2.0.3.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/jvectormap/jquery-jvectormap-world-mill.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/peity/jquery.peity.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/select2/dist/js/select2.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.html5.min.js"></script>
<!-- <script type="text/javascript" src="{{asset('assets/jquery-wizard/libs/formvalidation/formValidation.min.js')}}"></script>
		<script type="text/javascript" src="{{asset('assets/jquery-wizard/libs/formvalidation/bootstrap.min.js')}}"></script> -->

<!-- Neptune JS -->
<script type="text/javascript" src="{{asset('assets/js/app.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/demo.js')}}"></script>
<!-- <script type="text/javascript" src="{{asset('assets/js/forms-wizard.js')}}"></script> -->
<script type="text/javascript" src="{{asset('assets/js/index.js')}}"></script>

@yield('js')
<script type="text/javascript">
    var request = $.ajax({
        url: "{{route('veh_ship_inv_total_admin')}}",
        method: "GET",
        dataType: 'json'
    });
    request.done(function (msg) {
        $('.t_all_vehicle').text(msg.allvehicle);
        $('.t_on_the_way').text(msg.onthewayvehicle);
        $('.t_on_hand_no').text(msg.onhandnotitlevehicle);
        $('.t_on_hand_with').text(msg.onhandwithtitlevehicle);
        $('.t_shipped').text(msg.shippedvehicle);
        $('.t_pending').text(msg.pendingvehicle);

        $('.t_all_ship').text(msg.allshipment);
        $('.t_pending_ship').text(msg.pendingshipment);
        $('.t_loading_ship').text(msg.loadingshipment);
        $('.t_checked_ship').text(msg.checkedshipment);
        $('.t_finalchecked_ship').text(msg.finalcheckedshipment);
        $('.t_submitsi_ship').text(msg.submitsishipment);
        $('.t_on_the_way_ship').text(msg.onthewayshipment);
        $('.t_arrived_ship').text(msg.arrivedshipment);

        $('.t_all_inv').text(msg.allinvoice);
        $('.t_open_inv').text(msg.openinvoice);
        $('.t_past_due_inv').text(msg.pastdueinvoice);
        $('.t_paid_inv').text(msg.paidinvoice);
        $('.t_pending_inv').text(msg.pendinginvoice);

    });
    request.fail(function (jqXHR, textStatus) {
        alert('fail to load the total');
    });
    // get messages
    $('.message_admin').click(function () {
        $('.meessage_admin_detail').html("<div style='text-align:center'><img width='40px' src='img/loading.gif' alt='Loading ...'> </div>");
        var request = $.ajax({
            url: "{{route('message_admin')}}",
            method: "GET",
            dataType: 'json'
        });
        request.done(function (msg) {
            $('.meessage_admin_detail').html(msg);
        });
        request.fail(function (jqXHR, textStatus) {
            $('.meessage_admin_detail').html('');
            alert(textStatus);
        });
    });
</script>
<script>
    $(document).ready(function () {
        $('#example th').each(function (col) {
            $(this).hover(
                function () {
                    $(this).addClass('focus');
                },
                function () {
                    $(this).removeClass('focus');
                }
=======
	
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
		<link rel="stylesheet" href="{{asset('assets/select2/dist/css/select2.min.css')}}">

		<link rel="stylesheet" href="{{asset('assets/toastr/toastr.min.css')}}">

		<!-- style link for table -->
		<!-- <link rel="stylesheet" href="{{asset('assets/DataTables/css/dataTables.bootstrap4.min.css')}}">
		<link rel="stylesheet" href="{{asset('assets/DataTables/Responsive/css/responsive.bootstrap4.min.css')}}">
		<link rel="stylesheet" href="{{asset('assets/DataTables/Buttons/css/buttons.dataTables.min.css')}}">
		<link rel="stylesheet" href="{{asset('assets/DataTables/Buttons/css/bu ttons.bootstrap4.min.css')}}"> -->
		<!-- Neptune CSS -->
		<link rel="stylesheet" href="{{asset('assets/css/core.css')}}">
		<style type="text/css">
			.search_reload:hover{
				cursor: pointer;
				font-weight: bold;
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
							<a href="{{route('dashboard_admin')}}" class="waves-effect  waves-light">
								<span class="s-icon"><i class="fa fa-home"></i></span>
								<span class="s-text">Dashboard</span>
							</a>
						</li>
				
						 @if(Auth::guard('admin')->user()->hasPermissions(['Admin','customer-management']))
						<li>
							<a href="{{route('company_admin')}}" class="waves-effect  waves-light">
								<span class="s-icon"><i class="ti-layout-tab"></i></span>
								<span class="s-text">Company </span>
							</a>
						</li>
						@endif
						@if(Auth::guard('admin')->user()->hasPermissions(['Admin','customer-management']))
						<li>
							<a href="{{route('customer_admin')}}" class="waves-effect  waves-light">
								<span class="s-icon"><i class="fa fa-users"></i></span>
								<span class="s-text">Customer </span>
							</a>
						</li>
						@endif
						@if(Auth::guard('admin')->user()->hasPermissions(['Admin','vehicles-management']))
						<li class="with-sub">
							<a href="#" class="waves-effect  waves-light vehicles">
								<span class="s-caret"><i class="fa fa-angle-down"></i></span>
								<span class="tag tag-purple t_all_vehicle">0</span>
								<span class="s-icon"><i class="fa fa-car"></i></span>
								<span class="s-text">Vehicles</span>
							</a>
							<ul>
								@if(Auth::guard('admin')->user()->hasPermissions(['Admin','add-vehicles']))
								<li>
									<a href="{{url('add_vehicle')}}">Add new</a>
								</li>
								@endif
								<li>
									<a href="{{route('tow_cost_report_admin')}}" class="waves-effect  waves-light">
										<span class="s-text">Tow Cost Report</span>
									</a>
								</li>
								<li>
									<a href="{{route('all_vehicle_admin')}}">All 
								<span class="tag tag-warning t_all_vehicle" style="float:right;">0</span> 
								</a>
								</li>
								<li><a href="{{route('on_theway_vehicle_admin')}}" id="on_the_way">On the way <span class="tag tag-warning t_on_the_way" style="float:right;">0</span></a>
								</li>
								<li><a href="{{route('pending_vehicle_admin')}}" id="pending">Pending <span class="tag tag-warning t_pending" style="float:right;">0</span></a>
								</li>
								<li><a href="{{route('onhand_notitle_vehicle_admin')}}" id="on_hand_no">On hand no/title <span class="tag tag-warning t_on_hand_no" style="float:right;">0</span></a>
								</li>
								<li><a href="{{route('onhand_withtitle_vehicle_admin')}}" id="on_hand_with">On hand with/title <span class="tag tag-warning t_on_hand_with" style="float:right;">0</span></a></li>
								<li><a href="{{route('shipped_vehicle_admin')}}" id="shipped">Shipped <span class="tag tag-warning t_shipped" style="float:right;">0</span></a>
								</li>
								<li><a href="{{route('vehicle_cost_analysis_admin')}}">Cost anlysis</a>
								</li>
								<li><a href="{{route('dateline_vehicle_admin')}}">Datelines</a>
								</li>
								<li>
									<a href="{{url('vehicle_summary')}}">Summary</a>
								</li>
							</ul>
						</li>
						@endif
						@if(Auth::guard('admin')->user()->hasPermissions(['Admin','shipment-management']))
						<li class="with-sub">
							<a href="#" class="waves-effect  waves-light">
								<span class="s-caret"><i class="fa fa-angle-down"></i></span>
								<span class="tag tag-danger t_all_ship">0</span>
								<span class="s-icon"><i class="ti-package"></i></span>
								<span class="s-text">Shipments</span>
							</a>
							<ul>
								@if(Auth::guard('admin')->user()->hasPermissions(['Admin','add-shipment']))
								<li>
									<a href="{{url('add_shipment')}}">Add new</a>
								</li>
								@endif
								<li><a href="{{route('shipment_admin',['10','10'])}}">All <span class="tag tag-warning t_all_ship" style="float:right;">0</span></a></li>
								<li><a href="{{route('shipment_admin',['3','10'])}}">Pending <span class="tag tag-warning t_pending_ship" style="float:right;">0</span></a></li>
								<li class="with-sub">
									<a href="#" class="waves-effect  waves-light">
										<span class="tag tag-warning t_loading_ship" style="float:right; border-radius: 3px;"></span>
										<span class="s-icon"><i class="fa fa-circle-o"></i></span>
										<span class="s-text">At loading</span>
									</a>
									<ul>
										<li><a href="{{route('shipment_admin',['0','10'])}}">All <span class="tag tag-info t_loading_ship" style="float:right;">0</span></a>
										</li>
									<?php $location=DB::table('locations')->get(); ?>
						                @foreach($location as $loca)
						                <li><a href="{{route('shipment_admin',['0',$loca->location])}}">{{$loca->location}}<span class="tag tag-info" style="float:right;">
						                  @if($loca->location=='Savannah, GA')
						                     {{DB::table('containers')->where('status',0)->where('port_loading','like', '%'.'Savannah'.'%')->count()}}</span></a>
						                  @else
						                  {{DB::table('containers')->where('status',0)->where('port_loading','like', '%'.$loca->location.'%')->count()}}</span></a>
						                  @endif
						                </li>
						                @endforeach
									</ul>
								</li>

								<li class="with-sub">
									<a href="#" class="waves-effect  waves-light">
										<span class="tag tag-warning t_checked_ship" style="float:right; border-radius: 3px;">0</span>
										<span class="s-icon"><i class="fa fa-circle-o"></i></span>
										<span class="s-text">Checked</span>
									</a>
									<ul>
										<li><a href="{{route('shipment_admin',['4','10'])}}">All 
											<span class="tag tag-info t_checked_ship" style="float:right;">0</span></a>
										</li>
									<?php $location=DB::table('locations')->get(); ?>
						                @foreach($location as $loca)
						                <li><a href="{{route('shipment_admin',['4',$loca->location])}}">{{$loca->location}}<span class="tag tag-info" style="float:right;">
						                  @if($loca->location=='Savannah, GA')
						                     {{DB::table('containers')->where('status',4)->where('port_loading','like', '%'.'Savannah'.'%')->count()}}</span></a>
						                  @else
						                  {{DB::table('containers')->where('status',4)->where('port_loading','like', '%'.$loca->location.'%')->count()}}</span></a>
						                  @endif
						                </li>
						                @endforeach
										<li><a href="{{route('shipment_admin',['5','10'])}}">Final checked
											<span class="tag tag-info t_finalchecked_ship" style="float:right;">0</span>
										 </a>
									   </li>
									</ul>
								</li>
								<li><a href="{{route('shipment_admin',['9','10'])}}">Submit Si <span class="tag tag-warning t_submitsi_ship" style="float:right;">0</span></a>
								</li>
								<li><a href="{{route('shipment_admin',['1','10'])}}">On the way <span class="tag tag-warning t_on_the_way_ship" style="float:right;">0</span> </a></li>
								<li><a href="{{route('shipment_admin',['2','10'])}}">Arrived <span class="tag tag-warning t_arrived_ship" style="float:right;">0</span></a>
								</li>
								<li>
				                	<a href="{{route('archive_shipment_admin')}}">Title Archive
				                		<span class="tag tag-warning t_archive_ship" style="float:right;">0</span>
				                	</a>
								</li>
								<li>
									<a href="{{route('shipment_summary')}}">Summary</a>
								</li>
							</ul>
						</li>
						@endif
						@if(Auth::guard('admin')->user()->hasPermissions(['Admin','invoices-management']))
						<li class="with-sub">
							<a href="#" class="waves-effect  waves-light">
								<span class="s-caret"><i class="fa fa-angle-down"></i></span>
								<span class="tag tag-success t_all_inv">0</span>
								<span class="s-icon"><i class="ti-gallery"></i></span>
								<span class="s-text">Invoices</span>
							</a>
							<ul>
								@if(Auth::guard('admin')->user()->hasPermissions(['Admin','add-invoice']))
								<li>
									<a href="{{route('add_invoice_admin')}}">Add new</a>
								</li>
								@endif
								<li><a href="{{route('invoice_admin','5')}}">All
								<span class="tag tag-warning t_all_inv" style="float:right;">0</span>
								</a></li>
								<li><a href="{{route('invoice_admin','4')}}">Pending
									<span class="tag tag-warning t_pending_inv" style="float:right;">0</span></a>
							   </li>
								<li><a href="{{route('invoice_admin','0')}}">Open
								<span class="tag tag-warning t_open_inv" style="float:right;">0</span>
								</a></li>
								<li><a href="{{route('invoice_admin','2')}}">Past Due
								<span class="tag tag-warning t_past_due_inv" style="float:right;">0</span>
								</a></li>
								<li><a href="{{route('invoice_admin','3')}}">Paid 
								<span class="tag tag-warning t_paid_inv" style="float:right;">0</span>
								</a></li>
							</ul>
						</li>
						@endif
						@if(Auth::guard('admin')->user()->hasPermissions(['Admin','rates-management']))
						<li class="with-sub">
							<a href="#" class="waves-effect  waves-light">
								<span class="s-caret"><i class="fa fa-angle-down"></i></span>
								<span class="s-icon"><i class="ti-email"></i></span>
								<span class="s-text">Rates</span>
							</a>
							<ul>
								<li><a href="{{route('shipping_rate_admin')}}">Shipping Rates</a></li>
								<li><a href="{{route('towing_rate_admin')}}">Towing Rates</a></li>
							</ul>
						</li>
						@endif
						@if(Auth::guard('admin')->user()->hasPermissions(['Admin','setting']))
						<li class="with-sub">
							<a href="#" class="waves-effect  waves-light">
								<span class="s-caret"><i class="fa fa-angle-down"></i></span>
								<span class="s-icon"><i class="fa fa-cog"></i></span>
								<span class="s-text">Setting</span>
							</a>
							<ul>
								<li><a href="{{route('location_admin')}}">Locations</a></li>
								<li><a href="{{route('status_admin')}}">Status</a></li>
							</ul>
						</li>
						@endif
						@if(Auth::guard('admin')->user()->hasPermissions(['Admin','report-center']))
						<li class="with-sub">
							<a href="#" class="waves-effect  waves-light">
								<span class="s-caret"><i class="fa fa-angle-down"></i></span>
								<span class="s-icon"><i class="ti-bar-chart-alt"></i></span>
								<span class="s-text">Report center</span>
							</a>
							<ul>
								<li><a href="#">Customer report</a></li>
								<li><a href="#">Vehicle report</a></li>
								<li><a href="#">Shipment report</a></li>
								<li><a href="#">Invoice report</a></li>
							</ul>
						</li>
						@endif
						@if(Auth::guard('admin')->user()->hasPermissions(['Admin','company-management']))
						<li>
							<a href="{{route('pgl_profile')}}" class="waves-effect  waves-light">
								<span class="s-icon"><i class="ti-calendar"></i></span>
								<span class="s-text">PGL Profile</span>
							</a>
						</li>
						@endif
						@if(Auth::guard('admin')->user()->hasPermissions(['Admin','user-management']))
						<li class="with-sub">
							<a href="{{route('user_admin')}}" class="waves-effect  waves-light">
								<span class="s-icon"><i class="fa fa-users"></i></span>
								<span class="s-text">User</span>
							</a>
						</li>
						@endif
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
								<span class="text-warning">{{Auth::guard('admin')->user()->username}}</span>
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
					<div class="navbar-right bg-info navbar-toggleable-sm collapse" id="collapse-1">
						<div class="toggle-button light sidebar-toggle-second float-xs-left hidden-sm-down">
							<span class="hamburger"></span>
						</div>
						<ul class="nav navbar-nav float-md-right">
							<li class="nav-item dropdown">
								<a class="nav-link" href="#" data-toggle="dropdown" aria-expanded="false">
									<i class="ti-email message_admin"></i>
									<span class="hidden-md-up ml-1">Notifications</span>
									<span class="tag tag-danger top count_message_admin"><?=DB::table('notifications')
								        ->where(['customer_id'=>Auth::guard('admin')->id(),'type'=>1,'status'=>0])->count();
							        ?></span>
								</a>
								<div class="dropdown-messages dropdown-tasks dropdown-menu dropdown-menu-right animated fadeInUp meessage_admin_detail">
									<div class="m-item">
										<div class="mi-icon bg-info meessage_admin_detail"><i class="ti-comment"></i></div>
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
										<img src="{{ url('profile.customer',Auth::guard('admin')->user()->photo)}}" onerror="this.src='{{asset('img/avatars/profile.png')}}'"/>
									</span>
								</a>
								<div class="dropdown-menu dropdown-menu-right animated fadeInUp">
									<!-- <a class="dropdown-item" href="#">
										<i class="ti-email mr-0-5"></i> Inbox
									</a> -->
									<a class="dropdown-item" href="#">
										<i class="ti-user mr-0-5"></i> Profile 
									</a>
									<a class="dropdown-item" href="{{route('admin_logout')}}"><i class="ti-power-off mr-0-5"></i> Sign out</a>
									<a class="dropdown-item text-warning" target="_blank" href="http://pglsystem.com/login">
										<i class="ti-home mr-0-5"></i> Load old Admin
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
		<!-- <script type="text/javascript" src="{{asset('assets/jquery/jquery-2.2.4.min.js')}}"> -->
		</script>
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
		<script type="text/javascript" src="{{asset('assets/TinyColor/tinycolor.js')}}"></script>
		<script type="text/javascript" src="{{asset('assets/sparkline/jquery.sparkline.min.js')}}"></script>
		<script type="text/javascript" src="{{asset('assets/raphael/raphael.min.js')}}"></script>
		<script type="text/javascript" src="{{asset('assets/morris/morris.min.js')}}"></script>
		<script type="text/javascript" src="{{asset('assets/jvectormap/jquery-jvectormap-2.0.3.min.js')}}"></script>
		<script type="text/javascript" src="{{asset('assets/jvectormap/jquery-jvectormap-world-mill.js')}}"></script>
		<script type="text/javascript" src="{{asset('assets/peity/jquery.peity.js')}}"></script>
		<script type="text/javascript" src="{{asset('assets/select2/dist/js/select2.min.js')}}"></script>

		<!-- <script type="text/javascript" src="{{asset('assets/jquery-wizard/libs/formvalidation/formValidation.min.js')}}"></script>
		<script type="text/javascript" src="{{asset('assets/jquery-wizard/libs/formvalidation/bootstrap.min.js')}}"></script> -->

		<!-- Neptune JS -->
		<script type="text/javascript" src="{{asset('assets/js/app.js')}}"></script>
		<script type="text/javascript" src="{{asset('assets/js/demo.js')}}"></script>
		<!-- <script type="text/javascript" src="{{asset('assets/js/forms-wizard.js')}}"></script> -->
		<script type="text/javascript" src="{{asset('assets/js/index.js')}}"></script>

		@yield('js')
		<script type="text/javascript">
				var request = $.ajax({
	              url: "{{route('veh_ship_inv_total_admin')}}",
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
	            	$('.t_pending_ship').text(msg.pendingshipment);
	            	$('.t_loading_ship').text(msg.loadingshipment);
	            	$('.t_checked_ship').text(msg.checkedshipment);
	            	$('.t_finalchecked_ship').text(msg.finalcheckedshipment);
	            	$('.t_submitsi_ship').text(msg.submitsishipment);
	            	$('.t_on_the_way_ship').text(msg.onthewayshipment);
	            	$('.t_arrived_ship').text(msg.arrivedshipment);
	            	$('.t_archive_ship').text(msg.titlearchiveshipment);


	            	$('.t_all_inv').text(msg.allinvoice);
	            	$('.t_open_inv').text(msg.openinvoice);
	            	$('.t_past_due_inv').text(msg.pastdueinvoice);
	            	$('.t_paid_inv').text(msg.paidinvoice);
	            	$('.t_pending_inv').text(msg.pendinginvoice);
	                
	            });
	            request.fail(function( jqXHR, textStatus ) {
	            	alert('fail to load the total');
	            });
	            // get messages
	            $('.message_admin').click(function(){
	            	$('.meessage_admin_detail').html("<div style='text-align:center'><img width='40px' src='img/loading.gif' alt='Loading ...'> </div>");  
		            var request = $.ajax({
		              url: "{{route('message_admin')}}",
		              method: "GET",
		              dataType:'json'
		            }); 
		            request.done(function( msg) {
		            	$('.meessage_admin_detail').html(msg);
		            });
		            request.fail(function( jqXHR, textStatus ) {
		            	$('.meessage_admin_detail').html('');
		            	alert(textStatus);
		            });
	           });
		</script>
		<script>
			$(document).ready(function(){
				$('#user_data th').each(function (col) {
            $(this).hover(
                    function () {
                        $(this).addClass('focus');
                    },
                    function () {
                        $(this).removeClass('focus');
                    }
>>>>>>> parent of affd84d (Cleared the repo)
            );
            $(this).click(function () {
                if ($(this).is('.asc')) {
                    $(this).removeClass('asc');
                    $(this).addClass('desc selected');
                    sortOrder = -1;
                } else {
                    $(this).addClass('asc selected');
                    $(this).removeClass('desc');
                    sortOrder = 1;
                }
                $(this).siblings().removeClass('asc selected');
                $(this).siblings().removeClass('desc selected');
                var arrData = $('table').find('tbody >tr:has(td)').get();
                arrData.sort(function (a, b) {
                    var val1 = $(a).children('td').eq(col).text().toUpperCase();
                    var val2 = $(b).children('td').eq(col).text().toUpperCase();
                    if ($.isNumeric(val1) && $.isNumeric(val2))
                        return sortOrder == 1 ? val1 - val2 : val2 - val1;
                    else
                        return (val1 < val2) ? -sortOrder : (val1 > val2) ? sortOrder : 0;
                });
                $.each(arrData, function (index, row) {
                    $('tbody').append(row);
                });
            });
        });
<<<<<<< HEAD
        $('.excel').click(function () {
            $("#example").tableHTMLExport({
                type: 'csv',
                filename: 'sample.csv',
                separator: ',',
                newline: '\r\n',
                trimContent: true,
                quoteFields: true,
                ignoreColumns: '.column',
                ignoreRows: '.bottom',
                htmlContent: false,
                consoleLog: false,
            });
        });

    });
</script>
<script>
    function onlyDotsAndNumbers(txt, event) {
        var charCode = (event.which) ? event.which : event.keyCode
        if (charCode == 46) {
            if (txt.value.indexOf(".") < 0)
                return true;
            else
                return false;
        }

        if (txt.value.indexOf(".") > 0) {
            var txtlen = txt.value.length;
            var dotpos = txt.value.indexOf(".");
            //Change the number here to allow more decimal points than 2
            if ((txtlen - dotpos) > 2)
                return false;
        }

        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

        return true;
    }

    $(document).ready(function() {
     //   $('.select2search').select2();
        $('.select2search').select2({
            width: 'element',
            tags: true,
        });
    });
    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        changeSelect()
    })

    // Select2
    function changeSelect() {
        $("select.select2search").select2({
            tags: true
        })
    }
</script>
<style>
    .form-group > .select2-container {
        width: 100% !important;
    }
</style>
</body>
</html>
=======
	       $('.excel').click(function(){
		       $("#example").tableHTMLExport({
				  type:'csv',
				  filename:'Excel_sheet.csv',
				  separator: ',',
				  newline: '\r\n',
				  trimContent: true,
				  quoteFields: true,
				  ignoreColumns: '.column',
				  ignoreRows: '.bottom',
				  htmlContent: false,
				  consoleLog:false,
				});
	       });

		});
		</script>
	</body>
</html>
>>>>>>> parent of affd84d (Cleared the repo)
