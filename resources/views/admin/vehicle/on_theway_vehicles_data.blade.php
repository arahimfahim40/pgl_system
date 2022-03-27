
			<table class="table table-bordered" id="example">
				<thead class="bg-info">
					<tr>
						<th>#</th>
						@if(Auth::guard('admin')->user()->hasPermissions(['Admin','edit-vehicle']))
						<th>Edit</th>
						@endif
						 @if(Auth::guard('admin')->user()->hasPermissions(['Admin','add-status']))
						<th>Select</th>
						@endif
						<th>Vehicle Desc</th>
						<th>Vin No</th>
						<th>Lot No</th>
						<th>Auction city</th>
						<th>Auction</th>
						<th>Towing company</th>
						<th>Company</th>
						<th>Customer remarks</th>
						<th>Purchase date</th>
						<th>Days fm purchase</th>
						<th>Reported date</th>
						<th>Payment date</th>
						<th>Posted by in CD</th>
						<th>Pick up due date</th>
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
						@if(Auth::guard('admin')->user()->hasPermissions(['Admin','edit-vehicle']))
						<td>
                        	<a href="{{url('edit_vehicle',$veh->id)}}" class="btn btn-info btn-circle waves-effect waves-light"><span class="fa fa-pencil"></span>
                        	</a>
                        </td>
                        @endif
                        @if(Auth::guard('admin')->user()->hasPermissions(['Admin','add-status']))
                        <td>
                        	<input type="checkbox" class="checkbox" data-id={{$veh->id}}"> 
                        </td>
                        @endif
						<td>{{$veh->year}}&nbsp;{{$veh->make}}&nbsp;{{$veh->model}}&nbsp;{{$veh->color}}</td>
						<td><span class="tag tag-info">{{$veh->vin}}</span></td>
						<td><span class="tag tag-warning">{{$veh->lot_number}}</span></td>
						<td>{{$veh->auction_city}}</td>
                        <td>{{$veh->auction}}</td>
                        <td>{{$veh->towingcompany}}</td>
                        <td><span class="tag tag-success">{{$veh->company_name}}<span></td>
                        <td>{{$veh->c_remark}}</td>
                        <td>{{$veh->purchase_date}}</td>
                        <td>
                            <?php 
                            $now=strtotime(date('Y-m-d'));
                            $purchasedata=strtotime($veh->purchase_date);
                             $diff = $now-$purchasedata;
                             echo round($diff / (60 * 60 * 24));
                             ?> 
                        <td>{{$veh->rpgldate}}</td> 
                        <td>{{$veh->dpicd}}</td>
                        <td>{{$veh->cdname}}</td>
                        <td>{{$veh->pickup_due_date}}</td>
                        <td>{{$veh->pickup_date}}</td>
                        <td>{{$veh->number_days_pur}}</td>
                        <td><span>{{$veh->number_days_rep}}</span></td>
						<td><span class="tag tag-success">{{@$veh->location}}</span></td>
					</tr>
					@endforeach
				</tbody>
				<tfoot>
					<tr>
						<th>#</th>
						@if(Auth::guard('admin')->user()->hasPermissions(['Admin','edit-vehicle']))
						<th>Edit</th>
						@endif
						@if(Auth::guard('admin')->user()->hasPermissions(['Admin','add-status']))
						<th>Select</th>
						@endif
						<th>Vehicle Desc</th>
						<th>Vin No</th>
						<th>Lot No</th>
						<th>Auction city</th>
						<th>Auction</th>
						<th>Towing company</th>
						<th>Company</th>
						<th>Customer remarks</th>
						<th>Purchase date</th>
						<th>Days fm purchase</th>
						<th>Reported date</th>
						<th>Payment date</th>
						<th>Posted by in CD</th>
						<th>Pick up due date</th>
						<th>Pick up date</th>
						<th>Pick up days fm puchase</th>
						<th>Pick up days fm report</th>
						<th>Point of loading</th>	
					</tr>
				</tfoot>
			</table>
			@if(!empty($vehicles))
<<<<<<< HEAD
			{{ $vehicles->links()}}
=======
			{{ $vehicles->appends(Request::All())->links()}}
>>>>>>> parent of affd84d (Cleared the repo)
			@endif
		</div>
	</div>
</div>