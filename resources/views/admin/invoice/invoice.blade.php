@extends('admin.layout.main')
<<<<<<< HEAD
@section('title','Invoices')
=======
<?php $page_title='All invoices'; 
 	  if($status=='') $page_title="All invoices";
 		else if($status==0) $page_title="Open invoices";
 		else if($status==2) $page_title="Past Due invoices";
 		else if($status==3) $page_title="Paid invoices";
 		else if($status==4) $page_title="Pending invoices";
 	?>
@section('title',@$page_title)
>>>>>>> parent of affd84d (Cleared the repo)
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
		   @if($status !='' and $status !='4')
		   @if(Auth::guard('admin')->user()->hasPermissions(['Admin','add-status']))
		   <div class="form-group col-md-2 col-lg-2 col-sm-6 col-xs-12" style="margin:1%">
				<button type="button" class="btn btn-warning btn-rounded mb-0-25 waves-effect waves-light" data-toggle="modal" data-target="#change_status"><b><i class="fa fa-info-circle"></i></b> Change Status
				</button>
		   </div>
		  @endif
		  @endif
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
		   </div>
		   <div class="col-md-2 col-lg-2 col-sm-6 col-xs-12 text-right" style="margin-top:1.5%;float: right;text-align: right;">
		   		<?php $page_title='All invoices'; 
		   	  if($status=='') $page_title="All invoices";
		   		else if($status==0) $page_title="Open invoices";
		   		else if($status==2) $page_title="Past Due invoices";
		   		else if($status==3) $page_title="Paid invoices";
		   		else if($status==4) $page_title="Pending invoices";
		   		?>
=======
		   		<form action="{{route('invoice_admin',$status)}}" id="showEntryForm">
		   			<input type="hidden" name="status" value="{{$status}}">
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
		   </div>
		   <div class="col-md-2 col-lg-2 col-sm-6 col-xs-12 text-right" style="margin-top:1.5%;float: right;text-align: right;">
>>>>>>> parent of affd84d (Cleared the repo)
		   	<a href="#" class="text text-warning"><b>{{$page_title}}</b></a>
		   </div>
	<div class="site" id="user_data">
		@include('admin.invoice.invoice_data')
		@include('admin.invoice.change_status')
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
	   	$(document).on('click','.pagintion a',function(e){
>>>>>>> parent of affd84d (Cleared the repo)
	   		e.preventDefault();
	   		var page = $(this).attr('href').split('page=')[1];
	   		getMoreVehicle(page);
	   		});
	   	
	   	$('.search_reload').click(function(){
<<<<<<< HEAD
	   		getMoreVehicle(1);
=======
	   	  	window.location.href="{{route('invoice_admin',$status)}}";
>>>>>>> parent of affd84d (Cleared the repo)
	   	});

	   	 function getMoreVehicle(page){
	      	 $('#searchBody').html("<div style='position:fixed; margin-top:7%; margin-left:40%;'><img width='70px' src= '"+"{{asset('img/loading.gif')}}"+"' alt='Loading ...'> </div> ");
		       var request = $.ajax({
	              url: "{{route('paginate_invoice_admin')}}" +'?page='+page,
	              method: "GET",
	              data: {paginate:$("#showEntry").val(),status:"{{$status}}"},
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
	      	 $('#searchBody').html("<div style='position:fixed; margin-top:7%; margin-left:40%;'><img width='70px' src= '"+"{{asset('img/loading.gif')}}"+"' alt='Loading ...'> </div> ");
		       var request = $.ajax({
	              url: "{{route('search_invoice_admin')}}",
	              method: "GET",
	              data: {searchValue:searchData,status:"{{$status}}"},
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
<<<<<<< HEAD
       	 var data = $(this).val();
       		var request = $.ajax({
	              url: "{{route('paginate_invoice_admin')}}",
	              method: "GET",
	              data: {paginate:data,status:"{{$status}}"},
	            }); 
	            request.done(function( msg ) {
	                $('#user_data').html(msg);
	            });
	            request.fail(function( jqXHR, textStatus ) {
	            	$('#user_data').append(textStatus);
	          });
=======
       		$("#showEntryForm").submit();
       	 // var data = $(this).val();
       		// var request = $.ajax({
	        //       url: "{{route('paginate_invoice_admin')}}",
	        //       method: "GET",
	        //       data: {paginate:data,status:"{{$status}}"},
	        //     }); 
	        //     request.done(function( msg ) {
	        //         $('#user_data').html(msg);
	        //     });
	        //     request.fail(function( jqXHR, textStatus ) {
	        //     	$('#user_data').append(textStatus);
	        //   });
>>>>>>> parent of affd84d (Cleared the repo)
       });

       // change status section
       $('#check_all').on('click', function(e) {
			if($(this).is(':checked',true))  
			{
				$(".checkbox").prop('checked', true);  
			} else {  
				$(".checkbox").prop('checked',false);  
			}  
		});
		$('.checkbox').on('click',function(){
			if($('.checkbox:checked').length == $('.checkbox').length){
				$('#check_all').prop('checked',true);
			}else{
				$('#check_all').prop('checked',false);
			}
		});

		$('#change-all').on('click', function(e) {
			var idsArr = [];  
			$(".checkbox:checked").each(function() {  
				idsArr.push($(this).attr('data-id'));
			});
			var status= $(".inv_status:checked").val(); 
			if(status == null)
			{
				alert('Please select at least one status');return;
			}
			if(idsArr.length <=0)  
			{  
				alert("Please select atleast one record to change.");  
			}  else {  
				if(confirm("Are you sure, you want to change the selected invoice status ?")){  
					var strIds = idsArr.join(","); 
			$.ajax({
				url: "{{ route('change_status_invoice') }}",
				type: 'get',
				headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
				data: {'ids':strIds,'status':status},
				success: function (data) {
				if (data['status']==true) {
					$("#change_status").modal('hide');
					$(".checkbox:checked").each(function() {  
					$(this).parents("tr").remove();
					});
					alert(data['message']);
				} else {
					alert('Whoops Something went wrong!!');
				}
				},
				error: function (data) {
				alert(data.responseText);
				}
				});
			}  
		}  
		});
  

	});
</script>
@stop
