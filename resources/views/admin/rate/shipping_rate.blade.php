@extends('admin.layout.main')
@section('title','Shipping Rate')
@section('content')
<div class="site-content">
  <div class="content-area py-1">
	<div class="container-fluid"> 
		<div class=" bg-white table-responsive">
			<div class="form-group col-md-3 col-lg-3 col-sm-6 col-xs-12" style="margin:1%">
			 <input type="text" name="search" class="form-control b-a" placeholder="Search for ..." id="search">
		   </div>
		   @if(Auth::guard('admin')->user()->hasPermissions(['Admin','add-ship-rate']))
		   <div class="form-group col-md-1 col-lg-1 col-sm-6 col-xs-12" style="margin:1%">
				<button type="button" class="btn btn-warning btn-rounded mb-0-25 waves-effect waves-light" data-toggle="modal" data-target="#add_shipping_rate"><b><i class="ti-plus"></i></b> Add
				</button>
		   </div>
		   @endif
		    <div class="form-group col-md-2 col-lg-2 col-sm-3 col-xs-6" style="margin:1%">
				<button type="button" class="excel btn btn-outline-warning mb-0-25 waves-effect waves-light">
					<i class="fa fa-file-excel-o"></i>
				</button>
		   </div>
		   <div class="form-group col-md-1 col-lg-1 col-sm-2 col-xs-12" style="margin:1%;float: right;">
		   		<select class="form-control" id="showEntry">
		   			<option value="20">20</option>
		   			<option value="50">50</option>
		   			<option value="100">100</option>
		   			<option value="150">150</option>
		   			<option value="200">200</option>
		   			<option value="300">300</option>
		   			<option value="500">500</option>
		   			<option value="9000000">All</option>
		   		</select>
		   </div>
		   <div class="col-md-2 col-lg-2 col-sm-6 col-xs-12 text-right" style="margin-top:1.5%;float: right;text-align: right;">
		   	<a href="#" class="text text-warning"><b>Shipping Rate</b></a>
		   </div>
	<div class="site" id="user_data">
		@include('admin.rate.shipping_rate_data')
	</div>
	 @include('admin.rate.add_shipping_rate')
</div>
@stop
@section('js')
<script type="text/javascript">
	$(document).ready(function(){
		// pagination section
	   	$(document).on('click','.pagination a',function(e){
	   		e.preventDefault();
	   		var page = $(this).attr('href').split('page=')[1];
	   		getMoreVehicle(page);

	   	 function getMoreVehicle(page){
	      	  $('#searchBody').html("<div style='position:fixed; margin-top:7%; margin-left:40%;'><img width='70px' src='img/loading.gif' alt='Loading ...'> </div> ");
		       var request = $.ajax({
	              url: "{{route('paginate_shipping_rate_admin')}}" +'?page='+page,
	              method: "GET",
	              data: {paginate:$("#showEntry").val()},
	            }); 
	            request.done(function( msg ) {
	              $('#user_data').html(msg);
	            });
	            request.fail(function( jqXHR, textStatus ) {
	            	$('#user_data').html(textStatus);
	            });
	          }
        });

       // search section 
       $('#search').on('keyup',function(e){
	   		var searchData = $(this).val();
	   		 searchVehicle(searchData);
	   	 function searchVehicle(searchData){
	      	  $('#searchBody').html("<div style='position:fixed; margin-top:7%; margin-left:40%;'><img width='70px' src='img/loading.gif' alt='Loading ...'> </div> ");
		       var request = $.ajax({
	              url: "{{route('search_shipping_rate_admin')}}",
	              method: "GET",
	              data: {searchValue:searchData},
	            }); 
	            request.done(function( msg ) {
	                $('#user_data').html(msg);
	            });
	            request.fail(function( jqXHR, textStatus ) {
	            	$('#user_data').append(textStatus);
	            });
	          }
        });

       	// show entry section
       $('#showEntry').change(function(){
       		 $('#searchBody').html("<div style='position:fixed; margin-top:7%; margin-left:40%;'><img width='70px' src='img/loading.gif' alt=' <b>Loading ... </b>'> </div> ");
       	 var data = $(this).val();
       		var request = $.ajax({
	              url: "{{route('paginate_shipping_rate_admin')}}",
	              method: "GET",
	              data: {paginate:data},
	            }); 
	            request.done(function( msg ) {
	                $('#user_data').html(msg);
	            });
	            request.fail(function( jqXHR, textStatus ) {
	            	$('#user_data').append(textStatus);
	          });
       });

	});
</script>
@stop
