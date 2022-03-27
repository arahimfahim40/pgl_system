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
				<form action="{{route('vehicle_summary')}}" id="form_statu">
				 <select class="form-control" id="status" name="status">
	                <option value="3">All</option>
	                 <option value="1" <?php if(@$filter) echo "selected";?>>4 Category Vehicles</option>
	            </select>
            </form>
		   </div>
		   <div class="form-group col-md-2 col-lg-2 col-sm-4 col-xs-12" style="margin:1%;float: right;">
		   	 <form id="location_form" action="{{route('vehicle_summary')}}">
		   		<select class="form-control" id="showEntry" name="location_id">
		   			<option value="8">All</option>
		   			 @foreach($locations as $locat)
                    <option value="{{$locat->id}}" <?php if($location==$locat->id) echo "selected" ?>>
                    	{{$locat->location}}
                    </option>
                    @endforeach
		   		</select>
		   	 </form>
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

       		$('#location_form').submit();

       	 //    var data = $(this).val();
       		// var request = $.ajax({
	        //       url: "{{route('vehicle_summary')}}",
	        //       method: "GET",
	        //       data: {location_id:data},
	        //     }); 
	        //     request.done(function( msg ) {
	        //         $('#user_data').html(msg);
	        //     });
	        //     request.fail(function( jqXHR, textStatus ) {
	        //     	$('#user_data').append(textStatus);
	        //   });
       });

       // search base status 
       $('#status').change(function(){
            $('#searchBody').html("<div style='position:fixed; margin-top:7%; margin-left:40%;'><img width='70px' src= '"+"{{asset('img/loading.gif')}}"+"' alt='Loading ...'> </div> ");

             $('#form_statu').submit();
            // var data = $(this).val();
            // var request = $.ajax({
            //       url: "{{route('vehicle_summary')}}",
            //       method: "GET",
            //       data: {status:data},
            //     }); 
            //     request.done(function( msg ) {
            //         $('#user_data').html(msg);
            //     });
            //     request.fail(function( jqXHR, textStatus ) {
            //         $('#user_data').append(textStatus);
            //   });
       });


	});
</script>
@stop
