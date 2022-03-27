
			<table class="table table-bordered" id="example">
				<thead class="bg-info">
					<tr>
						<th>#</th>
						<th>Vehicle Desc</th>
						<th>Vin No</th>
						<th>Lot No</th>
						<th>Purchase date</th>
						<th>Reported date</th>
						<th>Payment date</th>
						<th>Tow request date</th>
						<th>Date posted in CD</th>
						<th>Pick up date</th>
						<th>Delivery date</th>
						<th>Pick up days fm purchase</th>
						<th>Pick up days fm report</th>	
					</tr>
				</thead>
				<tbody >
					<?php $id =1; ?>
					@foreach($vehicles as $veh)
					<tr id="searchBody">
						<td>{{$id++}}</td>
						<td>{{$veh->year}}&nbsp;{{$veh->make}}&nbsp;{{$veh->model}}&nbsp;{{$veh->color}}</td>
						<td><span class="tag tag-info">{{$veh->vin}}</span></td>
						<td><span class="tag tag-info">{{$veh->lot_number}}</span></td>
                        <td>{{$veh->purchase_date}}</td>
                        <td>{{$veh->rpgldate}}</td>
                        <td>{{$veh->payment_date}}</td>
                        <td>{{$veh->towing_request_date}}</td>
                        <td>{{$veh->dpicd}}</td>
                        <td>{{$veh->pickup_date}}</td>
                        <td>{{$veh->deliver_date}}</td>
                        <td>{{$veh->number_days_pur}}</td>
                        <td>{{$veh->number_days_rep}}</td>
					</tr>
					@endforeach
				</tbody>
				<tfoot>
					<tr>
						<th>#</th>
						<th>Vehicle Desc</th>
						<th>Vin No</th>
						<th>Lot No</th>
						<th>Purchase date</th>
						<th>Reported date</th>
						<th>Payment date</th>
						<th>Tow request date</th>
						<th>Date posted in CD</th>
						<th>Pick up date</th>
						<th>Delivery date</th>
						<th>Pick up days fm purchase</th>
						<th>Pick up days fm report</th>		
					</tr>
				</tfoot>
			</table>
			@if(!empty($vehicles))
			{{ $vehicles->links()}}
			@endif
		</div>
	</div>
</div>