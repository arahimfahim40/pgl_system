@extends('admin.layout.main')
@section('title','Vehicles')
@section('content')
<div class="site-content">
  <div class="content-area py-1">
	<div class="container-fluid"> 
		<div class=" bg-white table-responsive">
			<div class="form-group col-md-3 col-lg-3 col-sm-6 col-xs-12" style="margin:1%">
			 <input type="text" name="search" class="form-control b-a" placeholder="Search for ..." id="search">
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
		   	<a href="#" class="text text-warning"><b>All Vehicles</b></a>
		   </div>
	<div class="site" id="user_data">
		@include('admin.vehicle.all_vehicles_data')
	</div>
</div>
@stop
@section('js')
<script type="text/javascript">
	$(document).ready(function(){
       // search section 
       $('#search').on('keyup',function(e){
	   		var searchData = $(this).val();
	   		if(searchData.length <=3){
	   			return false ;
	   		}
	   		 searchVehicle(searchData);
	   	 function searchVehicle(searchData){
	      	   $('#searchBody').html("<div style='position:fixed; margin-top:7%; margin-left:40%;'><img width='70px' src='img/loading.gif' alt='Loading ...'> </div> ");
		       var request = $.ajax({
	              url: "{{route('search_all_vehicle_admin')}}",
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
       $('.excel').click(function(){
	       $("#example").tableHTMLExport({
			  type:'csv',
			  filename:'sample.csv',
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

       if("{{@$deleted !='' }}"){
       	toast();
       }

       function toast(){
       	$.toast({
			  text :"Success",
			  position:'top-right',
			  bgColor:'#43b968',

			});	
       }
      
	});
</script>
@stop
