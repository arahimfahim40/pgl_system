			<table class="table table-bordered">
				<thead class="bg-primary">
					<tr>
						<th>#</th>
						<th>Photo</th>
						<th>Photo link</th>
						<th>Key present</th>
						<th>Vehicle Desc</th>
						<th>Vin No</th>
						<th>Lot No</th>
						<th>Title status</th>
						<th>Customer remark</th>
						<th>Delivery date</th>
						<th>Age At PGL W/H</th>
                        <th>Auction</th>
                        <th>Auction City</th>
						<th>Point of loading</th>
					</tr>
				</thead>
				<tbody >
					<?php $id =1; ?>
					@foreach($vehicles as $veh)
					<tr id="searchBody">
						<td>{{$id++}}</td>
						<td >
                          <?php
                          $label='tag-info';
                           if(strpos($veh->link,'http') === false) $label='tag-warning';?>
                            <a href="{{route('vehicle_photo_customer',$veh->id)}}" style="text-align: center; font-size: 25px;"><span ><img src="{{asset('img/icon.png')}}" style="height: 40px;"><p style="display: none">{{$veh->link}}</p></span></a>
                        </td>
						<td> 
							<?php
							  $label='';
                               if(strpos($veh->link,'http') === false) 
                                $label='tag-warning';
                              ?>
                            <a href="{{$veh->link}}" target="_blank" style="text-align: center; font-size:20px;">
                            	<span class="ti-image  <?=$label?>"><p style="display: none">{{$veh->link}}</p></span>
                            </a>
						</td>
						<td>
							@if($veh->is_key==2)
                            <span class="label label-warning">No</span>
                            @elseif($veh->is_key==1)
                            <span class="label label-success">Yes</span>
                            @else
                            <span></span>
                            @endif
						</td>
						<td>{{$veh->year}}&nbsp;{{$veh->make}}&nbsp;{{$veh->model}}&nbsp;{{$veh->color}}</td>
						<td><span class="tag tag-primary">{{$veh->vin}}</span></td>
						<td><span class="tag tag-primary">{{$veh->lot_number}}</span></td>
						<td>{{@$veh->title_status}}</td>
					    <td>{{@$veh->c_remark}}</td>
                        <td><span class="tag tag-primary">{{$veh->deliver_date}}</span></td>
                        <td><?php
                            $formatted_dt1=Carbon\Carbon::parse(\Carbon\Carbon::today());
                            $formatted_dt2=Carbon\Carbon::parse($veh->deliver_date);
                            ?>
                            {{ $date_diff=$formatted_dt1->diffInDays($formatted_dt2) }}
                        </td>
                        <td>{{$veh->auction}}</td>
                        <td>{{$veh->auction_city}}</td>
						<td><span class="tag tag-success">{{@$veh->location}}</span></td>
					</tr>
					@endforeach
				</tbody>
				<tfoot>
					<tr>
						<th>#</th>
						<th>Photo</th>
						<th>Photo link</th>
						<th>Key present</th>
						<th>Vehicle Desc</th>
						<th>Vin No</th>
						<th>Lot No</th>
						<th>Title status</th>
						<th>Customer remark</th>
						<th>Delivery date</th>
						<th>Age At PGL W/H</th>
                        <th>Auction</th>
                        <th>Auction City</th>
						<th>Point of loading</th>
					</tr>
				</tfoot>
			</table>
			@if(!empty($vehicles))
			{{ $vehicles->appends(Request::All())->links()}}
			@endif
		</div>
	</div>
</div>
