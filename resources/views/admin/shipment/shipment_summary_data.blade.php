			<table class="table table-bordered">
				<thead class="bg-info">
					<tr>
						<th width="1%">#</th>
                        <th style="text-align: left;">Company</th>
                        <th>Pending</th>
                        <th>Checked</th>
                        <th>At Loading</th>
                        <th>On The Way</th>
                        <th>Arrived</th>
                        <th>Total</th>
					</tr>
				</thead>
				<tbody >
					<?php $id =1;
						$pending=0;
                        $checked=0;
                        $loading=0;
                        $onway=0;
                        $arrived=0;
                        
                        $tpending=0;
                        $tchecked=0;
                        $tloading=0;
                        $tonway=0;
                        $tarrived=0;
					 ?>
					@foreach($shipments as $item)
					<tr id="searchBody">
						<td>{{$id++}}</td>
						<td style="text-align: left;">{{$item->name}}</td>
						<td>
							<?php                  
                             $pending=DB::table('containers')
                             ->where(['status'=>3,'company_id'=>$item->cid])
							 ->count();
                             $tpending+=$pending;
                             ?> 
                            <a href="{{ url('shipment_summary_search/ ' . $item->cid . '/'. 3)}}">{{$pending}}</a>
						</td>
						<td>
							<?php                  
                             $checked=DB::table('containers')
                             ->where(['status'=>4,'company_id'=>$item->cid])
							 ->count();
                             $tchecked+=$checked;
                             ?> 
                            <a href="{{ url('shipment_summary_search/ ' . $item->cid . '/'. 4)}}">{{$checked}}</a>
						</td>
						<td>
							<?php                  
                             $loading=DB::table('containers')
                             ->where(['status'=>0,'company_id'=>$item->cid])
							 ->count();
                             $tloading+=$loading;
                             ?> 
                            <a href="{{ url('shipment_summary_search/ ' . $item->cid . '/'. 0)}}">{{$loading}}</a>
						</td>
						<td>
							<?php                  
                             $onway=DB::table('containers')
                             ->where(['status'=>1,'company_id'=>$item->cid])
							 ->count();
                             $tonway+=$onway;
                             ?> 
                            <a href="{{ url('shipment_summary_search/ ' . $item->cid . '/'. 1)}}">{{$onway}}</a>
						</td>
						<td>
							<?php                  
                             $arrived=DB::table('containers')
                             ->where(['status'=>2,'company_id'=>$item->cid])
							 ->count();
                             $tarrived+=$arrived;
                             ?> 
                            <a href="{{ url('shipment_summary_search/ ' . $item->cid . '/'. 2)}}">{{$arrived}}</a>
						</td>
						<td>
							<a href="{{ url('shipment_summary_search/ ' . $item->cid . '/' . 5)}}"><?=$loading+$onway+$arrived+$pending+$checked;?></a>
						</td>        
					</tr>
					@endforeach
				</tbody>
				<tfoot>
					<tr>
						<td></td>
                        <td style="text-align: left;"><b>total</b></td>
                        <td><b><?=$tpending?></b></td>
                        <td><b><?=$tchecked?></b></td>
                        <td><b><?=$tloading?></b></td>
                        <td><b><?=$tonway?></b></td>
                        <td><b><?=$tarrived?></b></td>
                        <td><b><?=$tpending+$tchecked+$tloading+$tonway+$tarrived?></b></td>
					</tr>
				</tfoot>
			</table>
		</div>
	</div>
</div>
