<table class="table table-bordered" id="example">
				<thead class="bg-info dataTable" id="table-2">
					<tr>
						<th width="2px;">#</th>
						<th>status Name</th>
						@if(Auth::guard('admin')->user()->hasPermissions(['Admin','edit-status']))
                        <th width="20px;">Edit</th>
                        @endif
                        @if(Auth::guard('admin')->user()->hasPermissions(['Admin','delete-status']))
                        <th width="20px;">Delete</th>
                        @endif
					</tr>
				</thead>
				<tbody >
					<?php $id =1; ?>
					@foreach($statuss as $status)
					<tr id="searchBody">
						<td><?=$id++; ?></td>
                        <td>{{$status->type}}</td>
                        @if(Auth::guard('admin')->user()->hasPermissions(['Admin','edit-status']))
	                   <td>
	                   	<a href="#edit_status{{$status->id}}" class="btn btn-primary btn-circle" data-toggle="modal"><span class="fa fa-pencil"></span>
	                   	</a>
	                   </td>
	                   @endif
	                   @if(Auth::guard('admin')->user()->hasPermissions(['Admin','delete-status']))
	                   <td>
	                   	<a  class="btn btn-warning btn-circle" onclick="javascript:return confirm('Are you sure you want to delete ?')" href="{{route('delete_status_admin',$status->id)}}"><span class="fa fa-trash"></span>
	                   	</a>
	                   </td>
	                   @endif
					</tr>
					<!-- Edit status modal -->
					<div class="modal fade small-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="edit_status{{$status->id}}">
						<div class="modal-dialog modal-md">
							<form class="form" action="{{route('edit_status_admin')}}" method="post">
								@csrf
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">×</span>
										</button>
										<h4 class="modal-title">Edit status</h4>
									</div>
									<div class="modal-body">
										<div class="form-group">
											<label>status name</label>
											<input type="text" name="status_name" class="form-control" value="{{$status->type}}">
										</div>
										<input type="hidden" name="status_id" value="{{$status->id}}">
									</div>
									<div class="modal-footer">
										<button type="submit" class="btn btn-primary">Edit</button>
										<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
									</div>
								</div>
							</form>
						</div>
					</div>
					@endforeach
				</tbody>
				<tfoot>
					<tr>
						<th width="2px;">#</th>
						<th>status Name</th>
						@if(Auth::guard('admin')->user()->hasPermissions(['Admin','edit-status']))
                        <th width="20px;">Edit</th>
                        @endif
                        @if(Auth::guard('admin')->user()->hasPermissions(['Admin','delete-status']))
                        <th width="20px;">Delete</th>
                        @endif
					</tr>
				</tfoot>
			</table>
			@if(!empty($statuss))
			{{ $statuss->appends(Request::All())->links()}}
			@endif
		</div>
	</div>
</div>
<!-- add status modal -->
<div class="modal fade small-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="add_status">
	<div class="modal-dialog modal-md">
		<form class="form" action="{{route('add_status_admin')}}" method="post">
			@csrf
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
					<h4 class="modal-title">Add status</h4>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label>status name</label>
						<input type="text" name="status_name" class="form-control">
					</div>
					<input type="hidden" name="status_id">
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary">Add</button>
					<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
				</div>
			</div>
		</form>
	</div>
</div>
