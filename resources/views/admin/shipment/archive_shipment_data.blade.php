			<table class="table table-bordered" id="example">
				<thead class="bg-info">
					<tr>
						<th>#</th>
						<th>BOL</th>
						<th>Booking No</th>
						<th>Container No</th>
						<th>Company</th>
						<th>Invoice No</th>
						<th>ITN</th>
						<th>VIN</th>
						<th>Note</th>
						<th>Reference No</th>
						<th class="column">Add</th>
						@if(Auth::guard('admin')->user()->hasPermissions(['Admin','edit-shipment']))
						<th class="column">Edit</th>
						@endif
					</tr>
				</thead>
				<tbody >
					<?php $id =1; ?>
					@foreach($shipments as $item)
					<tr id="searchBody">
						<td><?=$id++; ?></td>
						 <td>
                        	<a target="_blank" href="{{route('bol_admin',$item->id)}}">BOL</a>
                        </td>
						<td>{{$item->booking_number}}</td>
                        <td>{{$item->container_number}}</td>
                        <td><span class="tag tag-success">{{$item->company_name}}</span>
					    </td>
					    <td>{{$item->inv_number}}</td>
					    <td>{{$item->aes_itn_number}}</td>
					    <td>
					    	<?php 
					    	$vehicle_vin=DB::table('tbl_bases')->select('vehicles.vin')
					    	->join('vehicles','tbl_bases.vehicle_id','vehicles.id')
					    	->where('tbl_bases.container_id',$item->id)
					    	->get();
					    	foreach($vehicle_vin as $veh_vin){
					    		echo $veh_vin->vin ."<br>";
					    	}

					    	?>


					    </td>
					    <td><?=@$item->title_archive_note?></td>
					    <td><?=@$item->title_archive_reference_no?></td>
					    <td class="column">
                        	<a href="#add_archive{{$item->id}}" class="btn btn-primary btn-circle waves-effect waves-light" data-toggle="modal"><span class="fa fa-edit"></span>
                        	</a>
                        </td>
						@if(Auth::guard('admin')->user()->hasPermissions(['Admin','edit-shipment']))
                        <td class="column">
                        	<a href="{{route('edit_shipment',$item->id)}}" class="btn btn-info btn-circle waves-effect waves-light"><span class="fa fa-pencil"></span>
                        	</a>
                        </td>
                        @endif  
					</tr>
					@include('admin.shipment.add_archive_shipment')
					@endforeach
				</tbody>
				<tfoot>
					<tr class="bottom">
						<th>#</th>
						<th>BOL</th>
						<th>Booking No</th>
						<th>Container No</th>
						<th>Company</th>
						<th>Invoice No</th>
						<th>ITN</th>
						<th>VIN</th>
						<th>Note</th>
						<th>Reference No</th>
						<th>Add</th>
						@if(Auth::guard('admin')->user()->hasPermissions(['Admin','edit-shipment']))
						<th>Edit</th>
						@endif
					</tr>
				</tfoot>
			</table>
			@if(!empty($shipments))
			{{ $shipments->appends(Request::All())->links()}}
			@endif
		</div>
	</div>
</div>
