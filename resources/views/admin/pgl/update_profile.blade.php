<!-- Edit company modal -->
<div class="modal fade small-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="update">
	<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
					<h4 class="modal-title">Update PGL Profile</h4>
				</div>
				<div class="modal-body">
				  <div class="row">
                     <form action="{{url('update_pgl_profile')}}" method="post" enctype="multipart/form-data" id="pgl_prfile">
                        {!! csrf_field() !!}
                        <div class="col-md-6">
                            <input type="hidden" name="id" value="{{isset($comp_profile)? $comp_profile->id : ''}}" />
                            <div class="form-group">
                                <label for="name">Company Name *</label>
                                <input type="text" name="name" id="name" value="{{isset($comp_profile)? $comp_profile->name : ''}}" class="form-control" placeholder="name" />
                            </div>
                            <div class="form-group">
                                <label for="name">PGL Street Address *</label>
                                <input type="text" name="street" id="name" value="{{isset($comp_profile)? $comp_profile->street : ''}}" class="form-control" placeholder="street" />
                            </div>
                            <div class="form-group">
                                <label for="address">PGL City</label>
                                <input type="text" name="city" value="{{isset($comp_profile)? $comp_profile->city : ''}}" id="address" class="form-control" placeholder="city" />
                            </div>
                            <div class="form-group">
                                <label for="address">PGL State*</label>
                                <input type="text" name="state" value="{{isset($comp_profile)? $comp_profile->state : ''}}" id="address" class="form-control" placeholder="state" />
                            </div>
                            <div class="form-group">
                                <label for="address">PGL Zip Code*</label>
                                <input type="text" name="zip" value="{{isset($comp_profile)? $comp_profile->zip_code : ''}}" id="address" class="form-control" placeholder="zip" />
                            </div>
                            <div class="form-group">
                                <label for="address">PGL Email*</label>
                                <input type="text" name="email" value="{{isset($comp_profile)? $comp_profile->email : ''}}" id="address" class="form-control" placeholder="email" />
                            </div>
                            <div class="form-group">
                                <label for="phone">PGL Phone</label>
                                <input type="text" name="phone" value="{{isset($comp_profile)? $comp_profile->phone : ''}}" id="phone" class="form-control" placeholder=" phone" />
                            </div>
                            <div class="form-group">
                                <label for="phone">PGL Fax</label>
                                <input type="text" name="fax" value="{{isset($comp_profile)? $comp_profile->fax : ''}}" id="phone" class="form-control" placeholder="fax" />
                            </div>
                            <div class="form-group">
                                <label for="phone">PGL Website</label>
                                <input type="text" name="website" value="{{isset($comp_profile)? $comp_profile->website : ''}}" id="phone" class="form-control" placeholder="website" />
                            </div>
                            <div class="form-group">
                                <label for="phone">PGL Facebook</label>
                                <input type="text" name="facebook" value="{{isset($comp_profile)? $comp_profile->facebook : ''}}" id="phone" class="form-control" placeholder="facebook" />
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-md-6">


                            <div class="form-group">
                                <label for="phone">Bank Name</label>
                                <input type="text" name="bname" value="{{isset($comp_profile)? $comp_profile->bank_name : ''}}" id="phone" class="form-control" placeholder="Bank Name" />
                            </div>
                            <div class="form-group">
                                <label for="phone">Account Name</label>
                                <input type="text" name="a_name" value="{{isset($comp_profile)? $comp_profile->account_name : ''}}" id="phone" class="form-control" placeholder="Account Name" />
                            </div>
                            <div class="form-group">
                                <label for="address">Bank Account Number</label>
                                <input type="text" name="a_number" value="{{isset($comp_profile)? $comp_profile->account_number : ''}}" id="address" class="form-control" placeholder="Account Number" />
                            </div>
                            <div class="form-group">
                                <label for="address">ABA Routing</label>
                                <input type="text" name="aba" value="{{isset($comp_profile)? $comp_profile->aba : ''}}" id="address" class="form-control" placeholder="ABA Routing" />
                            </div>
                            <div class="form-group">
                                <label for="address">SWIFT Code</label>
                                <input type="text" name="swift" value="{{isset($comp_profile)? $comp_profile->swift : ''}}" id="address" class="form-control" placeholder="swift code" />
                            </div>
                            <div class="form-group">
                                <label for="address">Bank Street Address</label>
                                <input type="text" name="b_street" value="{{isset($comp_profile)? $comp_profile->b_street : ''}}" id="address" class="form-control" placeholder="Bank Street Address " />
                            </div>
                            <div class="form-group">
                                <label for="address">Bank City</label>
                                <input type="text" name="b_city" value="{{isset($comp_profile)? $comp_profile->b_city : ''}}" id="address" class="form-control" placeholder="Bank City " />
                            </div>
                            <div class="form-group">
                                <label for="address">Bank State </label>
                                <input type="text" name="b_state" value="{{isset($comp_profile)? $comp_profile->b_state : ''}}" id="address" class="form-control" placeholder="Bank State " />
                            </div>
                            <div class="form-group">
                                <label for="address">Bank Zip Code </label>
                                <input type="text" name="b_zip" value="{{isset($comp_profile)? $comp_profile->b_zip : ''}}" id="address" class="form-control" placeholder="Bank Zip Code" />
                            </div>
                            <div class="form-group">
                                <label for="address">Bank Country </label>
                                <input type="text" name="b_country" value="{{isset($comp_profile)? $comp_profile->b_country : ''}}" id="address" class="form-control" placeholder="Bank Country" />
                            </div>
                        </div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary btn-rounded update_profile">Update</button>
					<button type="button" class="btn btn-danger btn-rounded" data-dismiss="modal">Close</button>
				</div>
			</div>
		</form>
	</div>
</div>