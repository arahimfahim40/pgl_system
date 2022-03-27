<!-- change shipment status modal -->

<div class="modal fade small-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="change_status">
	<div class="modal-dialog modal-md">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
					<h4 class="modal-title">Change vehicle status</h4>
				</div>
				<div class="modal-body">
								<?php $containers=DB::table('containers')->orderBy('id','DESC')->where('status',0)->orWhere('status',3)->get(); ?>
                  <div class="form-group">
                  	<label>Select Container</label>
                     <select class="form-control" name="container" id="container">
                     	@foreach($containers as $container)
                     	<option value="{{$container->id}}"> {{$container->booking_number}}</option>
                     	@endforeach
                     </select>
                 </div>
				<div class="modal-footer" style="text-align:center !important;">
					<button type="submit" class="btn btn-primary btn-rounded" id="change-all-1">Add</button>
					<button type="button" class="btn btn-danger btn-rounded" data-dismiss="modal">Close</button>
				</div>
			</div>
	</div>
</div>