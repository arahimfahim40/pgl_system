@extends('admin.layout.main')
@section('title','Vehicle Summary')
@section('style')
<style type="text/css">
	td, th{
		text-align: center;
	}
</style>
@stop
@section('content')
<div class="site-content">
  <div class="content-area py-1">
	<div class="container-fluid"> 
		<div class=" bg-white table-responsive">
			<div class="form-group col-md-3 col-lg-3 col-sm-6 col-xs-12" style="margin:1%">
			 <select class="form-control" id="status" name="status">
                <option value="3">All</option>
                <option value="1">4 Category Vehicles</option>
            </select>
		   </div>
		   <div class="form-group col-md-2 col-lg-2 col-sm-4 col-xs-12" style="margin:1%;float: right;">
		   		<select class="form-control" id="showEntry" name="location_id">
		   			<option value="8">All</option>
		   			 @foreach($locations as $locat)
                    <option value="{{$locat->id}}" <?php if($location==$locat->id) echo "selected" ?>>
                    	{{$locat->location}}
                    </option>
                    @endforeach
		   		</select>
		   </div>
		    <div class="col-md-2 col-lg-2 col-sm-6 col-xs-12 text-right" style="margin-top:1.5%;float: right;text-align: right;">
		   	<a href="#" class="text text-warning"><b>Vehicles Summary</b></a>
		   </div>
	<div class="site" id="user_data">
		@include('admin.vehicle.vehicle_summary_data')
	</div>
</div>
@stop
@section('js')
<script type="text/javascript"> 
	$(document).ready(function(){
       	// show location base summary
       $('#showEntry').change(function(){
       		$('#searchBody').html("<div style='position:fixed; margin-top:7%; margin-left:40%;'><img width='70px' src= '"+"{{asset('img/loading.gif')}}"+"' alt='Loading ...'> </div> ");
       	    var data = $(this).val();
       		var request = $.ajax({
	              url: "{{route('vehicle_summary')}}",
	              method: "GET",
	              data: {location_id:data},
	            }); 
	            request.done(function( msg ) {
	                $('#user_data').html(msg);
	            });
	            request.fail(function( jqXHR, textStatus ) {
	            	$('#user_data').append(textStatus);
	          });
       });

       // search base status 
       $('#status').change(function(){
            $('#searchBody').html("<div style='position:fixed; margin-top:7%; margin-left:40%;'><img width='70px' src= '"+"{{asset('img/loading.gif')}}"+"' alt='Loading ...'> </div> ");
            var data = $(this).val();
            var request = $.ajax({
                  url: "{{route('vehicle_summary')}}",
                  method: "GET",
                  data: {status:data},
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
