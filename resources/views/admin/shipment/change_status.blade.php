<!-- change shipment status modal -->
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
                    	 @if(@$status !=3)
                       <input type="radio" name="inv_status" value="3"  class="ship_status">
                       Pending &nbsp;&nbsp;
                       @endif
                       @if(@$status !=0)
                       <input type="radio" name="inv_status" value="0"  class="ship_status">
                       At loading &nbsp;&nbsp;
                       @endif
                       @if(@$status !=4 and $status!=3)
                       <input type="radio" name="inv_status" value="4"  class="ship_status">
                       Checked &nbsp;&nbsp;
                       @endif
                       @if(@$status !=5 and $status!=0 and $status!=1 and $status!=2 and $status!=3)
                       <input type="radio" name="inv_status" value="5"  class="ship_status">
                       Final checked &nbsp;&nbsp;
                       @endif
                       @if(@$status !=1 and $status!=3)
                       <input type="radio" name="inv_status" value="1"  class="ship_status">
                       On the way &nbsp;&nbsp;
                       @endif
                       @if(@$status !=2 and $status!=3)
                       <input type="radio" name="inv_status" value="2"  class="ship_status">
                       Arrived
                       @endif
                   </div>
				<div class="modal-footer" style="text-align:center !important;">
					<button type="button" class="btn btn-primary btn-rounded" id="change-all">Change</button>
					<button type="button" class="btn btn-danger btn-rounded" data-dismiss="modal">Close</button>
				</div>
			</div>
	</div>
</div>