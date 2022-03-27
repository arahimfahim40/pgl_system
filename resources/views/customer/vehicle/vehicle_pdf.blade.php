<link rel="stylesheet" href="{{asset('assets/bootstrap4/css/bootstrap.min.css')}}">
<div class="site-content">
  <div class="content-area py-1">
	<div class="container-fluid"> 
		<div class=" bg-white table-responsive">
				<div class="site" id="user_data">
					<table class="table">
					<thead class="bg-info">
						<tr>
							<th>#</th>
							<th>Photo</th>
							<th>Photo link</th>
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
							<th>Con rep</th>
							<th>Auction inv</th>
							<th>Note</th>
						</tr>
					</thead>
				   <tbody >
						<?php $id =1; ?>
						@foreach($vehicles as $veh)
						<tr id="searchBody">
							<td>{{$id++}}</td>
							<td></td>
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
							<td>{{$veh->year}}&nbsp;{{$veh->make}}&nbsp;{{$veh->model}}&nbsp;{{$veh->color}}</td>
							<td><span class="tag tag-success">{{$veh->vin}}</span></td>
							<td><span class="tag tag-primary">{{$veh->lot_number}}</span></td>
							<td>{{@$veh->title_status}}</td>
						    <td>{{@$veh->c_remark}}</td>
	                        <td>{{$veh->purchase_date}}</td>
							<td>{{@$veh->location}}</td>
							<td>{{$veh->deliver_date}}</td>
							<td>{{$veh->container_number}}</td>
							<td>{{$veh->etd_port_loading}}</td>
							<td>{{$veh->eta_port_discharge}}</td>
							<td><span class="tag tag-info">{{$veh->type}}</span></td>
							<td><a href="{{route('vehicle_condational_report_customer',$veh->id)}}" target="_blank" class="btn btn-warning"><span class="fa fa-eye"></span></a></td>
							<td><a class="btn btn-success"><span class="fa fa-eye"></span></a></td>
							<td>
								<a href="#addnotemodal" data-toggle="modal" id="{{$veh->id}}" class="addnote">
								<?=@$veh->customer_note!='' ? @$veh->customer_note : "<span class='fa fa-pencil'> note</span>"?>
							</td>
						</tr>
						@endforeach
					</tbody>
				 </table>
				</div>
	</div>
	</div>
</div>	
</div>


