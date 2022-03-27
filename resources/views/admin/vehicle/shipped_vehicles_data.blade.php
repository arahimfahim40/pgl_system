			<table class="table table-bordered" id="example">
				<thead class="bg-info">
					<tr>
						<th>#</th>
						<th>Photo</th>
						<th>Photo link</th>
						<th>key present</th>
						<th>Container No</th>
						<th>Booking No</th>
						<th>Vehicle Desc</th>
						<th>Vin No</th>
						<th>Lot No</th>
						<th>Company</th>
						<th>Customer remark</th>
						<th>Delivery date</th>
						<th>ETD</th>
                        <th>ETA</th>
						<th>Point of loading</th>
						<th>Dstination port</th>
						<th>Ship as</th>
						<th>Dock receipt</th>
						<th>BOL</th>
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
                            <span class="tag tag-warning">No</span>
                            @elseif($veh->is_key==1)
                            <span class="tag tag-success">Yes</span>
                            @else
                            <span></span>
                            @endif
						</td>
						<td>{{$veh->container_number}}</td>
						<td>{{$veh->booking_number}}</td>
						<td>{{$veh->year}}&nbsp;{{$veh->make}}&nbsp;{{$veh->model}}&nbsp;{{$veh->color}}</td>
						<td><span class="tag tag-primary">{{$veh->vin}}</span></td>
						<td><span class="tag tag-info">{{$veh->lot_number}}</span></td>
                        <td><span class="tag tag-success">{{$veh->company_name}}</span></td>
                        <td>{{@$veh->c_remark}}</td>
                        <td><span class="tag tag-primary">{{$veh->deliver_date}}</span></td>
						<td>{{$veh->etd_port_loading}}</td>
						<td>{{$veh->eta_port_discharge}}</td>
						<td>{{@$veh->location}}</td>
						<td>{{$veh->dport}}</td>
						<td>@if($veh->shipas=='whole car')
                            <span class="tag tag-success">Whole_car</span>
                            @elseif($veh->shipas=='Dismantle')
                            <span class="tag tag-warning">Dismental</span>
                            @else 
                            <span class="label label-danger"></span>
                            @endif
                        </td>
                       <td><a target="_blank" href="{{route('dock_recepit_admin',$veh->container_id)}}">Dock</a>
                       </td>
                        <td><a target="_blank" href="{{route('bol_admin',$veh->container_id)}}">BOL</a>
                        </td>
					</tr>
					@endforeach
				</tbody>
				<tfoot>
					<tr>
						<th>#</th>
						<th>Photo</th>
						<th>Photo link</th>
						<th>Container No</th>
						<th>Vehicle Desc</th>
						<th>Vin No</th>
						<th>Delivery date</th>
						<th>ETD</th>
                        <th>ETA</th>
						<th>Point of loading</th>
						<th>Ship as</th>
						<th>Dock receipt</th>
						<th>BOL</th>
					</tr>
				</tfoot>
			</table>
			@if(!empty($vehicles))
			{{ $vehicles->appends(Request::All())->links()}}
			@endif
		</div>
	</div>
</div>
