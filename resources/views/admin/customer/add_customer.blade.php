<div class="modal fade large-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="add_customer">
	<div class="modal-dialog modal-lg">
		<form class="form" action="{{route('add_customer_admin')}}" method="post" enctype="multipart/form-data">
			@csrf
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
					<h4 class="modal-title">Add customer</h4>
				</div>
				<div class="modal-ody">
                      <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Customer  Id *</label>
                                <input type="text" required name="uid" id="name" class="form-control" placeholder="customer unique Id" />
                            </div>
                            <div class="form-group">
                                <label for="name">Company POC  Name *</label>
                                <input type="text" required name="name" id="name" class="form-control" placeholder="customer name" />
                            </div>
                            <div class="form-group">
                                <label for="phone">Select Company *</label>
                                <select name="company" class="form-control" id="select2-demo-1" data-plugin="select2">
                                    <option ></option>
                                    <?php $com=DB::table('companies')->get() ;?>
                                    @foreach($com as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                  @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="address">Company Street Address*</label>
                                <input type="text" name="address" id="address" class="form-control" placeholder="customer address" />
                            </div>
                            <div class="form-group">
                                <label for="address">Company City*</label>
                                <input type="text" name="city" id="address" class="form-control" placeholder="company city" />
                            </div>
                            <div class="form-group">
                                <label for="address">Company Zip Code*</label>
                                <input type="text" name="zip" id="address" class="form-control" placeholder="company zip code" />
                            </div>
                            <div class="form-group">
                                <label for="address">Company Country*</label>
                                <input type="text" name="country" id="address" class="form-control" placeholder="company country" />
                            </div>
                            <div class="form-group">
                                <label for="address">Email *</label>
                                <input type="email" required name="email" id="address" class="form-control" placeholder="customer email" />
                            </div>
                            <div class="form-group">
                                <label for="address">Password *</label>
                                <input type="password" required name="password" id="address" class="form-control" placeholder=" customer password" />
                            </div>
                            <div class="form-group">
                                <label for="address">Secondary Email </label>
                                <input type="email" name="semail" id="address" class="form-control" placeholder=" customer secondary email" />
                            </div>
                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <input type="text" name="phone" id="phone" class="form-control" placeholder=" customer phone" />
                                </div>
                            <div class="form-group">
                                <label for="phone"> Secondary Phone</label>
                                <input type="text" name="sphone" id="phone" class="form-control" placeholder=" customer secondary phone" />
                            </div>
                            <div class="form-group">
                                <label for="phone">Means of Contact </label>
                                <input type="text" name="pref" id="phone" class="form-control" placeholder="" />
                            </div>
                            <div class="form-group">
                                <label for="phone">Since Date</label>
                                <input type="date" name="sdate" id="phone" class="form-control" placeholder=" customer date" />
                            </div>
                            <div class="form-group">
                                <label for="gender">Gender</label><br>
                                <input type="radio" name="gender" checked value="male" />Male
                                <input type="radio" name="gender" value="female" />Female
                                <br>
                                <label for="photo">Chose Photo *</label>
                                <input type="file"  name="photo" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label for="phone">About </label>
                                <textarea type="text" name="description" id="phone" class="form-control" placeholder="about customer" ></textarea>
                            </div>
                             <div class="form-group">
                                <label for="address">Note</label>
                                <input type="text" name="note" id="note" class="form-control" placeholder="note for customer" />
                            </div>
                            <div class="form-group">
                                <label for="phone">Select Status</label>
                                <select name="status" class="form-control" id="">
                                    <option value="1">Active</option>
                                    <option value="0">De Active</option>
                                </select>
                            </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="address">Consignee</label>
                                    <input type="text" name="cons" id="address" class="form-control" placeholder="Consignee" />
                                </div>
                                <div class="form-group">
                                    <label for="address">Consignee Street Address</label>
                                    <input type="text" name="cons_street" id="address" class="form-control" placeholder="Consignee street address" />
                                </div>
                                <div class="form-group">
                                    <label for="address">Consignee PO. BOX </label>
                                    <input type="text" name="cons_box" id="address" class="form-control" placeholder="Consignee PO. BOX " />
                                </div>
                                <div class="form-group">
                                    <label for="address">Consignee City </label>
                                    <input type="text" name="cons_city" id="address" class="form-control" placeholder="Consignee city " />
                                </div>
                                <div class="form-group">
                                    <label for="address">Consignee Zip </label>
                                    <input type="text" name="cons_zip" id="address" class="form-control" placeholder="Consignee Zip " />
                                </div>
                                <div class="form-group">
                                    <label for="address">Consignee Country </label>
                                    <input type="text" name="cons_country" id="address" class="form-control" placeholder="Consignee Country " />
                                </div>
                                <div class="form-group">
                                    <label for="address">Consignee Phone </label>
                                    <input type="text" name="cons_phone" id="address" class="form-control" placeholder="Consignee phone " />
                                </div>
                                <div class="form-group">
                                    <label for="address">Consignee Email </label>
                                    <input type="text" name="cons_email" id="address" class="form-control" placeholder="Consignee Email " />
                                </div>
                                <div class="form-group">
                                    <label for="address">Consignee Fax Number </label>
                                    <input type="text" name="cons_fax" id="address" class="form-control" placeholder="Consignee Fax Number " />
                                </div>
                                <div class="form-group">
                                    <label for="address">Consignee POC </label>
                                    <input type="text" name="cons_poc" id="address" class="form-control" placeholder="Consignee POC " />
                                </div>
                                <div class="form-group">
                                    <label for="address">Notify Party </label>
                                    <input type="text" name="notify_party" id="address" class="form-control" placeholder="Notify Party " />
                                </div>
                                <div class="form-group">
                                    <label for="address">Notify Party Street Address </label>
                                    <input type="text" name="notify_street" id="address" class="form-control" placeholder="Notify Party Street Address" />
                                </div>
                                <div class="form-group">
                                    <label for="address">Notify Party PO. BOX  </label>
                                    <input type="text" name="notify_box" id="address" class="form-control" placeholder="Notify Party PO. BOX " />
                                </div>
                                <div class="form-group">
                                    <label for="address">Notify Party City </label>
                                    <input type="text" name="notify_city" id="address" class="form-control" placeholder="Notify Party City" />
                                </div>
                                <div class="form-group">
                                    <label for="address">Notify Party state </label>
                                    <input type="text" name="notify_state" id="address" class="form-control" placeholder="Notify Party State" />
                                </div>
                                <div class="form-group">
                                    <label for="address">Notify Party Zip </label>
                                    <input type="text" name="notify_zip" id="address" class="form-control" placeholder="Notify Party Zip" />
                                </div>
                                <div class="form-group">
                                    <label for="address">Notify Party Country </label>
                                    <input type="text" name="notify_country" id="address" class="form-control" placeholder="Notify Party Country" />
                                </div>
                                <div class="form-group">
                                    <label for="address">Notify Party Phone </label>
                                    <input type="text" name="notify_phone" id="address" class="form-control" placeholder="Notify Party Phone" />
                                </div>
                                <div class="form-group">
                                    <label for="address">Notify Party Email </label>
                                    <input type="text" name="notify_email" id="address" class="form-control" placeholder="Notify Party Email" />
                                </div>
                                <div class="form-group">
                                    <label for="address">Notify Party Fax Number </label>
                                    <input type="text" name="notify_fax" id="address" class="form-control" placeholder="Notify Party Fax Number" />
                                </div>
                                <div class="form-group">
                                    <label for="address">Notify Party POC </label>
                                    <input type="text" name="notify_poc" id="address" class="form-control" placeholder="Notify Party POC" />
                                </div>
                        </div>
				 </div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-info btn-rounded label-left float-xs-left">
                        <span class="btn-label"><i class="ti-save"></i></span>
                        Save
                    </button>
					<button type="button" class="btn btn-danger btn-rounded" data-dismiss="modal">Close</button>
				</div>
			</div>
		</form>
	</div>
</div>
