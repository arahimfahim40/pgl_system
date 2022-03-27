
			<table class="table table-bordered" id="example">
				<thead class="bg-info">
					<tr>
						<th>#</th>
                        <th>Company</th>
                        <th>Vehicle Description</th>
                        <th>VIN Number</th>
						<th>Container No</th>
                        <th>From</th>
                        <th>To</th>
                        <th>Delivery Date</th>
                        <th>Tow Amount Actual</th>
                        <th>Tow Amount Charged</th>
                        <th>Profit</th>
                        @if(Auth::guard('admin')->user()->hasPermissions(['Admin','edit-vehicle']))
						<th>Edit</th>
						@endif

					</tr>
				</thead>
				<tbody >
					<?php $id =1;
					 $total_actual=0; $total_charged=0; $total_profit=0;
					 ?>
					@foreach($vehicles as $veh)
					<?php $cont=DB::table('tbl_bases')->join('containers','tbl_bases.container_id','containers.id')->where('tbl_bases.vehicle_id',$veh->id)->first();
						?>
					<tr id="searchBody">
						<td>{{$id++}}</td>
						<td><span class="tag tag-success">{{$veh->name}}</span></td>
						<td>{{$veh->year}}&nbsp;{{$veh->make}}&nbsp;{{$veh->model}}&nbsp;{{$veh->color}}</td>
						<td><span class="tag tag-info">{{$veh->vin}}</span></td>
						<td><span class="tag tag-info">{{@$cont->container_number}}</span>
						</td>
						<td><?=$veh->towed_from?></td>
                        <td><?=@$veh->location?></td>
                        <td><?=@$veh->deliver_date?></td>
                        <td><?=@$veh->tow_amount;@$total_actual +=@$veh->tow_amount;?></td>
                        <td><?=@$veh->tow_amounts;@$total_charged +=@$veh->tow_amounts;?></td>
                        <td><?php $profit=(int)$veh->tow_amounts-(int)$veh->tow_amount;
							echo @$profit;@$total_profit+=@$profit;?>
						</td>
						@if(Auth::guard('admin')->user()->hasPermissions(['Admin','edit-vehicle']))
						<td>
                        	<a href="{{url('edit_vehicle',$veh->id)}}" class="btn btn-info btn-circle waves-effect waves-light"><span class="fa fa-pencil"></span>
                        	</a>
                        </td>
                		@endif
					</tr>
					@endforeach
				</tbody>
				<tfoot>
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td><span class="red">{{$total_actual}}</span></td>
						<td><span class="red">{{$total_charged}}</span></td>
						<td><span class="red">{{$total_profit}}</span></td>
						@if(Auth::guard('admin')->user()->hasPermissions(['Admin','edit-vehicle']))
						<td></td>
						@endif	
					</tr>
				</tfoot>
			</table>
			@if(!empty($vehicles))
			{{ $vehicles->links()}}
			@endif
		</div>
	</div>
</div>