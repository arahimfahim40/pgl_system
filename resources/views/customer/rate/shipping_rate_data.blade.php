			<table class="table">
				<thead class="bg-primary">
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
					</tr>
				</thead>
				<tbody >
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
					</tr>
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
					</tr>
				</tfoot>
			</table>
			@if(!empty($shippingrates))
			{{ $shippingrates->appends(Request::All())->links()}}
			@endif
		</div>
	</div>
</div>
