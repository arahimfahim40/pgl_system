@extends('admin.layout.main')
@section('title','Invoices')
@section('content')
<div class="site-content">
  <div class="content-area py-1">
	<div class="container-fluid">
		<div class=" bg-white table-responsive">
			<div class="form-group col-md-3 col-lg-3 col-sm-6 col-xs-12" style="margin:1%">
			 <input type="text" name="search" class="form-control b-a" placeholder="Search for ..." id="search">
		   </div>
		   @if($status !='' and $status !='4')
		   <div class="form-group col-md-1 col-lg-1 col-sm-6 col-xs-12" style="margin:1%">
				<button type="button" class="btn btn-warning btn-rounded mb-0-25 waves-effect waves-light" data-toggle="modal" data-target="#change_status"><b><i class="fa fa-info-circle"></i></b> Change Status
				</button>
		   </div>
		  @endif
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
		@include('admin.finance.invoice_data')
		@include('admin.finance.change_status')
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
        });

       // search section
       $('#search').on('keyup',function(e){
	   		var searchData = $(this).val();
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
