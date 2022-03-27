
				<table class="table table-bordered" id="example">
					<thead class="bg-primary thead-dark">
						<tr>
							<th>#</th>
							<th class="column">Photo</th>
							<th class="column">Photo link</th>
							<th>Key present</th>
							<th>Vehicle Desc</th>
							<th>Vin No</th>
							<th>Lot No</th>
							<th>Title status</th>
							<th>Customer remark</th>
							<th>Purchase date</th>
							<th>Point of loading</th>
							<th>Delivery date</th>
							<th>Container no</th>
							<th>Ship date</th>
							<th>Arrive date</th>
							<th>Current status</th>
							<th class="column">Con rep</th>
							<th class="column">Auction inv</th>
							<th>Note</th>
						</tr>
					</thead>
				   <tbody >
						<?php $id =1; ?>
						@foreach($vehicles as $veh)
						<?php $cont=DB::table('tbl_bases')->join('containers','tbl_bases.container_id','containers.id')->where('tbl_bases.vehicle_id',$veh->id)->first();
						?>
						<tr id="searchBody">
							<td>{{$id++}}</td>
							<td class="column">
                              <?php
                              $label='tag-info';
                               if(strpos($veh->link,'http') === false) $label='tag-warning';?>
                                <a href="{{route('vehicle_photo_customer',$veh->id)}}" style="text-align: center; font-size: 25px;"><span ><img src="{{asset('img/icon.png')}}" style="height: 40px;"><p style="display: none">{{$veh->link}}</p></span></a>
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
							<td>
								@if(@$veh->is_key==2)
	                            <span class="tag tag-warning">No</span>
	                            @elseif(@$veh->is_key==1)
	                            <span class="tag tag-success">Yes</span>
	                            @else
	                            <span></span>
	                            @endif
							</td>
							<td>{{$veh->year}}&nbsp;{{$veh->make}}&nbsp;{{$veh->model}}&nbsp;{{$veh->color}}</td>
							<td><span class="tag tag-primary">{{$veh->vin}}</span></td>
							<td><span class="tag tag-info">{{$veh->lot_number}}</span></td>
							<td>{{@$veh->title_status}}</td>
						    <td>{{@$veh->c_remark}}</td>
	                        <td>{{$veh->purchase_date}}</td>
							<td>{{@$veh->location}}</td>
							<td>{{$veh->deliver_date}}</td>
							<td>{{@$cont->container_number}}</td>
							<td>{{@$cont->etd_port_loading}}</td>
							<td>{{@$cont->eta_port_discharge}}</td>
							<td><span class="tag tag-primary">{{@$veh->type}}</span></td>
							<td class="column">
								<a href="{{route('vehicle_condational_report_customer',$veh->id)}}" target="_blank" class="btn btn-primary"><span class="fa fa-eye"></span></a></td>
							<td class="column">
	                           @if(strpos(@$veh->file,'http') === false)
	                            <a href="javascript:;" class="btn btn-secondary btn-circle"><i class="fa  fa-link"></i></a>
	                            @else
                                 <a target="_blank" href="{{$veh->file}}" class="btn btn-success btn-circle" download="download"><i class="fa  fa-link"></i></a>
                                @endif
							</td>
							<td>
								<a href="#addnotemodal" data-toggle="modal" id="{{$veh->id}}" class="addnote">
								<?=@$veh->customer_note!='' ? @$veh->customer_note : "<span class='fa fa-pencil'> note</span>"?>
							</td>
						</tr>
						@endforeach
					</tbody>
					<tfoot>
						<tr class="bottom">
							<th>#</th>
							<th class="column">Photo</th>
							<th class="column">Photo link</th>
							<th>Key present</th>
							<th>Vehicle Desc</th>
							<th>Vin No</th>
							<th>Lot No</th>
							<th>Title status</th>
							<th>Customer remark</th>
							<th>Purchase date</th>
							<th>Point of loading</th>
							<th>Delivery date</th>
							<th>Container no</th>
							<th>Ship date</th>
							<th>Arrive date</th>
							<th>Current status</th>
							<th class="column">Con rep</th>
							<th class="column">Auction inv</th>
							<th>Note</th>
						</tr>
					</tfoot>
				 </table>
				 @if(!empty($vehicles))
					{{ $vehicles->links()}}
					@endif
				</div>
	</div>
	</div>
		

				



