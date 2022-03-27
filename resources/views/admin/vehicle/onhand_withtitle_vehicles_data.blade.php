			<table class="table table-bordered" id="example">
				<thead class="bg-info">
					<tr>
						<th>#</th>
						@if(Auth::guard('admin')->user()->hasPermissions(['Admin','edit-vehicle']))
						<th>Edit</th>
						@endif
						@if(Auth::guard('admin')->user()->hasPermissions(['Admin','add-to-container']))
						<th>Select</th>
						@endif
						<th>Photo</th>
						<th>Photo link</th>
						<th>Hat No</th>
						<th>Key present</th>
						<th>Vehicle Desc</th>
						<th>Vin No</th>
						<th>Lot No</th>
						<th>Status</th>
						<th>Company</th>
						<th>Customer remark</th>
						<th>Delivery date</th>
						<th>Age At PGL W/H</th>
                        <th>Title no</th>
                        <th>Title status </th>
                        <th>Title state</th>
                        <th>Weight</th>
                        <th>Value</th>
                        <th>Ship as </th>
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
                        @if(Auth::guard('admin')->user()->hasPermissions(['Admin','add-to-container']))
                        <td>
                        	<input name="id" type="checkbox" class="checkbox" value="{{$veh->id}}" data-id="{{$veh->id}}"> 
                        </td>
                        @endif
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
						<td>{{$veh->htnumber}}</td>
						<td>
							@if($veh->is_key==2)
                            <span class="tag tag-warning">No</span>
                            @elseif($veh->is_key==1)
                            <span class="tag tag-success">Yes</span>
                            @else
                            <span></span>
                            @endif
						</td>
						<td>{{$veh->year}}&nbsp;{{$veh->make}}&nbsp;{{$veh->model}}&nbsp;{{$veh->color}}</td>
						<td><span class="tag tag-primary">{{$veh->vin}}</span></td>
						<td><span class="tag tag-primary">{{$veh->lot_number}}</span></td>
						<td> <?php if(@$veh->cont_id!='0') { ?><span class="tag tag-warning">Reserve </span> <?php } else echo ""; ?> 
						</td>
						<td><span class="tag tag-success">{{$veh->company_name}}</span></td>
					    <td>{{@$veh->c_remark}}</td>
                        <td><span class="tag tag-primary">{{$veh->deliver_date}}</span></td>
                        <td><?php
                            $formatted_dt1=Carbon\Carbon::parse(\Carbon\Carbon::today());
                            $formatted_dt2=Carbon\Carbon::parse($veh->deliver_date);
                            ?>
                            {{ $date_diff=$formatted_dt1->diffInDays($formatted_dt2) }}
                        </td>
                        <td>{{$veh->title_number}}</td>
                        <td>{{@$veh->title_status}}</td>
						<td>{{$veh->title_state}}</td>
						<td>{{$veh->weight}}</td>
						<td>{{$veh->vehicle_price}}</td>
                        <td>@if($veh->shipas=='whole car')
                            <span class="tag tag-success">Whole Car</span>
                            @elseif($veh->shipas=='Dismantle')
                            <span class="tag tag-danger">Dismental</span>
                            @else 
                            <span class="tag tag-danger"></span>
                            @endif
                        </td>
						<td><span class="tag tag-success">{{@$veh->location}} </span></td>
					</tr>
					@endforeach
				</tbody>
				<tfoot>
					<tr>
						<th>#</th>
						@if(Auth::guard('admin')->user()->hasPermissions(['Admin','edit-vehicle']))
						<th>Edit</th>
						@endif
						@if(Auth::guard('admin')->user()->hasPermissions(['Admin','add-to-container']))
						<th>Select</th>
						@endif
						<th>Photo</th>
						<th>Photo link</th>
						<th>Hat No</th>
						<th>Key present</th>
						<th>Vehicle Desc</th>
						<th>Vin No</th>
						<th>Lot No</th>
						<th>Status</th>
						<th>Company</th>
						<th>Customer remark</th>
						<th>Delivery date</th>
						<th>Age At PGL W/H</th>
                        <th>Title no</th>
                        <th>Title status </th>
                        <th>Title state</th>
                        <th>Weight</th>
                        <th>Value</th>
                        <th>Ship as </th>
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
