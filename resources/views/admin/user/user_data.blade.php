			<table class="table table-bordered" id="example">
				<thead class="bg-info dataTable" id="table-2">
					<tr>
						<th width="5px;">#</th>
						<th width="40px">Photo</th>
						<th>Name</th>
						<th>Type</th>
						<th>Email</th>
						 @if(Auth::guard('admin')->user()->hasPermissions(['Admin','edit-user']))
                        <th width="50px">Edit</th>
                        @endif
                         @if(Auth::guard('admin')->user()->hasPermissions(['Admin','delete-user']))
                        <th width="50px">Delete</th>
                        @endif
					</tr>
				</thead>
				<tbody >
					<?php $id =1; ?>
					@foreach($users as $user)
					<tr id="searchBody">
						<td><?=$id++; ?></td>
						 <td>
	                       	<span class="avatar box-32">
	                       		<img src="{{ asset('images/user/',$user->photo) }}" onerror="this.src='{{asset('img/avatars/profile.png')}}'" style="width:40px; height:40px;">
	                       	</span>
                        </td>
                        <td>{{$user->username}}</td>
                        <td>{{$user->type}}</td>
                        <td>{{$user->email}}</td>
                        @if(Auth::guard('admin')->user()->hasPermissions(['Admin','edit-user']))
	                    <td>
	                   	<a href="#edit_user{{$user->id}}" class="btn btn-primary btn-circle" data-toggle="modal"><span class="fa fa-pencil"></span>
	                   	</a>
	                   </td>
	                   @endif
	                   @if(Auth::guard('admin')->user()->hasPermissions(['Admin','delete-user']))
	                   <td>
	                   	<a  class="btn btn-warning btn-circle" onclick="javascript:return confirm('Are you sure you want to delete ?')" href="{{route('delete_user_admin',$user->id)}}"><span class="fa fa-trash"></span>
	                   	</a>
	                   </td>
	                   @endif
					</tr>
					@include('admin.user.edit')
					@endforeach
				</tbody>
				<tfoot>
					<tr>
						<th>#</th>
						<th>Photo</th>
						<th>Name</th>
						<th>Type</th>
						<th>Email</th>
						 @if(Auth::guard('admin')->user()->hasPermissions(['Admin','edit-user']))
                        <th>Edit</th>
                        @endif
                         @if(Auth::guard('admin')->user()->hasPermissions(['Admin','delete-user']))
                        <th>Delete</th>
                        @endif
					</tr>
				</tfoot>
			</table>
			@if(!empty($users))
			{{ $users->appends(Request::All())->links()}}
			@endif
		</div>
	</div>
</div>
