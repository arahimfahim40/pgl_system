@extends('admin.layout.main')
@section('title','Clear Log')
@section('content')
<div class="site-content">
  <div class="content-area py-1">
	<div class="container-fluid">
		<div class=" bg-white table-responsive">
{{--			<div class="form-group col-lg-1 col-sm-3 col-xs-4" style="margin:1%;">--}}
{{--				@foreach($createInvoice as $createInvoices)--}}
{{--					@if(($createInvoices['status'] == 1))--}}
{{--						<div class="form-group col-md-1 col-lg-1 col-sm-6 col-xs-12" style="margin:1%">--}}
{{--							<button type="button" class="btn btn-warning btn-rounded mb-0-25 waves-effect waves-light" data-toggle="modal" data-target="#change_invoice_status"><b><i class="fa fa-info-circle"></i></b> Change Status--}}
{{--							</button>--}}
{{--						</div>--}}
{{--					@endif--}}
{{--				@endforeach--}}
{{--			</div>--}}

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
	<div class="site" id="user_data">
		@include('admin.operation.create-invoice.invoice_table')
	</div>
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
	      	 $('#searchBody').html("<div style='position:fixed; margin-top:7%; margin-left:40%;'><img width='70px' src= '"+"{{asset('img/loading.gif')}}"+"' alt='Loading ...'> </div> ");
		       var request = $.ajax({
	              url: "{{route('paginate_clear_log_admin')}}" +'?page='+page,
	              method: "POST",
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
	   		 searchclearlog(searchData);
	   	 function searchclearlog(searchData){
	      	 $('#searchBody').html("<div style='position:fixed; margin-top:7%; margin-left:40%;'><img width='70px' src= '"+"{{asset('img/loading.gif')}}"+"' alt='Loading ...'> </div> ");
		       var request = $.ajax({
	              url: "{{route('search_clear_log')}}",
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
       		$('#searchBody').html("<div style='position:fixed; margin-top:7%; margin-left:40%;'><img width='70px' src= '"+"{{asset('img/loading.gif')}}"+"' alt='Loading ...'> </div> ");
       	 var data = $(this).val();
       		var request = $.ajax({
	              url: "{{route('paginate_clear_log_admin')}}",
	              method: "POST",
	              data: {paginate:data},
	            });
	            request.done(function( msg ) {
	                $('#user_data').html(msg);
	            });
	            request.fail(function( jqXHR, textStatus ) {
	            	$('#user_data').append(textStatus);
	          });
       });

       // make sortable table
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
						return sortOrder == 1 ? val2 - val3 : val3 - val2;
					else
						return (val2 < val3) ? -sortOrder : (val2 > val3) ? sortOrder : 0;
				});
				$.each(arrData, function (index, row) {
					$('tbody').append(row);
				});
			});
        });
	});
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

<script type="text/javascript">
				$(document).ready(function () {
					$(document).on("click", "#change_invoice_status", function (e) {
						var id = $(this).data("id");
						var token = $(this).data("token");
						swal.fire({
							title: "Change Status",
							text: "Are You Sure Want to Change the Status?",
							type: "warning",
							showCancelButton: !0,
							confirmButtonText: "YES!",
							cancelButtonText: "NO",
							reverseButtons: !0
						}).then(function (e) {

							if (e.value === true) {
								var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

								$.ajax(
										{
											url: "/invoices_list_admin/pendingStatus/" + id,
											type: 'POST',
											data: {
												"id": id,
												"_token": token,
											},
											success: function (response) {
												console.log(response);
												if (response.success === true) {
													swal.fire("Status Changed Successfully!", response.message, "success");
													location.reload();
												} else {
													swal.fire("status not Changed!!", response.message, "error");
													location.reload();
												}
											}
										});
							} else {
								e.dismiss;
							}

						})

					});
				});


			</script>
@stop
