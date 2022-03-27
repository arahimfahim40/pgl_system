
			<table class="table table-bordered">
				<thead class="bg-primary">
					<tr>
						<th>#</th>
						<th>Vehicle Desc</th>
						<th>Vin No</th>
						<th>Container no</th>
						<th>Vehicle cost</th>
						<th>Tow</th>
						<th>Dismental</th>
						<th>Ship</th>
						<th>Strg POL</th>
						<th>Strg POD</th>
						<th>Custom</th>
						<th>Other cost</th>
						<th>Description</th>
						<th>Total</th>
						<th>Sale</th>
						<th>Prof/Lose</th>
						<th>Percent profit</th>
					</tr>
				</thead>
				<tbody >
					<?php $id =1;
					 $sum=0;$sum1=0;$sum2=0;$sum3=0;
					 $sum4=0;$sum5=0;$sum6=0;$sum7=0;
					 $sum8=0;$sum9=0;$sum10=0;$sum11=0;
					 $sum12=0; $id = 1; $idR = 0; $idR1=0;$sum_pod=0;
					 ?>
					@foreach($vehicles as $veh)
					<tr id="searchBody">
						<td>{{$id++}}</td>
						<td>{{$veh->year}}&nbsp;{{$veh->make}}&nbsp;{{$veh->model}}&nbsp;{{$veh->color}}</td>
						<td><span class="tag tag-info">{{$veh->vin}}</span></td>
						<td><span class="tag tag-info">{{@$veh->container_number}}</span></td>
                        <td>${{@$veh->vehicle_price}}</td>
                        <td>${{@$veh->tow_amounts}}</td>
                        <td>${{@$veh->dismantal_cost}}</td>
                        <td>${{@$veh->ship_cost}}</td>               
						<td>${{@$veh->pgl_storage_costs}}</td>
						<td>{{@$veh->storage_pod_cost}}</td>
						<td>${{@$veh->dubai_custom_cost}}</td>
						<td>${{@$veh->other_cost}}</td>
						<td>{{@$veh->invoice_description}}</td>								
						<td>${{@$veh->total_cost}}</td>
						<td>${{@$veh->sales_cost}}</td>
						<td>${{@$veh->profit}}</td>
						<td>{{($veh->percent_profit!='') ? $veh->percent_profit ." %" : ''}}</td>
					</tr>
					<?php  $sum=$sum+$veh->total_cost; 
					   $sum1=$sum1+$veh->vehicle_price; 
					   $sum2=$sum2+$veh->tow_amounts; 
					   $sum3=$sum3+$veh->dismantal_cost; 
					   $sum4=$sum4+$veh->ship_cost;
					   // $sum5=$sum5+@$veh->auction_storage_cost; 
					   $sum6=$sum6+$veh->pgl_storage_costs; 
					   $sum_pod=$sum_pod+$veh->storage_pod_cost; 
					   // $sum7=$sum7+@$veh->dubai_demurage; 
					   // $sum8=$sum8+$veh->dubai_storage_cost; 
					   $sum9=$sum9+$veh->dubai_custom_cost; 
					   $sum10=$sum10+$veh->other_cost; 
					   $sum11=$sum11+$veh->sales_cost; 
					   $sum12=$sum12+$veh->profit; ?>
					@endforeach
				</tbody>
				<tfoot>
					<tr>
						<td >Total</td>
						<td></td>
						<td class=""></td>
						<td class=""></td>
						<!--<td class="hide"></td>-->
						<td class="">@if(!empty($sum1))$<?php echo  $sum1; ?>@else @endif</td>
						<td class="">@if(!empty($sum2))$<?php echo  $sum2; ?>@else @endif</td>
						<td class="">@if(!empty($sum3))$<?php echo  $sum3; ?>@else @endif</td>
						<td class="">@if(!empty($sum4))$<?php echo  $sum4; ?>@else @endif</td>
						<td class="">@if(!empty($sum6))$<?php echo  $sum6; ?>@else @endif</td>
						<td class="">@if(!empty($sum_pod))$<?php echo  $sum_pod; ?>@else @endif</td>
						<td class="">@if(!empty($sum9))$<?php echo  $sum9; ?>@else @endif</td>
						<td class="">@if(!empty($sum10))$<?php echo  $sum10; ?>@else @endif</td>
						<td> </td>
						<!--<td> </td>-->
						<td class="">@if(!empty($sum))$<?php echo  $sum; ?>@else @endif</td>
						<td class="">@if(!empty($sum11))$<?php echo  $sum11; ?>@else @endif</td>
						<td class="">@if(!empty($sum12))$<?php echo  $sum12; ?>@else @endif</td>
						<td class=""></td>	
					</tr>
				</tfoot>
			</table>
			@if(!empty($vehicles))
			{{ $vehicles->links()}}
			@endif
		</div>
	</div>
</div>