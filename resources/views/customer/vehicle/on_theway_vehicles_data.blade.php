
			<table class="table table-bordered" id="example">
				<thead class="bg-primary">
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
						<th>Pick up days fm puchase</th>
						<th>Pick up days fm report</th>
						<th>Point of loading</th>	
					</tr>
				</thead>
				<tbody >
					<?php $id =1; ?>
					@foreach($vehicles as $veh)
					<tr id="searchBody">
						<td>{{$id++}}</td>
						<td>{{$veh->year}}&nbsp;{{$veh->make}}&nbsp;{{$veh->model}}&nbsp;{{$veh->color}}</td>
						<td><span class="tag tag-primary">{{$veh->vin}}</span></td>
						<td><span class="tag tag-primary">{{$veh->lot_number}}</span></td>
                        <td>{{$veh->purchase_date}}</td>
                        <td>{{$veh->rpgldate}}</td>
                        <td>{{$veh->payment_date}}</td>
                        <td>{{$veh->towing_request_date}}</td>
                        <td>{{$veh->dpicd}}</td>
                        <td>{{$veh->pickup_date}}</td>
                        <td>{{$veh->number_days_pur}}</td>
                        <td>{{$veh->number_days_rep}}</td>
						<td><span class="tag tag-success">{{@$veh->location}}</span></td>
					</tr>
					@endforeach
				</tbody>
				<tfoot>
					<tr class="bottom">
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
						<th>Pick up days fm puchase</th>
						<th>Pick up days fm report</th>
						<th>Point of loading</th>	
					</tr>
				</tfoot>
			</table>
			@if(!empty($vehicles))
			{{ $vehicles->links()}}
			@endif
		</div>
	</div>
</div>