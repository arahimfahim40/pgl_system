<<<<<<< HEAD

=======
>>>>>>> parent of affd84d (Cleared the repo)
				<table class="table table-bordered" id="example">
					<thead class="bg-info thead-dark">
						<tr>
							<th>#</th>
							@if(Auth::guard('admin')->user()->hasPermissions(['Admin','edit-vehicle']))
							<th class="column">Edit</th>
							@endif
							<th class="column">Photo</th>
							<th class="column">Photo link</th>
							<th>Hat No</th>
							<th>Key present</th>
							<th>Vehicle Desc</th>
							<th>Vin No</th>
							<th>Lot No</th>
							<th>Company</th>
							<th>Customer remark</th>
							<th>Customer note</th>
							<th>Purchase date</th>
							<th>Point of loading</th>
							<th>Destination port</th>
							<th>Delivery date</th>
							<th>Container No</th>
							<th>Booking No</th>
							<th>Title No</th>
							<th>Title state</th>
							<th>Title status</th>
							<th>Arrive date</th>
							<th>Current status</th>
							<th class="column">Con rep</th>
							<th class="column">Auction inv</th>
							@if(Auth::guard('admin')->user()->hasPermissions(['Admin','delete-vehicle']))
							<th>Delete</th>
							@endif
						</tr>
					</thead>
				   <tbody >
						<?php $id =1; ?>
						@foreach($vehicles as $veh)
						<?php $cont=DB::table('tbl_bases')->join('containers','tbl_bases.container_id','containers.id')->where('tbl_bases.vehicle_id',$veh->id)->first();
						?>
						<tr id="searchBody">
							<td>{{$id++}}</td>
							@if(Auth::guard('admin')->user()->hasPermissions(['Admin','edit-vehicle']))
							<td class="column">
                            	<a href="{{url('edit_vehicle',$veh->id)}}" class="btn btn-info btn-circle waves-effect waves-light"><span class="fa fa-pencil"></span>
                            	</a>
                            </td>
                            @endif
							<td class="column">
                              <?php
                              $label='tag-info';
                               if(strpos($veh->link,'http') === false) $label='tag-warning';?>
                                <a href="{{route('vehicle_photo_admin',$veh->id)}}" style="text-align: center; font-size: 25px;"><span ><img src="{{asset('img/icon.png')}}" style="height: 40px;"><p style="display: none">{{$veh->link}}</p></span></a>
                            </td>
							<td class="column"> 
								<?php
								  $label='';
	                               if(strpos(@$veh->link,'http') === false) 
	                                $label='tag-warning';
	                              ?>
	                            <a href="{{$veh->link}}" target="_blank" style="text-align: center; font-size:20px;">
	                            	<span class="ti-image  <?=$label?>"><p style="display: none">{{$veh->link}}</p></span>
	                            </a>
							</td>
							<td>{{$veh->htnumber}}</td>
							<td>
                                @if($veh->carstate_id!=1)
                                @if($veh->is_key==2)
                                <span class="tag tag-warning">No</span>
                                @elseif($veh->is_key==1)
                                <span class="tag tag-success">Yes</span>
                                @else
                                <span></span>
                                @endif
                                @else
                                <p></p>
                                @endif
                            </td>
							<td>{{$veh->year}}&nbsp;{{$veh->make}}&nbsp;{{$veh->model}}&nbsp;{{$veh->color}}</td>
							<td><span class="tag tag-info">{{$veh->vin}}</span></td>
							<td><span class="tag tag-warning">{{$veh->lot_number}}</span></td>
							<td><span class="tag tag-success">{{$veh->name}}</span></td>
							@if($veh->c_remark=='')
                            <td></td>
                            @else
                            <td style="background-color:#dd4b39;"><span style="padding:5px ;color:white;">{{$veh->c_remark}}<span/></td>
                             @endif
                            @if($veh->customer_note=='')
                            <td></td>
                            @else
                            <td style="background-color:#dd4b39;"><span style="padding:5px ;color:white;"><?=$veh->customer_note?><span/></td>
                            @endif
                            <td>{{$veh->purchase_date}}</td>
                            <td>{{@$veh->location}}</td>
                            <td>{{@$veh->dport}}</td>
                            <td>{{$veh->deliver_date}}</td>
                            <td>{{@$cont->container_number}}</td>
                            <td>{{@$cont->booking_number}}</td>
                            <td>{{$veh->title_number}}</td>
                            <td>{{$veh->title_state}}</td>
                            <td>{{@$veh->title_status}}</td>
							<td>{{@$cont->eta_port_discharge}}</td>
							<td><span class="tag tag-success">{{@$veh->type}}</span></td>
							<td class="column">
								@if($veh->car_keys!='' && $veh->radio!='')
								<a href="{{route('vehicle_condational_report_admin',$veh->id)}}" target="_blank" class="btn btn-danger btn-circle"><span class="fa fa-eye"></span></a>
								@else
								<a href="{{route('vehicle_condational_report_admin',$veh->id)}}" target="_blank" class="btn btn-primary btn-circle"><span class="fa fa-eye"></span></a>
								@endif
							</td>
							<td class="column">
	                           @if(strpos(@$veh->file,'http') === false)
	                            <a href="javascript:;" class="btn btn-secondary btn-circle"><i class="fa  fa-link"></i></a>
	                            @else
                                 <a target="_blank" href="{{$veh->file}}" class="btn btn-success btn-circle" download="download"><i class="fa  fa-link"></i></a>
                                @endif
							</td>
							@if(Auth::guard('admin')->user()->hasPermissions(['Admin','delete-vehicle']))
							<td>
								@if(@$veh->carstate_id!='5')
								<a onclick="javascript:return confirm('Are you sure you want to delete ?')" href="{{route('delete_vehicle_admin',$veh->id)}}" class="btn btn-warning btn-circle">
								 <span class='fa fa-trash'> </span>
								</a>
								@else
								<button class=" btn btn-warning btn-circle" disabled="disabled"><span class='fa fa-trash'> </span>
								</button>
								@endif
							</td>
							@endif
						</tr>
						@endforeach
					</tbody>
					<tfoot>
						<tr class="bottom">
							<th>#</th>
							@if(Auth::guard('admin')->user()->hasPermissions(['Admin','edit-vehicle']))
							<th class="column">Edit</th>
							@endif
<<<<<<< HEAD
							<th class="column">Photo</th>
=======
							<!-- <th class="column">Photo</th> -->
>>>>>>> parent of affd84d (Cleared the repo)
							<th class="column">Photo link</th>
							<th>Hat No</th>
							<th>Key present</th>
							<th>Vehicle Desc</th>
							<th>Vin No</th>
							<th>Lot No</th>
							<th>Company</th>
							<th>Customer remark</th>
							<th>Customer note</th>
							<th>Purchase date</th>
							<th>Point of loading</th>
							<th>Destination port</th>
							<th>Delivery date</th>
							<th>Container No</th>
							<th>Booking No</th>
							<th>Title No</th>
							<th>Title state</th>
							<th>Title status</th>
							<th>Arrive date</th>
							<th>Current status</th>
							<th class="column">Con rep</th>
							<th class="column">Auction inv</th>
							@if(Auth::guard('admin')->user()->hasPermissions(['Admin','delete-vehicle']))
							<th>Delete</th>
							@endif
						</tr>
					</tfoot>
<<<<<<< HEAD
				 </table>
				 @if(!empty($vehicles))
					{{ $vehicles->links()}}
					@endif
				</div>
	</div>
	</div>
		
=======
				</table>
				
				 @if(!empty($vehicles))
				{{ $vehicles->appends(Request::All())->links()}}
				@endif
		
			 
>>>>>>> parent of affd84d (Cleared the repo)

				



