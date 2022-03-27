<<<<<<< HEAD
			<table class="table table-bordered" id="example">
				<thead class="bg-info">
					<tr>
						<th width="1%">#</th>
=======
            <table class="table table-bordered"  id="example">
                <thead class="bg-info">
                    <tr>
                        <th width="1%">#</th>
>>>>>>> parent of affd84d (Cleared the repo)
                        <th style="text-align: left;">Company</th>
                        <th class="first">Note</th>
                        <th>Pending</th>
                        <th>On The Way</th>
                        <th>On Hand No/Title</th>
                        <th>On Hand With/Title</th>
                        <th>Total</th>
                        <th>Shipped</th>
                        <th>Total</th>
<<<<<<< HEAD
					</tr>
				</thead>
				<tbody >
					<?php $id =1;
						$pending=0;
=======
                    </tr>
                </thead>
                <tbody >
                    <?php $id =1;
                        $pending=0;
>>>>>>> parent of affd84d (Cleared the repo)
                        $on_the_way=0;
                        $on_hand_no_title=0;
                        $on_hand_with_title=0;
                        $total_on_hand=0;
                        $shipped=0;
                        
                        $t_pending=0;
                        $t_on_the_way=0;
                        $t_on_hand_no_title=0;
                        $t_on_hand_with_title=0;
                        $t_total_on_hand=0;
                        $t_shipped=0;
                        $t_all_total=0;
<<<<<<< HEAD

                        $check=0;
					 ?>
					@foreach($customers as $item)
=======
                     ?>
                    @foreach($customers as $item)
>>>>>>> parent of affd84d (Cleared the repo)
                    @if(@$filter)
                    <?php  
                        $check=DB::table('vehicles')
                            ->where(['company_id'=>$item->id])
                            ->whereIn('carstate_id',[1,2,3,6])
                            ->count(); 
                            if($check <= 0) {continue;} 

                        ?> 
                    @endif   
<<<<<<< HEAD
					<tr id="searchBody">
						<td>{{$id++}}</td>
						<td style="text-align: left;">{{$item->name}}</td>
						<td>{{$item->note}}</td>
						<td>
=======
                    <tr id="searchBody">
                        <td>{{$id++}}</td>
                        <td style="text-align: left;">{{$item->name}}</td>
                        <td>{{$item->note}}</td>
                        <td>
>>>>>>> parent of affd84d (Cleared the repo)
                            <a href="{{url('vehicle_summary_search',[$item->id,'6',@$location])}}">
                                <?php  $pending=DB::table('vehicles')
                                ->where(['company_id'=>$item->id,'carstate_id'=>6])
                                ->when(@$location > 0,
                                    function($q) use ($location){
                                        return $q->where('vehicles.location_id','=', @$location);
                                    }
<<<<<<< HEAD
                                )->count(); echo $pending; ?>	
=======
                                )->count(); echo $pending; ?>   
>>>>>>> parent of affd84d (Cleared the repo)
                              </a>
                        </td>
                        <td>
                            <a href="{{url('vehicle_summary_search',[$item->id,'1',@$location])}}">
                                <?php  $on_the_way=DB::table('vehicles')
                                ->where(['company_id'=>$item->id,'carstate_id'=>1])
                                ->when(@$location > 0,
                                    function($q) use ($location){
                                        return $q->where('vehicles.location_id','=', @$location);
                                    }
<<<<<<< HEAD
                                )->count(); echo $on_the_way; ?>	
=======
                                )->count(); echo $on_the_way; ?>    
>>>>>>> parent of affd84d (Cleared the repo)
                              </a>
                        </td>
                        <td>
                            <a href="{{url('vehicle_summary_search',[$item->id,'2',@$location])}}">
                                <?php  $on_hand_no_title=DB::table('vehicles')
                                ->where(['company_id'=>$item->id,'carstate_id'=>2])
                                ->when(@$location > 0,
                                    function($q) use ($location){
                                        return $q->where('vehicles.location_id','=', @$location);
                                    }
<<<<<<< HEAD
                                )->count(); echo $on_hand_no_title; ?>	
=======
                                )->count(); echo $on_hand_no_title; ?>  
>>>>>>> parent of affd84d (Cleared the repo)
                              </a>
                        </td>
                        <td>
                            <a href="{{url('vehicle_summary_search',[$item->id,'3',@$location])}}">
                                <?php  $on_hand_with_title=DB::table('vehicles')
                                ->where(['company_id'=>$item->id,'carstate_id'=>3])
                                ->when(@$location > 0,
                                    function($q) use ($location){
                                        return $q->where('vehicles.location_id','=', @$location);
                                    }
<<<<<<< HEAD
                                )->count(); echo $on_hand_with_title; ?>	
=======
                                )->count(); echo $on_hand_with_title; ?>    
>>>>>>> parent of affd84d (Cleared the repo)
                              </a>
                        </td>
                        <td >
                            <a href="{{url('vehicle_summary_search',[$item->id,'10',@$location])}}">
                            <?=$on_the_way+$on_hand_no_title+$on_hand_with_title;?>
                            </a>
                        </td>
                        <td>
                            <a href="{{url('vehicle_summary_search',[$item->id,'5',@$location])}}">
                                <?php  $shipped=DB::table('vehicles')
                                ->where(['company_id'=>$item->id,'carstate_id'=>5])
                                ->when(@$location > 0,
                                    function($q) use ($location){
                                        return $q->where('vehicles.location_id','=', @$location);
                                    }
<<<<<<< HEAD
                                )->count(); echo $shipped; ?>	
=======
                                )->count(); echo $shipped; ?>   
>>>>>>> parent of affd84d (Cleared the repo)
                              </a>
                        </td>
                        <td>
                            <a href="{{url('vehicle_summary_search',[$item->id,'0',@$location])}}">
                            <?=$pending+$on_the_way+$on_hand_no_title+$on_hand_with_title+$shipped;?>
                            </a>
                        </td>     
<<<<<<< HEAD
					</tr>
					<?php
						$t_pending+=$pending; 
						$t_on_the_way+=$on_the_way;
						$t_on_hand_no_title+=$on_hand_no_title;
						$t_on_hand_with_title+=$on_hand_with_title;
						$t_shipped+=$shipped;
						$t_total_on_hand+=$on_the_way+$on_hand_no_title+$on_hand_with_title;
					?>
					@endforeach
				</tbody>
				<tfoot>
					<tr>
						<td></td>
                        <td style="text-align: left;"><b>total</b></td>
                        <td></td>
                        <td>
                        	<b>
	                        	<a href="{{url('vehicle_summary_search',['0','6',@$location])}}">
	                            {{$t_pending}}
	                            </a>
                        	</b>
                       </td>
                       <td>
                        	<b>
	                        	<a href="{{url('vehicle_summary_search',['0','1',@$location])}}">
	                            {{$t_on_the_way}}
	                            </a>
                        	</b>
                       </td>
                       <td>
                        	<b>
	                        	<a href="{{url('vehicle_summary_search',['0','2',@$location])}}">
	                            {{$t_on_hand_no_title}}
	                            </a>
                        	</b>
                       </td>
                       <td>
                        	<b>
	                        	<a href="{{url('vehicle_summary_search',['0','3',@$location])}}">
	                            {{$t_on_hand_with_title}}
	                            </a>
                        	</b>
                       </td>
                       <td>
                        	<b>
	                        	<a href="{{url('vehicle_summary_search',['0','10',@$location])}}">
	                            {{$t_on_the_way+$t_on_hand_no_title+$t_on_hand_with_title}}
	                            </a>
                        	</b>
                       </td>
                       <td>
                        	<b>
	                        	<a href="{{url('vehicle_summary_search',['0','5',@$location])}}">
	                            {{$t_shipped}}
	                            </a>
                        	</b>
                       </td>
                       <td>
                        	<b>
	                        	<a href="{{url('all_vehicles_admin')}}">
	                            {{$t_pending+$t_on_the_way+$t_on_hand_no_title+$t_on_hand_with_title+$t_shipped}}
	                            </a>
                        	</b>
                       </td>
					</tr>
				</tfoot>
			</table>
		</div>
	</div>
=======
                    </tr>
                    <?php
                        $t_pending+=$pending; 
                        $t_on_the_way+=$on_the_way;
                        $t_on_hand_no_title+=$on_hand_no_title;
                        $t_on_hand_with_title+=$on_hand_with_title;
                        $t_shipped+=$shipped;
                        $t_total_on_hand+=$on_the_way+$on_hand_no_title+$on_hand_with_title;
                    ?>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td></td>
                        <td style="text-align: left;"><b>total</b></td>
                        <td></td>
                        <td>
                            <b>
                                <a href="{{url('vehicle_summary_search',['0','6',@$location])}}">
                                {{$t_pending}}
                                </a>
                            </b>
                       </td>
                       <td>
                            <b>
                                <a href="{{url('vehicle_summary_search',['0','1',@$location])}}">
                                {{$t_on_the_way}}
                                </a>
                            </b>
                       </td>
                       <td>
                            <b>
                                <a href="{{url('vehicle_summary_search',['0','2',@$location])}}">
                                {{$t_on_hand_no_title}}
                                </a>
                            </b>
                       </td>
                       <td>
                            <b>
                                <a href="{{url('vehicle_summary_search',['0','3',@$location])}}">
                                {{$t_on_hand_with_title}}
                                </a>
                            </b>
                       </td>
                       <td>
                            <b>
                                <a href="{{url('vehicle_summary_search',['0','10',@$location])}}">
                                {{$t_on_the_way+$t_on_hand_no_title+$t_on_hand_with_title}}
                                </a>
                            </b>
                       </td>
                       <td>
                            <b>
                                <a href="{{url('vehicle_summary_search',['0','5',@$location])}}">
                                {{$t_shipped}}
                                </a>
                            </b>
                       </td>
                       <td>
                            <b>
                                <a href="{{url('all_vehicles_admin')}}">
                                {{$t_pending+$t_on_the_way+$t_on_hand_no_title+$t_on_hand_with_title+$t_shipped}}
                                </a>
                            </b>
                       </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
>>>>>>> parent of affd84d (Cleared the repo)
</div>
