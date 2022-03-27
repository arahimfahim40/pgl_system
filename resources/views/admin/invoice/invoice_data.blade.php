			<table class="table table-bordered" id="example">
				<thead class="bg-info dataTable" id="table-2">
					<tr>
						<th>#</th>
						@if($status=='')
						@if(Auth::guard('admin')->user()->hasPermissions(['Admin','edit-invoice']))
						<th>Edit</th>
						@endif
						@endif
						@if($status !='' and $status !='4')
						@if(Auth::guard('admin')->user()->hasPermissions(['Admin','add-status']))
						<th> <input type="checkbox" id="check_all"> &nbsp;Select</th>
						@endif
						@endif
						@if($status=='4')
						<th>Approve</th>
						@endif
						<th>Invoice Number</th>
						<th>Company</th>
                        <th>Purpose</th>
                        <th>Container Number</th>
                        <th>Issue Date</th>
                        <th>Due Date</th>
                        <th>Invoice Amount</th>
                        <th>Payment Received</th>
                        <th>Received Date</th>
                        @if($status !=3)
                        <th>Balance Due</th>
                        <th>Past Due Days</th>
                        @endif
                        <th>PDF</th>
                        @if($status=='')
                        @if(Auth::guard('admin')->user()->hasPermissions(['Admin','delete-invoice']))
                        <th>Delete</th>
                        @endif
                        @endif
					</tr>
				</thead>
				<tbody >
					<?php $id = 1;$invoice_amount=0;$payment_received=0;$balancedue=0;?>
					@foreach($invoices as $invoice)
					<?php 
						$invoice_amount+=$invoice->inv_amount;
						$payment_received+=$invoice->payment_rece;
					?>
					<tr id="searchBody">
						<td><?=$id++; ?></td>
						@if($status=='')
						 @if(Auth::guard('admin')->user()->hasPermissions(['Admin','edit-invoice']))
						<td>
                        	<a href="{{route('edit_invoice_admin',$invoice->id)}}" class="btn btn-info btn-circle waves-effect waves-light"><span class="fa fa-pencil"></span>
                        	</a>
                        </td>
                        @endif
                        @endif
                       @if($status !='' and $status !='4')
                       @if(Auth::guard('admin')->user()->hasPermissions(['Admin','add-status']))
						<td> <input type="checkbox" class="checkbox" data-id={{$invoice->id}}"> 
						</td>
						@endif
						@endif
                        @if($status=='4')
                        <td>
                        	<a  class="btn btn-warning btn-circle" onclick="javascript:return confirm('Are you sure you want to approve ?')" href="{{route('approve_invoice',$invoice->id)}}"><span class="fa fa-check"></span>
	                   	</a>
                        </td>
                        @endif
                        <td>{{$invoice->inv_number}}</td>
                        <td><span class="tag tag-success">{{@$invoice->company_name}}</span></td>
                        <td>{{$invoice->purpose}}</td>
	                    <td>{{$invoice->container_number}}</td>
	                    <td>{{$invoice->inv_date}}</td>
	                    <td>{{$invoice->inv_due_date}}</td>
	                    <td>${{$invoice->inv_amount}}</td>
	                    <td>${{$invoice->payment_rece}}</td>
	                    <td>{{$invoice->rece_date}}</td>
	                    @if($status !=3)
	                    <td>${{$sumdue=$invoice->inv_amount - $invoice->payment_rece}}</td>
	                    <td><span class="tag tag-danger">@if($invoice->inv_amount - $invoice->payment_rece > 0 ) <?php $today=Carbon\Carbon::parse(Carbon\Carbon::today());
	                        $inv_date_ude=Carbon\Carbon::parse($invoice->inv_due_date);
	                        if($today > $inv_date_ude){
	                        echo $total=$today->diffInDays($inv_date_ude); } else{?>0<?php } ?> @else @endif
	                    </span>
	                   </td>
	                   @endif
	                   <td><a href="{{route('invoice_pdf_admin',$invoice->id)}}" target="_blank">PDF</a>
	                   </td>
	                   @if($status=='')
	                    @if(Auth::guard('admin')->user()->hasPermissions(['Admin','delete-invoice']))
	                   <td>
	                   <a  class="btn btn-warning btn-circle" onclick="javascript:return confirm('Are you sure you want to delete ?')" href="{{route('delete_invoice_admin',$invoice->id)}}"><span class="fa fa-trash"></span>
	                   	</a>
	                   </td>
	                   @endif
	                   @endif
					</tr>
					@endforeach
				</tbody>
				<tfoot>
					<tr>
						<th>#</th>
						@if($status=='')
						@if(Auth::guard('admin')->user()->hasPermissions(['Admin','edit-invoice']))
						<th>Edit</th>
						@endif
						@endif
						@if($status !='' and $status !='4')
						@if(Auth::guard('admin')->user()->hasPermissions(['Admin','add-status']))
						<th> <input type="checkbox" id="check_all"> &nbsp;Select</th>
						@endif
						@endif
						@if($status=='4')
						<th>Approve</th>
						@endif
						<th>Invoice Number</th>
						<th>Company</th>
                        <th>Purpose</th>
                        <th>Container Number</th>
                        <th>Issue Date</th>
                        <th>Due Date</th>
                        <th>Invoice Amount</th>
                        <th>Payment Received</th>
                        <th>Received Date</th>
                        @if($status !=3)
                        <th>Balance Due</th>
                        <th>Past Due Days</th>
                        @endif
                        <th>PDF</th>
                        @if($status=='')
                        @if(Auth::guard('admin')->user()->hasPermissions(['Admin','delete-invoice']))
                        <th>Delete</th>
                        @endif
                        @endif
					</tr>
				</tfoot>
			</table>
			@if(!empty($invoices))
			{{ $invoices->appends(Request::All())->links()}}
			@endif
		</div>
	</div>
</div>
