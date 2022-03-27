			<table class="table table-bordered" id="example">
				<thead class="bg-info dataTable" id="table-2">
					<tr>
						<th>#</th>
                        <th>Photo</th>
                        <th>Company</th>
                        <th>Customer ID</th>
                        <th>Company POC Name</th>
                        <th>Phone</th>
                        <th>Email Address</th>
                        <th>Physical Address</th>
                        <th>Status</th>
                        @if(Auth::guard('admin')->user()->hasPermissions(['Admin','view-customer']))
                        <th>View Customer</th>
                        @endif
                        @if(Auth::guard('admin')->user()->hasPermissions(['Admin','edit-customer']))
                        <th>Edit</th>
                        @endif
                        @if(Auth::guard('admin')->user()->hasPermissions(['Admin','delete-customer']))
                        <th>Del</th>
                        @endif
					</tr>
				</thead>
				<tbody >
					<?php $id =1; ?>
					@foreach($customers as $customer)
					<tr id="searchBody">
						<td><?=$id++; ?></td>
                       <td>
                       	<span class="avatar box-32">
                       	<img src="{{ asset('images/',$customer->photo) }}" onerror="this.src='{{asset('img/avatars/profile.png')}}'" style="height:40px">
                       	</span>
                       </td>
	                    <td>{{@$customer->name}}</td>
	                    <td>{{$customer->customer_uniqe_id}}</td>
	                    <td>{{$customer->customer_name}}</td>
	                    <td>{{$customer->customer_phone}}</td>
	                    <td>{{$customer->email}}</td>
	                    <td>
	                        {{$customer->customer_address}}&nbsp;,&nbsp;{{$customer->comp_city}}&nbsp;,&nbsp;{{$customer->zip_code}},&nbsp;{{$customer->country}}
	                    </td>
	                    <td>
	                        @if($customer->status==0)
	                            <span class="tag tag-danger">De Active</span>
	                        @else
	                            <span class="tag tag-primary">Active</span>
	                        @endif
	                    </td>
	                    @if(Auth::guard('admin')->user()->hasPermissions(['Admin','view-customer']))
	                    <td>
	                        <a href="#" class="btn btn-info btn-circle"><i class="fa fa-eye"></i></a>
	                    </td>
	                    @endif
	                    @if(Auth::guard('admin')->user()->hasPermissions(['Admin','edit-customer']))
	                   <td>
		                   	<a href="{{route('edit_customer_admin',$customer->id)}}" class="btn btn-primary btn-circle"><span class="fa fa-pencil"></span>
		                   	</a>
		                </td>
		                @endif
		                @if(Auth::guard('admin')->user()->hasPermissions(['Admin','delete-customer']))
		                <td>
		                   	<a  class="btn btn-warning btn-circle" onclick="javascript:return confirm('Are you sure you want to delete ?')" href="{{route('delete_customer_admin',$customer->id)}}"><span class="fa fa-trash"></span>
		                   	</a>
		                </td> 
		                @endif
					</tr>
					@endforeach
				</tbody>
				<tfoot>
					<tr>
						<th>#</th>
                        <th>Photo</th>
                        <th>Company</th>
                        <th>Customer ID</th>
                        <th>Company POC Name</th>
                        <th>Phone</th>
                        <th>Email Address</th>
                        <th>Physical Address</th>
                        <th>Status</th>
                        @if(Auth::guard('admin')->user()->hasPermissions(['Admin','view-customer']))
                        <th>View Customer</th>
                        @endif
                        @if(Auth::guard('admin')->user()->hasPermissions(['Admin','edit-customer']))
                        <th>Edit</th>
                        @endif
                        @if(Auth::guard('admin')->user()->hasPermissions(['Admin','delete-customer']))
                        <th>Del</th>
                        @endif
					</tr>
				</tfoot>
			</table>
			@if(!empty($customers))
			{{ $customers->appends(Request::All())->links()}}
			@endif
		</div>
	</div>
</div>
<!-- add company modal -->
@include('admin.customer.add_customer')