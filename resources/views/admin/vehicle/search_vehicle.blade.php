@extends('customer.layout.main')
@section('title','Search Vehicles')
@section('content')
<div class="site-content">
  <div class="content-area py-1">
	<div class="container-fluid"> 
		<div class=" bg-white table-responsive">
			<div class="form-group col-md-3 col-lg-3 col-sm-6 col-xs-12" style="margin:1%">
			 <div class="input-group">
    			<span class="input-group-addon"><i class="ti ti-reload text text-warning search_reload"></i></span>
    			<input type="text" name="search" class="form-control b-a" placeholder="Search for ..." id="search">
  			</div>
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
		   <div>
		   <!-- <a href="{{route('vehicle_excel_customer')}}" class="btn" style="margin:1%"><i class="fa fa-file-excel-o"> &nbsp;Excel</i></a> -->
		 </div>
		   <!-- <table class="table table-2" id="user_data"> -->
				<div class="site" id="user_data">
					@include('customer.vehicle.all_vehicles_data')
				</div>
	<!-- modal  -->
	<div class="modal fade in" id="addnotemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" >
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close closemodal" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
					<h4 class="modal-title" id="exampleModalLabel">Add Note</h4>
				</div>
				<div class="modal-body">
					<div id="noteLoading"> </div>
					<form>
						<div class="form-group">
							<input type="hidden" name="vehicle_id" class="form-control" id="vehicle_id">
						</div>
						<div class="form-group">
							<label for="message-text" class="form-control-label">Message:</label>
							<textarea class="form-control" id="note" name="note" rows="5"></textarea>
						</div>
					</form>
				</div>
				<div class="modal-footer" style="text-align:center;">
					<button type="button" class="btn btn-secondary closemodal" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary" id="addnoteBtn">Submit</button>
				</div>
			</div>
		</div>
	</div>
	<!-- end of modal  -->
</div>
@stop
@section('js')
<script type="text/javascript">
	$(document).ready(function(){
		
		// pagination section
	   	$(document).on('click','.agination a',function(e){
	   		e.preventDefault();
	   		var page = $(this).attr('href').split('page=')[1];
	   		getMoreVehicle(page);
	   		});

	   	$('.search_reload').click(function(){
	   		getMoreVehicle(1);
	   	});

	   	 function getMoreVehicle(page){
	      	  $('#searchBody').html("<div style='position:fixed; margin-top:7%; margin-left:40%;'><img width='70px' src= '"+"{{asset('img/loading.gif')}}"+"' alt='Loading ...'> </div> ");
		       var request = $.ajax({
	              url: "{{route('paginate_entry_vehicle_base_location_and_status_customer')}}" +'?page='+page,
	              method: "GET",
	              data: {paginate:$("#showEntry").val()},
	            }); 
	            request.done(function( msg ) {
	            	$('#user_data').html('');
	              $('#user_data').html(msg);
	            });
	            request.fail(function( jqXHR, textStatus ) {
	            	$('#user_data').html(textStatus);
	            });
	          }

       // search section 
       $('#search').on('keyup',function(e){
	   		var searchData = $(this).val();
	   		 searchVehicle(searchData);
	   	 function searchVehicle(searchData){
	      	   $('#searchBody').html("<div style='position:fixed; margin-top:7%; margin-left:40%;'><img width='70px' src= '"+"{{asset('img/loading.gif')}}"+"' alt='Loading ...'> </div> ");
		       var request = $.ajax({
	              url: "{{route('vehicle_base_location_and_status_search_customer')}}",
	              method: "GET",
	              data: {searchValue:searchData,status:"{{$veh_status}}",location_id:"{{$veh_location}}"},
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
       		 $('#searchBody').html("<div style='position:fixed; margin-top:7%; margin-left:40%;'><img width='70px' src= '"+"{{asset('img/loading.gif')}}"+"' alt='Loading ...'> </div> ");
       	 var data = $(this).val();
       		var request = $.ajax({
	              url: "{{route('paginate_entry_vehicle_base_location_and_status_customer')}}",
	              method: "GET",
	              data: {paginate:data,status:"{{$veh_status}}",location_id:"{{$veh_location}}"},
	            }); 
	            request.done(function( msg ) {
	                $('#user_data').html(msg);
	            });
	            request.fail(function( jqXHR, textStatus ) {
	            	$('#user_data').append(textStatus);
	          });
       });

       
        // show modal
       $('a.addnote').click(function(){
       	$('#addnotemodal').show();
       	var id =$(this).attr('id');
       	$("input#vehicle_id").val(id);
       });

       // hide modal
       $('.closemodal').click(function(){
       	$('#addnotemodal').modal('hide')
       });

       // add note section
       $('#addnoteBtn').click(function(){
       	$('#noteloading').html("<div style='position:fixed; margin-top:3%; margin-left:40%;'><img width='50px' src='img/loading.gif' alt='Loading ...'> </div>");
       	var vehid=$("input#vehicle_id").val();
       	var note = $("#note").val();
       var request = $.ajax({
            url: "{{route('addnote_for_vehicle_customer')}}",
            method: "GET",
            data: {vehicle_id:$("input#vehicle_id").val(),note:$("#note").val()},
          }); 
          request.done(function( msg ) {
          		$('div#noteloading').html("");
          		$("#note").val(' ');
              $('#addnotemodal').modal('hide');
              $('a#'+vehid).text(note);
          });
          request.fail(function( jqXHR, textStatus ) {
          	$('#noteloading').html("");
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

