		<table class="table table-bordered" id="example">
				<thead class="bg-info dataTable" id="table-2">
					<tr>
						<th width="2px;">#</th>
						<th>Location Name</th>
						@if(Auth::guard('admin')->user()->hasPermissions(['Admin','edit-location']))
                        <th width="20px;">Edit</th>
                        @endif
                        @if(Auth::guard('admin')->user()->hasPermissions(['Admin','delete-location']))
                        <th width="20px;">Delete</th>
                        @endif
					</tr>
				</thead>
				<tbody >
					<?php $id =1; ?>
					@foreach($locations as $location)
					<tr id="searchBody">
						<td><?=$id++; ?></td>
                        <td>{{$location->location}}</td>
                        @if(Auth::guard('admin')->user()->hasPermissions(['Admin','edit-location']))
	                   <td>
	                   	<a href="#edit_location{{$location->id}}" class="btn btn-primary btn-circle" data-toggle="modal"><span class="fa fa-pencil"></span>
	                   	</a>
	                   </td>
	                   @endif
	                   @if(Auth::guard('admin')->user()->hasPermissions(['Admin','delete-location']))
	                   <td>
	                   	<a  class="btn btn-warning btn-circle" onclick="javascript:return confirm('Are you sure you want to delete ?')" href="{{route('delete_location_admin',$location->id)}}"><span class="fa fa-trash"></span>
	                   	</a>
	                   </td>
	                   @endif
					</tr>
					<!-- Edit location modal -->
					<div class="modal fade small-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="edit_location{{$location->id}}">
						<div class="modal-dialog modal-md">
							<form class="form" action="{{route('edit_location_admin')}}" method="post">
								@csrf
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">×</span>
										</button>
										<h4 class="modal-title">Edit location</h4>
									</div>
									<div class="modal-body">
										<div class="form-group">
											<label>location name</label>
											<input type="text" name="location_name" class="form-control" value="{{$location->location}}">
										</div>
										<input type="hidden" name="location_id" value="{{$location->id}}">
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
						<th>Location Name</th>
						@if(Auth::guard('admin')->user()->hasPermissions(['Admin','edit-location']))
                        <th width="20px;">Edit</th>
                        @endif
                        @if(Auth::guard('admin')->user()->hasPermissions(['Admin','delete-location']))
                        <th width="20px;">Delete</th>
                        @endif
					</tr>
				</tfoot>
			</table>
			@if(!empty($locations))
			{{ $locations->appends(Request::All())->links()}}
			@endif
		</div>
	</div>
</div>
<!-- add location modal -->
<div class="modal fade small-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="add_location">
	<div class="modal-dialog modal-md">
		<form class="form" action="{{route('add_location_admin')}}" method="post">
			@csrf
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
					<h4 class="modal-title">Add location</h4>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label>location name</label>
						<input type="text" name="location_name" class="form-control">
					</div>
					<input type="hidden" name="location_id">
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary">Add</button>
					<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
				</div>
			</div>
		</form>
	</div>
</div>
