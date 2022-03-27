			<table class="table table-bordered" id="example">
				<thead class="bg-info">
					<tr>
						<th>#</th>
						@if(Auth::guard('admin')->user()->hasPermissions(['Admin','edit-shipment']))
						<th>Edit</th>
						@endif
						@if($status !='10')
						@if(Auth::guard('admin')->user()->hasPermissions(['Admin','add-status']))
						<th>Select</th>
						@endif
						@endif
						<th>BOL</th>
						<th>DR</th>
						<th>Photo link</th>
						<th>Booking no</th>
						<th>Container no</th>
						<th>Note</th>
						<th>Customer note</th>
						<th>Company</th>
						<th>Size</th>
						<th>Loading port</th>
						<th>Discharge port</th>
						<th>Number of unites</th>
						<th>Status</th>
						<th>Loading date</th>
						<th>ETD</th>
						<th>ETA</th>
						<th>Invoice</th>
						<th>Amount</th>
						@if($status==1)
						<th>Release document</th>
						@endif
						@if($status==10)
						<th>Customer form</th>
						@endif
						@if($status !=1 and $status !=2 and $status!=10)
						<th>Vessel name</th>
						@endif
						@if($status==10)
						@if(Auth::guard('admin')->user()->hasPermissions(['Admin','delete-shipment']))
						<th>Delete</th>
						@endif
						@if(Auth::guard('admin')->user()->hasPermissions(['Admin','add-shipment']))
						<th>Duplicate</th>
						@endif	
						@endif
					</tr>
				</thead>
				<tbody >
					<?php $id =1; ?>
					@foreach($shipments as $item)
					<tr id="searchBody">
						<td><?=$id++; ?></td>
						@if(Auth::guard('admin')->user()->hasPermissions(['Admin','edit-shipment']))
                            <td>
                            	<a href="{{route('edit_shipment',$item->id)}}" class="btn btn-info btn-circle waves-effect waves-light"><span class="fa fa-pencil"></span>
                            	</a>
                            </td>
                            @endif
                            @if($status !='10')
                            @if(Auth::guard('admin')->user()->hasPermissions(['Admin','add-status']))
							<td> 
								<input type="checkbox" class="checkbox" data-id={{$item->id}}"> 
							</td>
							@endif
							@endif
                            <td>
                            	<a target="_blank" href="{{route('bol_admin',$item->id)}}">BOL</a>
                            </td>
                            <td>
                            	<a target="_blank" href="{{route('dock_recepit_admin',$item->id)}}">DR</a>
                            </td>
                            <td>
                              <?php
                              $label='tag-info';
                               if(@$item->photo_link=='') $label='tag-warning';?>
                                <a href="{{@$item->photo_link}}" target="_blank" style="text-align: center; font-size: 20px;"><span class="ti-image  <?=$label?>"></span></a>
                            </td>
                            <td>{{$item->booking_number}}</td>
                            <td>{{$item->container_number}}</td>
						    @if(@$item->actions=='')
                            <td></td>
                            @else
                            <td  style="background-color:#dd4b39;"><span style="padding:5px ;color:white;">{{$item->actions}}<span/></td>
                            @endif
                            <td><?=$item->customer_note?></td>
						    <td><span class="tag tag-success">{{$item->company_name}}</span></td>
                            <td>{{$item->c_size}}</td>
                            <td>{{$item->port_loading}}</td>
                            <td>{{$item->port_discharge}}</td>
                            <td ><span class="">{{$item->n_units_load}}</span></td>
							<td>
                                <?php 
                                if($item->status==0) { ?>
                                    <span class="tag tag-info">At Loading</span>
                                <?php } elseif($item->status==1) { ?>
                                    <span class="tag tag-warning">On the way</span>
                                <?php } elseif($item->status==2) { ?>
                                    <span class="tag tag-success">Arrived</span>
                                <?php } elseif($item->status==3) { ?>
                                    <span class="tag tag-danger">Pending</span>
                                <?php } elseif($item->status==4){ ?> 
                                	<span class="tag tag-primary">Checked</span> 
                                <?php } elseif($item->status==5){ ?>
                                	<span class="tag tag-success">Final Checked</span> 
                                <?php } ?>
                            </td>
                            <td>{{$item->loading_date}}</td>
                            <td><a href="#etd{{$item->id}}" data-toggle="modal" id="td{{$item->id}}">{{$item->etd_port_loading}}</a></td>
                             <td><a href="#eta{{$item->id}}" data-toggle="modal" id="tda{{$item->id}}">{{$item->eta_port_discharge}}</td>
                            <td>{{$item->inv_number}}</td>
							<td>{{$item->amount}}</td>
							@if($status==1)
							<td><a target="_blank" href="{{route('release_document_admin',$item->id)}}">RD</a></td>
							@endif
							@if($status==10)
                            <td><a target="_blank" class="btn btn-primary btn-sm btn-rounded" href="{{route('custom_form_admin',$item->id)}}" >C.F</a>
                            </td>
                            @endif
                            @if($status !=1 and $status !=2 and $status!=10)
                            <td>{{$item->vessel_name}}</td>
                            @endif
                            @if($status==10)
                            @if(Auth::guard('admin')->user()->hasPermissions(['Admin','delete-shipment']))
                            <td>
                            	@if (DB::table('tbl_bases')->where('container_id', '=', $item->id)->exists())
                            	<a  onclick="javascript: return alert('This Shipment can not be deleted,because it is an active shipment!')" class="btn btn-secondary btn-circle waves-effect waves-light"><span class="fa fa-trash"></span></a>
                            	@else
                            	<a href="{{route('delete_shipment',$item->id)}}" onclick="javascript: return confirm('Dou you want to delte this container ?')" class="btn btn-warning btn-circle waves-effect waves-light"><span class="fa fa-trash"></span></a>
                            	@endif

                            </td>
                            @endif
                            @if(Auth::guard('admin')->user()->hasPermissions(['Admin','add-shipment']))
                            <td>
                            	<a href="{{route('duplicate_shipment',$item->id)}}" class="btn btn-info btn-rounded">Duplicate</a>
                            </td>
                            @endif
                            @endif   
					</tr>
					@include('admin.shipment.eta')
					@include('admin.shipment.etd')
					@endforeach
				</tbody>
				<tfoot>
					<tr>
						<th>#</th>
						@if(Auth::guard('admin')->user()->hasPermissions(['Admin','edit-shipment']))
						<th>Edit</th>
						@endif
						@if($status !='10')
						@if(Auth::guard('admin')->user()->hasPermissions(['Admin','add-status']))
						<th>Select</th>
						@endif
						@endif
						<th>BOL</th>
						<th>DR</th>
						<th>Photo link</th>
						<th>Booking no</th>
						<th>Container no</th>
						<th>Note</th>
						<th>Customer note</th>
						<th>Company</th>
						<th>Size</th>
						<th>Loading port</th>
						<th>Discharge port</th>
						<th>Number of unites</th>
						<th>Status</th>
						<th>Loading date</th>
						<th>ETD</th>
						<th>ETA</th>
						<th>Invoice</th>
						<th>Amount</th>
						@if($status==1)
						<th>Release document</th>
						@endif
						@if($status==10)
						<th>Customer form</th>
						@endif
						@if($status !=1 and $status !=2 and $status!=10)
						<th>Vessel name</th>
						@endif
						@if($status==10)
						@if(Auth::guard('admin')->user()->hasPermissions(['Admin','delete-shipment']))
						<th>Delete</th>
						@endif
						@if(Auth::guard('admin')->user()->hasPermissions(['Admin','add-shipment']))
						<th>Duplicate</th>
						@endif	
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
