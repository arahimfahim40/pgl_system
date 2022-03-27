			<table class="table table-bordered">
				<thead class="bg-primary dataTable" id="table-2">
					<tr>
						<th>#</th>
						<th>Invoice Number</th>
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
					</tr>
				</thead>
				<tbody >
					<?php $id =1; ?>
					@foreach($invoices as $invoice)
					<tr id="searchBody">
						<td><?=$id++; ?></td>
                        <td>{{$invoice->inv_number}}</td>
                        <td>{{$invoice->purpose}}</td>
	                    <td>{{$invoice->container_number}}</td>
	                    <td>{{$invoice->inv_date}}</td>
	                    <td>{{$invoice->inv_due_date}}</td>
	                    <td>{{$invoice->inv_amount}}</td>
	                    <td>{{$invoice->payment_rece}}</td>
	                    <td>{{$invoice->rece_date}}</td>
	                    @if($status !=3)
	                    <td>{{$sumdue=$invoice->inv_amount - $invoice->payment_rece}}</td>
	                    <td>@if($invoice->inv_amount - $invoice->payment_rece > 0 ) <?php $today=Carbon\Carbon::parse(Carbon\Carbon::today());
	                        $inv_date_ude=Carbon\Carbon::parse($invoice->inv_due_date);
	                        if($today > $inv_date_ude){
	                        echo $total=$today->diffInDays($inv_date_ude); } else{?>0<?php } ?> @else @endif
	                   </td>
	                   @endif
	                   <td><a href="{{route('invoice_pdf_customer',$invoice->id)}}" target="_blank">PDF</a></td>
					</tr>
					@endforeach
				</tbody>
				<tfoot>
					<tr>
						<th>#</th>
						<th>Invoice Number</th>
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
					</tr>
				</tfoot>
			</table>
			@if(!empty($invoices))
			{{ $invoices->appends(Request::All())->links()}}
			@endif
		</div>
	</div>
</div>
