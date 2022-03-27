<!-- Edit company modal -->
<div class="modal fade small-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="edit_shipping_rate{{$item->id}}">
	<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
					<h4 class="modal-title">Edit shipping rate</h4>
				</div>
				<div class="modal-body">
					<div class="row">
                   <div class="col-md-12 col-md-offset-0">
                       <form action="{{route('update_shipping_rate_admin')}}" method="post" enctype="multipart/form-data">
                           {!! csrf_field() !!}
                    <div class="col-md-12">
                        <input type="hidden" name="id" value="{{@$item->id }}">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">From port</label>
                            <input type="text" name="from_port" id="name" value="{{@$item->from_port}}" class="form-control" placeholder="From port" />
                        </div>

                        <div class="form-group">
                            <label for="name">To port</label>
                            <input type="text" name="to_port" value="{{@$item->to_port}}"  class="form-control" placeholder="To port" />
                        </div>
                        <div class="form-group">
                            <label for="name">Cargo</label>
                            <input type="text" name="cargo"  value="{{@$item->cargo}}" class="form-control" placeholder="Cargo" />
                        </div>


                    </div>
                    <!-- /.col -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Old price</label>
                            <input type="text" name="old_price" value="{{@$item->old_price}}"  class="form-control" placeholder="Old price" />
                        </div>

                        <div class="form-group">
                            <label for="name">Change date</label>
                            <input type="date" name="change_date" value="{{@$item->change_date }}"  class="form-control" placeholder="Change date" />
                        </div>

                        <div class="form-group">
                            <label for="name">New price</label>
                            <input type="text" name="new_price" value="{{@$item->new_price }}"  class="form-control" placeholder="New price" />
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Note</label>
                            <textarea name="note" id="" cols="30" rows="5" class="textarea wysihtml5-editor placeholder form-control"><?=@$item->note?></textarea>
                        </div>
                    </div>
                    </div>
                    <!-- /.col -->

                </div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary btn-rounded">Edit</button>
					<button type="button" class="btn btn-danger btn-rounded" data-dismiss="modal">Close</button>
				</div>
			</div>
		</form>
	</div>
</div>