			<table class="table" id="example">
				<thead class="bg-info">
					<tr>
						<th>#</th>
						<th>State</th>
                        <th>Branch / Location</th>
                        <th>City</th>
                        <th>Old towing cost</th>
                        <th>Change date</th>
                        <th>New towing cost</th>
                        <th>Increase /decrease</th>
                        <th>Note</th>
                        @if(Auth::guard('admin')->user()->hasPermissions(['Admin','add-tow-rate']))
                        <th>Edit</th>
                        @endif
                        @if(Auth::guard('admin')->user()->hasPermissions(['Admin','delete-tow-rate']))
                        <th>Delete</th>
                        @endif
					</tr>
				</thead>
				<tbody >
					<?php $id =1; ?>
					@foreach($towingrates as $item)
					<tr id="searchBody">
						<td><?=$id++; ?></td>
                        <td>{{$item->state}}</td>
                        <td>{{$item->branch}}</td>
                        <td>{{$item->city}}</td>
                        <td>{{$item->towing_cost}}</td>
                        <td>{{$item->change_date}}</td>
                        <td>{{$item->new_cost}}</td>
                        <td>${{$item->new_cost-$item->towing_cost}}</td>
                        <td><?=$item->note?></td>
                        @if(Auth::guard('admin')->user()->hasPermissions(['Admin','add-tow-rate']))
                        <td>
	                   		<a href="#edit_towing_rate{{$item->id}}" class="btn btn-primary btn-circle" data-toggle="modal"><span class="fa fa-pencil"></span>
	                   		</a>
	                   </td>
	                   @endif
	                   @if(Auth::guard('admin')->user()->hasPermissions(['Admin','delete-tow-rate']))
	                   <td>
	                   		<a class="btn btn-warning btn-circle" onclick="javascript:return confirm('Are you sure you want to delete ?')" href="{{route('delete_towing_rate_admin',$item->id)}}"><span class="fa fa-trash"></span>
	                   		</a>
	                   </td>
	                   @endif
					</tr>
					@include('admin.rate.edit_towing_rate')
					@endforeach
				</tbody>
				<tfoot>
					<tr>
						<th>#</th>
						<th>State</th>
                        <th>Branch / Location</th>
                        <th>City</th>
                        <th>Old towing cost</th>
                        <th>Change date</th>
                        <th>New towing cost</th>
                        <th>Increase /decrease</th>
                        <th>Note</th>
                        @if(Auth::guard('admin')->user()->hasPermissions(['Admin','add-tow-rate']))
                        <th>Edit</th>
                        @endif
                        @if(Auth::guard('admin')->user()->hasPermissions(['Admin','delete-tow-rate']))
                        <th>Delete</th>
                        @endif
					</tr>
				</tfoot>
			</table>
			@if(!empty($towingrates))
			{{ $towingrates->appends(Request::All())->links()}}
			@endif
		</div>
	</div>
</div>
