@extends('admin.layout.main')
@section('title','All Vehicles')
<!-- <link rel="stylesheet" href="{{asset('assets/toast/jquery.toast.css')}}"> -->
@section('content')
<<<<<<< HEAD
=======
<style type="text/css">
	a .active{
		background-color: blue;
	}
	
</style>
>>>>>>> parent of affd84d (Cleared the repo)
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
		   <div class="form-group col-md-2 col-lg-2 col-sm-3 col-xs-6" style="margin:1%">
				<button type="button" class="excel btn btn-outline-warning mb-0-25 waves-effect waves-light">
					<i class="fa fa-file-excel-o"></i>
				</button>
		   </div>
		   <div class="form-group col-md-2 col-lg-2 col-sm-3 col-xs-6" style="margin:1%">
			 <!-- <button class="btn btn-info pdf">PDF</button> -->
		   </div>
		   <div class="form-group col-md-1 col-lg-1 col-sm-2 col-xs-12" style="margin:1%;float: right;">
<<<<<<< HEAD
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
=======
		   	<form action="{{route('all_vehicle_admin')}}" id="showEntryForm">
		   		<select class="form-control" id="showEntry" name="paginate">
		   			<option value="20"<?php if($paginate=='20') echo "selected"; ?>>20</option>
		   			<option value="50"<?php if($paginate=='50') echo "selected"; ?>>50</option>
		   			<option value="100"<?php if($paginate=='100') echo "selected"; ?>>100</option>
		   			<option value="150"<?php if($paginate=='150') echo "selected"; ?>>150</option>
		   			<option value="200"<?php if($paginate=='200') echo "selected"; ?>>200</option>
		   			<option value="300"<?php if($paginate=='300') echo "selected"; ?>>300</option>
		   			<option value="500"<?php if($paginate=='500') echo "selected"; ?>>500</option>
		   			<option value="9000000" <?php if($paginate=='All') echo "selected"; ?>>All</option>
		   		</select>
		   		</form>
>>>>>>> parent of affd84d (Cleared the repo)
		   </div>
		   <div>
		   	<div class="col-md-2 col-lg-2 col-sm-6 col-xs-12 text-right" style="margin-top:1.5%;float: right;text-align: right;">
		   	<a href="#" class="text text-warning"><b>All Vehicles</b></a>
		   </div>
		   <!-- <a href="{{route('vehicle_excel_customer')}}" class="btn" style="margin:1%"><i class="fa fa-file-excel-o"> &nbsp;Excel</i></a> -->
		 </div>
		   <!-- <table class="table table-2" id="user_data"> -->
<<<<<<< HEAD
				<div class="site" id="user_data">
					@include('admin.vehicle.all_vehicles_data')
				</div>
=======
		   	<div id="user_data">
			
					@include('admin.vehicle.all_vehicles_data')
		</div>
	</div>
</div>
>>>>>>> parent of affd84d (Cleared the repo)
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
<script type="text/javascript" src="{{asset('assets/toast/jquery.toast.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>  
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.6/jspdf.plugin.autotable.min.js"></script>  
<script type="text/javascript">
	$(document).ready(function(){
		// pagination section
<<<<<<< HEAD
	   	$(document).on('click','.pagination a',function(e){
=======
	   	$(document).on('click','.pgination a',function(e){
>>>>>>> parent of affd84d (Cleared the repo)
	   		e.preventDefault();
	   		var page = $(this).attr('href').split('page=')[1];
	   		getMoreVehicle(page);
        });
	   	$('.search_reload').click(function(){
<<<<<<< HEAD
	   		getMoreVehicle(1);
=======
	   		// getMoreVehicle(1);
	   		window.location.href="{{route('all_vehicle_admin')}}";
>>>>>>> parent of affd84d (Cleared the repo)
	   	});
	   	function getMoreVehicle(page){
	      	  $('#searchBody').html("<div style='position:fixed; margin-top:7%; margin-left:40%;'><img width='70px' src='img/loading.gif' alt='Loading ...'> </div> ");
		       var request = $.ajax({
	              url: "{{route('paginate_all_vehicle_admin')}}" +'?page='+page,
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

       	// show entry section
       $('#showEntry').change(function(){
       		 $('#searchBody').html("<div style='position:fixed; margin-top:7%; margin-left:40%;'><img width='70px' src='img/loading.gif' alt='Loading ...'> </div> ");
       	 var data = $(this).val();
<<<<<<< HEAD
       		var request = $.ajax({
	              url: "{{route('paginate_entry_all_vehicle_admin')}}",
	              method: "GET",
	              data: {paginate:data},
	            }); 
	            request.done(function( msg ) {
	                $('#user_data').html(msg);
	            });
	            request.fail(function( jqXHR, textStatus ) {
	            	$('#user_data').append(textStatus);
	          });
=======
       	 $('#showEntryForm').submit();
       		// var request = $.ajax({
	        //       url: "{{route('paginate_entry_all_vehicle_admin')}}",
	        //       method: "GET",
	        //       data: {paginate:data},
	        //     }); 
	        //     request.done(function( msg ) {
	        //         $('#user_data').html(msg);
	        //     });
	        //     request.fail(function( jqXHR, textStatus ) {
	        //     	$('#user_data').append(textStatus);
	        //   });
>>>>>>> parent of affd84d (Cleared the repo)
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
            url: "{{url('addnote_for_vehicle_admin')}}",
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
       // show toast
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

