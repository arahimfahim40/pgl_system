@extends('admin.layout.main')
@section('title','invoices')
<style type="text/css">
	label{
		font-weight: bold;
	}
</style>
@section('content')
<div class="site-content">
  <div class="content-area py-1">
	<div class="container-fluid"> 
		<div class="card">
			<div class="card-header clearfix">
				<h5 class="float-xs-left mb-0">Add Invoice</h5>
			   </div>
				 <div class="card-block">
					<div class="row mb-2">
                       <form action="{{url('add_new_invoice')}}" method="post" enctype="multipart/form-data">
                           {!! csrf_field() !!}
                    <div class="col-md-12">

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Invoice Number</label>
                            <input type="text" name="inv_number" id="invoice_no" class="form-control" placeholder="Invoice Number" />
                            <span id="invoice_exist" style="color: red;font-weight: bold;"></span>
                        </div>
                        <div class="form-group">
                            <label for="name">Invoice Date</label>
                            <input type="date" name="inv_date"  class="form-control" placeholder="Invoice Date" />
                        </div>
                        <div class="form-group">
                            <label for="name">Purpose</label>
                            <input type="text" name="purpose"  class="form-control" placeholder="Purpose" />
                        </div>
                        <div class="form-group">
                            <label for="name">Invoice Due Date</label>
                            <input type="date" name="inv_due_date"  class="form-control" placeholder="Invoice Due Date" />
                        </div>
                        <div class="form-group">
                            <label for="name">Select Company</label>
                            <select name="comp"  id="company" class="company select2" style="width: 100%" required="required">
                                <option value=""></option>
                                @foreach($companies as $company)
                                <option value="{{$company->id}}">{{$company->name}}</option>
                                @endforeach
                            </select>

                        </div>

                    </div>
                    <!-- /.col -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Select Container</label>
                            <select name="cont" id="" class="select2" style="width: 100%" required="required">
                                <option value=""></option>
                               <?php foreach ($containers as $container){?>
                                    <option value="{{$container->id}}">{{$container->container_number}}</option>
                              <?php }?>
                            </select>

                        </div>

                        <div class="form-group">
                            <label for="name">Invoice Amount</label>
                            <input type="text" name="inv_amount"  class="form-control" placeholder="Invoice Amount" />
                        </div>

                        <div class="form-group">
                            <label for="name">Payment Received</label>
                            <input type="text" name="payment_rece"  class="form-control" placeholder="Payment Received" />
                        </div>
                        <div class="form-group">
                            <label for="name">Received Date</label>
                            <input type="date" name="rece_date"  class="form-control" placeholder="Received Date" />
                        </div>

                        <div class="form-group">
                            <label for="name">Method of Payment</label>
                            <input type="text" name="payment_method"  class="form-control" placeholder="Method of Payment" />
                        </div>
                    </div>
                    <div class="col-md-12">
                        <textarea name="description" placeholder="Description " style="width: 100%; height: 150px;"></textarea>
                    </div>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.box-body -->
		<div class="card-footer clearfix">
			<button type="submit" class="btn btn-info btn-rounded label-left float-xs-left">
				<span class="btn-label"><i class="ti-save"></i></span>
				Save
			</button>
		</div>
	 </div>
    </form>
	</div>
  </div>
</div>		
@stop
@section('js')
<script>
    $(document).ready(function(){
        $('#invoice_no').focusout(function(){
            $('#invoice_exist').html("<div style='color:blue !important'><img width='30px' src= '"+"{{asset('img/loading.gif')}}"+"' alt='Loading ...'> </div> ");
            var invoice_no=$(this).val();
           var request = $.ajax({
              url: "{{route('check_invoice_number')}}",
              method: "GET",
              data: {invoice_no:invoice_no},
            }); 
            request.done(function( msg ) {
                if(msg)
                $('#invoice_exist').text('This invoie number already exist ! ');
                else  $('#invoice_exist').text('');
            });
            request.fail(function( jqXHR, textStatus ) {
                alert(textStatus)
          });
       });
    });
</script>
@stop
