			<table class="table">
				<thead class="bg-primary">
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
					</tr>
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
					</tr>
				</tfoot>
			</table>
			@if(!empty($towingrates))
			{{ $towingrates->appends(Request::All())->links()}}
			@endif
		</div>
	</div>
</div>
