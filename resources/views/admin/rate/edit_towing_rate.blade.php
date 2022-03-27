<!-- Edit company modal -->
<div class="modal fade small-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="edit_towing_rate{{$item->id}}">
	<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
					<h4 class="modal-title">Edit Towing rate</h4>
				</div>
				<div class="modal-body">
					<div class="row">
                       <form action="{{route('update_towing_rate_admin')}}" method="post" enctype="multipart/form-data">
                           {!! csrf_field() !!}
	                    <div class="col-md-12">
	                        <input type="hidden" name="id" value="{{@$item->id}}">
	                    <div class="col-md-6">
	                        <div class="form-group">
	                            <label for="name">State</label>
	                            <input type="text" name="state" id="name" value="{{@$item->state}}" class="form-control" placeholder="state" />
	                        </div>

	                        <div class="form-group">
	                            <label for="name">Branch / Location</label>
	                            <input type="text" name="branch" value="{{@$item->branch}}"  class="form-control" placeholder="branch" />
	                        </div>
	                        <div class="form-group">
	                            <label for="name">City</label>
	                            <input type="text" name="city"  value="{{@$item->city}}" class="form-control" placeholder="city" />
	                        </div>
	                    </div>
	                    <!-- /.col -->
	                    <div class="col-md-6">
	                        <div class="form-group">
	                            <label for="name">Towing cost</label>
	                            <input type="text" name="towing_cost" value="{{@$item->towing_cost}}"  class="form-control" placeholder="Towing cost" />
	                        </div>

	                        <div class="form-group">
	                            <label for="name">Change date</label>
	                            <input type="date" name="change_date" value="{{@$item->change_date}}"  class="form-control" placeholder="Change date" />
	                        </div>

	                        <div class="form-group">
	                            <label for="name">New cost</label>
	                            <input type="text" name="new_price" value="{{@$item->new_cost}}"  class="form-control" placeholder="New cost" />
	                        </div>
	                    </div>
	                    <div class="col-md-12">
	                        <div class="form-group">
	                            <label for="">Note</label>
	                            <textarea name="note" id="" cols="30" rows="5" class="textarea wysihtml5-editor placeholder form-control"><?=@$item->note?></textarea>
	                        </div>
	                    </div>
	                    </div>
                <!-- /.row -->
           		 </div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary btn-rounded"><i class="fa fa-save"></i>&nbsp;Edit</button>
					<button type="button" class="btn btn-danger btn-rounded" data-dismiss="modal">Close</button>
				</div>
			</div>
		</form>
	</div>
</div>