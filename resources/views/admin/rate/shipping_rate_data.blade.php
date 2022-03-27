			<table class="table table-bordered" id="example">
				<thead class="bg-info">
					<tr>
						<th>#</th>
						<th>From port</th>
                        <th>To port</th>
                        <th>Cargo</th>
                        <th>Old price</th>
                        <th>Change date</th>
                        <th>New price</th>
                        <th>Increase /decrease</th>
                        <th>Note</th>
                        @if(Auth::guard('admin')->user()->hasPermissions(['Admin','add-ship-rate']))
                        <th>Edit</th>
                        @endif
                         @if(Auth::guard('admin')->user()->hasPermissions(['Admin','delete-ship-rate']))
                        <th>Delete</th>
                        @endif
					</tr>
				</thead>
				<tbody>
					<?php $id =1; ?>
					@foreach($shippingrates as $item)
					<tr id="searchBody">
						<td><?=$id++; ?></td>
                        <td>{{$item->from_port}}</td>
                        <td>{{$item->to_port}}</td>
                        <td>{{$item->cargo}}</td>
                        <td>{{$item->old_price}}</td>
                        <td>{{$item->change_date}}</td>
                        <td>{{$item->new_price}}</td>
                        <td>${{(float)$item->new_price-(float)$item->old_price}}</td>
                        <td>{{strip_tags($item->note)}}</td>
                        @if(Auth::guard('admin')->user()->hasPermissions(['Admin','add-ship-rate']))
                        <td>
	                   	<a href="#edit_shipping_rate{{$item->id}}" class="btn btn-primary btn-circle" data-toggle="modal"><span class="fa fa-pencil"></span>
	                   	</a>
	                   </td>
	                   @endif
	                   @if(Auth::guard('admin')->user()->hasPermissions(['Admin','delete-ship-rate']))
	                   <td>
	                   	<a class="btn btn-warning btn-circle" onclick="javascript:return confirm('Are you sure you want to delete ?')" href="{{route('delete_shipping_rate_admin',$item->id)}}"><span class="fa fa-trash"></span>
	                   	</a>
	                   </td>
	                   @endif
					</tr>
					@include('admin.rate.edit_shipping_rate')
					@endforeach
				</tbody>
				<tfoot>
					<tr>
						<th>#</th>
						<th>From port</th>
                        <th>To port</th>
                        <th>Cargo</th>
                        <th>Old price</th>
                        <th>Change date</th>
                        <th>New price</th>
                        <th>Increase /decrease</th>
                        <th>Note</th>
                        @if(Auth::guard('admin')->user()->hasPermissions(['Admin','add-ship-rate']))
                        <th>Edit</th>
                        @endif
                         @if(Auth::guard('admin')->user()->hasPermissions(['Admin','delete-ship-rate']))
                        <th>Delete</th>
                        @endif
					</tr>
				</tfoot>
			</table>
			@if(!empty($shippingrates))
			{{ $shippingrates->appends(Request::All())->links()}}
			@endif
		</div>
	</div>
</div>
