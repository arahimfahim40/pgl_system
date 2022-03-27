			<table class="table table-bordered">
				<thead class="bg-primary">
					<tr>
						<th>#</th>
						<th>Photo link</th>
						<th>Booking no</th>
						<th>Container no</th>
						<th>Size</th>
						<th>Port of loading</th>
						<th>port of discharge</th>
						<th>Number of unites</th>
						<th>ETD</th>
						<th>ETA</th>
						<th>BOL</th>
						@if($status=='9000')
						<th>Note</th>
						@endif	
					</tr>
				</thead>
				<tbody >
					<?php $id =1; ?>
					@foreach($shipments as $item)
					<tr id="searchBody">
						<td><?=$id++; ?></td>
                        	<td >
                              <?php
                              $label='tag-info';
                               if(@$item->photo_link=='') $label='tag-warning';?>
                                <a href="{{@$item->photo_link}}" target="_blank" style="text-align: center; font-size: 20px;"><span class="ti-image  <?=$label?>"></span></a>
                            </td>
                            <td>{{$item->booking_number}}</td>
                            <td>{{$item->container_number}}</td>
                            <td>{{$item->c_size}}</td>
                            <td>{{$item->port_loading}}</td>
                            <td>{{$item->port_discharge}}</td>
                            <td>{{$item->n_units_load}}</td>
                            <td>{{$item->etd_port_loading}}</td>
                            <td>{{$item->eta_port_discharge}}</td>
                            <td><a target="_blank" href="{{route('bol_customer',$item->id)}}">BOL</a></td>
                            @if($status=='9000')
                            <td>
							<a href="#addnote" data-toggle="modal">
							<?=@$item->customer_note!='' ? @$item->customer_note : " <span class='fa fa-pencil'> note</span>"?>
						    </td>
						    @endif
					</tr>
					@endforeach
				</tbody>
				<tfoot>
					<tr>
						<th>#</th>
						<th>Photo link</th>
						<th>Booking no</th>
						<th>Container no</th>
						<th>Size</th>
						<th>Port of loading</th>
						<th>port of discharge</th>
						<th>Number of unites</th>
						<th>ETD</th>
						<th>ETA</th>
						<th>BOL</th>
						@if($status=='9000')
						<th>Note</th>
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
