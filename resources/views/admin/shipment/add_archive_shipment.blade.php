<div class="modal fade small-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="add_archive{{$item->id}}">
	<div class="modal-dialog modal-md">
		<form class="form" action="{{route('add_archive_shipment')}}" method="post">
			@csrf
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
					<h4 class="modal-title">Update Archive Title </h4>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label> Reference Number</label>
						<input type="text" name="reference_no" class="form-control" value="{{@$item->title_archive_reference_no}}">
					</div>
					<div class="form-group">
						<label>Note</label>
						<textarea class="form-control" rows="5" name="note">{{@$item->title_archive_note}}</textarea>
					</div>
					<input type="hidden" name="id" value="{{$item->id}}">
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary">Add</button>
					<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
				</div>
			</div>
		</form>
	</div>
</div>