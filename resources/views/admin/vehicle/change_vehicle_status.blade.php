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
               <!-- <div class="loading" id="loading" style='position:fixed; margin-left:38%; z-index: 100000'><img width='40px' src="{{asset('img/loading.gif')}}" alt='Loading ...'> 
              </div>  -->
                    <div class="form-group">
                       <input type="radio" name="inv_status" value="2"  class="vehicle_status">
                       On hand no/title &nbsp;&nbsp;
                       <input type="radio" name="inv_status" value="3"  class="vehicle_status">
                       On hand with/title &nbsp;&nbsp;
                       <input type="radio" name="inv_status" value="6"  class="vehicle_status">
                       Pending &nbsp;&nbsp;
                   </div>
				<div class="modal-footer" style="text-align:center !important;">
					<button type="button" class="btn btn-primary btn-rounded" id="change-all">Change</button>
					<button type="button" class="btn btn-danger btn-rounded" data-dismiss="modal">Close</button>
				</div>
			</div>
	</div>
</div>