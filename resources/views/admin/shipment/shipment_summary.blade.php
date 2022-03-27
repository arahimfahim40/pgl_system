@extends('admin.layout.main')
@section('title','Shipment Summary')
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
			 <input type="text" name="search" class="form-control b-a" placeholder="Search for ..." id="search">
		   </div>
		   <div class="form-group col-md-2 col-lg-2 col-sm-4 col-xs-12" style="margin:1%;float: right;">
		   		<select class="form-control" id="showEntry">
		   			<option value="All">All</option>
		   			 @foreach($locations as $location)
                    <option value="{{$location->location}}">
                    	{{$location->location}}
                    </option>
                    @endforeach
		   		</select>
		   </div>
           <div class="col-md-2 col-lg-2 col-sm-6 col-xs-12 text-right" style="margin-top:1.5%;float: right;text-align: right;">
            <a href="#" class="text text-warning"><b>Shipment Summary</b></a>
           </div>
	<div class="site" id="user_data">
		@include('admin.shipment.shipment_summary_data')
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
	              url: "{{route('shipment_summary')}}",
	              method: "GET",
	              data: {location:data},
	            }); 
	            request.done(function( msg ) {
	                $('#user_data').html(msg);
	            });
	            request.fail(function( jqXHR, textStatus ) {
	            	$('#user_data').append(textStatus);
	          });
       });

       // make sorable table 
       $('th').each(function (col) {
            $(this).hover(
                    function () {
                        $(this).addClass('focus');
                    },
                    function () {
                        $(this).removeClass('focus');
                    }
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


	});
</script>
@stop
