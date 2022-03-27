@extends('admin.layout.main')
@section('title','Shipped Vehicles')
@section('content')
<div class="site-content">
  <div class="content-area py-1">
	<div class="container-fluid"> 
		<div class=" bg-white table-responsive">
			<!-- <h5>Pending Vehicles</h5> -->
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
		   		<form action="{{route('shipped_vehicle_admin')}}" id="showEntryForm">
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
		    <div class="col-md-2 col-lg-2 col-sm-6 col-xs-12 text-right" style="margin-top:1.5%;float: right;text-align: right;">
		   	<a href="#" class="text text-warning"><b>Shipped Vehicles</b></a>
		   </div>
	<div class="site" id="user_data">
		@include('admin.vehicle.shipped_vehicles_data')
	</div>
</div>
@stop
@section('js')
<script type="text/javascript">
	$(document).ready(function(){
		// pagination section
<<<<<<< HEAD
	   	$(document).on('click','.pagination a',function(e){
=======
	   	$(document).on('click','.paginatin a',function(e){
>>>>>>> parent of affd84d (Cleared the repo)
	   		e.preventDefault();
	   		var page = $(this).attr('href').split('page=')[1];
	   		getMoreVehicle(page);
	   		});

	   	$('.search_reload').click(function(){
<<<<<<< HEAD
	   		getMoreVehicle(1);
=======
	   		window.location.href="{{route('shipped_vehicle_admin')}}";
>>>>>>> parent of affd84d (Cleared the repo)
	   	});
	   	 function getMoreVehicle(page){
	      	  $('#searchBody').html("<div style='position:fixed; margin-top:7%; margin-left:40%;'><img width='70px' src='img/loading.gif' alt='Loading ...'> </div> ");
		       var request = $.ajax({
	              url: "{{route('paginate_shipped_vehicle_admin')}}" +'?page='+page,
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
	              url: "{{route('search_shipped_vehicle_admin')}}",
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
<<<<<<< HEAD
       	 var data = $(this).val();
       		var request = $.ajax({
	              url: "{{route('paginate_entry_shipped_vehicle_admin')}}",
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

=======
       		 $("#showEntryForm").submit();
       	 // var data = $(this).val();
       		// var request = $.ajax({
	        //       url: "{{route('paginate_entry_shipped_vehicle_admin')}}",
	        //       method: "GET",
	        //       data: {paginate:data},
	        //     }); 
	        //     request.done(function( msg ) {
	        //         $('#user_data').html(msg);
	        //     });
	        //     request.fail(function( jqXHR, textStatus ) {
	        //     	$('#user_data').append(textStatus);
	        //   });
       });

>>>>>>> parent of affd84d (Cleared the repo)
	});
</script>
@stop
