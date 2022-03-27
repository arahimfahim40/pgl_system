			<table class="table table-bordered" id="example">
				<thead class="bg-info dataTable" id="table-2">
					<tr>
						<th width="5px;">#</th>
						<th>Name</th>
                        <th>Action</th>
					</tr>
				</thead>
				<tbody >
					<?php $id =1; ?>
					@foreach($companies as $company)
					<tr id="searchBody">
						<td><?=$id++; ?></td>
                        <td>{{$company->name}}</td>
	                   <td>
                   		@if(Auth::guard('admin')->user()->hasPermissions(['Admin','edit-customer']))
	                   	<a href="#edit_company{{$company->id}}" class="btn btn-primary btn-circle" data-toggle="modal"><span class="fa fa-pencil"></span>
	                   	</a>
	                   	@endif
	                   	@if(Auth::guard('admin')->user()->hasPermissions(['Admin','delete-customer']))
	                   	<a  class="btn btn-warning btn-circle" onclick="javascript:return confirm('Are you sure you want to delete ?')" href="{{route('delete_company_admin',$company->id)}}"><span class="fa fa-trash"></span>
	                   	</a>
	                   	@endif
	                   </td>
					</tr>
					<!-- Edit company modal -->
					<div class="modal fade small-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="edit_company{{$company->id}}">
						<div class="modal-dialog modal-md">
							<form class="form" action="{{route('edit_company_admin')}}" method="post">
								@csrf
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">×</span>
										</button>
										<h4 class="modal-title">Edit company</h4>
									</div>
									<div class="modal-body">
										<div class="form-group">
											<label>Company name</label>
											<input type="text" name="company_name" class="form-control" value="{{$company->name}}">
										</div>
										<input type="hidden" name="company_id" value="{{$company->id}}">
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
						<th>#</th>
						<th>Name</th>
                        <th>Action</th>
					</tr>
				</tfoot>
			</table>
			@if(!empty($companies))
			{{ $companies->appends(Request::All())->links()}}
			@endif
		</div>
	</div>
</div>
<!-- add company modal -->
<div class="modal fade small-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="add_company">
	<div class="modal-dialog modal-md">
		<form class="form" action="{{route('add_company_admin')}}" method="post">
			@csrf
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
					<h4 class="modal-title">Add company</h4>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label>Company name</label>
						<input type="text" name="company_name" class="form-control">
					</div>
					<input type="hidden" name="company_id">
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary">Add</button>
					<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
				</div>
			</div>
		</form>
	</div>
</div>
