<!-- Edit company modal -->
<div class="modal fade small-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="change_status">
	<div class="modal-dialog modal-md">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
					<h4 class="modal-title">Change Invoice status</h4>
				</div>
				<div class="modal-body">
                    <div class="form-group">
                    	 @if(@$status !=4)
                       <input type="radio" name="inv_status" value="4" id="pending" class="inv_status">
                       Pending &nbsp;&nbsp;
                       @endif
                       @if(@$status !=0)
                       <input type="radio" name="inv_status" value="0" id="open" class="inv_status">
                       Open &nbsp;&nbsp;
                       @endif
                       @if(@$status !=2)
                       <input type="radio" name="inv_status" value="2" id="past_due" class="inv_status">
                       Past due &nbsp;&nbsp;
                       @endif
                        @if(@$status !=3)
                       <input type="radio" name="inv_status" value="3" id="paid" class="inv_status">
                       Paid
                       @endif
                   </div>
				<div class="modal-footer" style="text-align:center !important;">
					<button type="button" class="btn btn-primary btn-rounded" id="change-all">Change</button>
					<button type="button" class="btn btn-danger btn-rounded" data-dismiss="modal">Close</button>
				</div>
			</div>
	</div>
</div>