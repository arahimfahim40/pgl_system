@extends('admin.layout.main')
@section('title','invoices')
<style type="text/css">
	label{
		font-weight: bold;
	}
</style>
@section('content')
<div class="site-content">
  <div class="content-area py-1">
	<div class="container-fluid"> 
		<div class="card">
			<div class="card-header clearfix">
				<h5 class="float-xs-left mb-0">Edit Customer</h5>
			   </div>
				 <div class="card-block">
                    <div class="row">
                    <form action="{{url('update_customer')}}" method="post" enctype="multipart/form-data">
                        {!! csrf_field() !!}
                    <div class="col-md-6">
                        <input type="hidden" name="id" value="{{isset($customer_find)? $customer_find->id : ''}}" />
                        <div class="form-group">
                            <label for="name">Customer Unique Id *</label>
                            <input type="text" name="uid" id="name" value="{{isset($customer_find)? $customer_find->customer_uniqe_id : ''}}" class="form-control" placeholder="customer Unique Id" />
                        </div>
                        <div class="form-group">
                            <label for="name">Customer Name *</label>
                            <input type="text" name="name" id="name" value="{{isset($customer_find)? $customer_find->customer_name : ''}}" class="form-control" placeholder="customer name" />
                        </div>
                        <div class="form-group">
                            <label for="phone">Select Company *</label>
                            <select name="company" class="form-control" id="">
                                <option value="{{isset($customer_find)? $customer_find->company_id : ''}}">

                                    <?php $com=DB::table('companies')->where('id',isset($customer_find)? $customer_find->company_id : '')->get() ;?>
                                    @foreach($com as $item)
                                 {{$item->name}}
                                    @endforeach
                                </option>
                                <?php $com=DB::table('companies')->get() ;?>
                                @foreach($com as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="address">Company Street Address</label>
                            <input type="text" name="address" value="{{isset($customer_find)? $customer_find->customer_address : ''}}" id="address" class="form-control" placeholder="customer Address" />
                        </div>
                        <div class="form-group">
                            <label for="address">Company City*</label>
                            <input type="text" name="city" value="{{isset($customer_find)? $customer_find->comp_city : ''}}" id="address" class="form-control" placeholder="company city" />
                        </div>
                        <div class="form-group">
                            <label for="address">Company Zip Code*</label>
                            <input type="text" name="zip" value="{{isset($customer_find)? $customer_find->  zip_code : ''}}" id="address" class="form-control" placeholder="company zip code" />
                        </div>
                        <div class="form-group">
                            <label for="address">Company Country*</label>
                            <input type="text" name="country" value="{{isset($customer_find)? $customer_find->country : ''}}" id="address" class="form-control" placeholder="company country" />
                        </div>
                        <div class="form-group">
                            <label for="phone">Customer Phone</label>
                            <input type="text" name="phone" value="{{isset($customer_find)? $customer_find->customer_phone : ''}}" id="phone" class="form-control" placeholder=" customer Phone" />
                        </div>
                        <div class="form-group">
                            <label for="phone">Customer Secondary Phone</label>
                            <input type="text" name="sphone" value="{{isset($customer_find)? $customer_find->secondry_phone : ''}}" id="phone" class="form-control" placeholder="Secondary Phone" />
                        </div>
                        <div class="form-group">
                            <label for="phone">Customer Since Date</label>
                            <input type="date" name="sdate" value="{{isset($customer_find)? $customer_find->customer_since_date : ''}}" id="phone" class="form-control" placeholder="customer Since Date" />
                        </div>
                        <div class="form-group">
                            <label for="phone">Preferred</label>
                            <input type="text" name="pref" value="{{isset($customer_find)? $customer_find->prefered : ''}}" id="phone" class="form-control" placeholder="" />
                        </div>

                        <div class="form-group">
                            <label for="phone">Customer Email</label>
                            <input type="email" name="email" value="{{isset($customer_find)? $customer_find->email : ''}}" id="phone" class="form-control" placeholder=" customer email" />
                        </div>
                        <div class="form-group">
                            <label for="phone">Customer Secondary Email</label>
                            <input type="email" name="semail" value="{{isset($customer_find)? $customer_find->sec_email : ''}}" id="phone" class="form-control" placeholder="customer secondary email" />
                        </div>
                        <input type="hidden" name="old_password" value="{{isset($customer_find)? $customer_find->password : ''}}">
                        <div class="form-group">
                            <label for="phone">Customer Password</label>
                            <input type="text" name="password"   id="phone" class="form-control" placeholder="new password" />
                        </div>
                        <input type="hidden" name="pname" value="{{isset($customer_find)? $customer_find->photo : ''}}" />
                        <div class="form-group">
                            <label for="gender">User Current Photo&nbsp;</label><br>
                            <img class="profile-user-img img-responsive img-circle img-md" src="/public/assets/images/{{isset($customer_find)? $customer_find->photo : ''}}" alt="customer profile picture">
                            <br>
                            <br>
                            <br>
                            <label for="gender">Chose New Photo&nbsp;</label><br>
                            <input type="file" name="photo" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label for="gender">Chose Gender</label><br>
                            <input type="radio" name="gender" checked value="male" {{$customer_find->damaged =='male' ? 'checked' :''}} />Male
                            <input type="radio" name="gender" value="female" {{$customer_find->damaged =='female' ? 'checked' :''}} />Female
                        </div>
                        <div class="form-group">
                                <label for="address">note</label>
                                <input type="text" name="note" value="{{@$customer_find->note}}" id="note" class="form-control" placeholder="note for customer" />
                            </div>
                        <div class="form-group">
                            <label for="gender">Chose Status</label><br>
                            <select name="status" class="form-control" id="">
                                <option value="{{isset($customer_find)? $customer_find->status : ''}}">@if(isset($customer_find)? $customer_find->customer_gender : ''=='0') De Active @else Active @endif</option>
                                <option value="1">Active</option>
                                <option value="0">De Active</option>
                            </select>
                        </div>
                    </div>
                    <!-- /.col -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="address">Consignee</label>
                                <input type="text" name="cons" value="{{isset($customer_find)? $customer_find->consignee : ''}}" id="address" class="form-control" placeholder="Consignee" />
                            </div>
                            <div class="form-group">
                                <label for="address">Consignee Street Address</label>
                                <input type="text" name="cons_street" value="{{isset($customer_find)? $customer_find->cons_street : ''}}" id="address" class="form-control" placeholder="Consignee street address" />
                            </div>
                            <div class="form-group">
                                <label for="address">Consignee PO. BOX </label>
                                <input type="text" name="cons_box" value="{{isset($customer_find)? $customer_find->cons_box : ''}}" id="address" class="form-control" placeholder="Consignee PO. BOX " />
                            </div>
                            <div class="form-group">
                                <label for="address">Consignee City </label>
                                <input type="text" name="cons_city" value="{{isset($customer_find)? $customer_find->cons_city : ''}}" id="address" class="form-control" placeholder="Consignee city " />
                            </div>
                            <div class="form-group">
                                <label for="address">Consignee Zip </label>
                                <input type="text" name="cons_zip" value="{{isset($customer_find)? $customer_find->cons_zip_code : ''}}" id="address" class="form-control" placeholder="Consignee Zip " />
                            </div>
                            <div class="form-group">
                                <label for="address">Consignee Country </label>
                                <input type="text" name="cons_country" value="{{isset($customer_find)? $customer_find->cons_country : ''}}" id="address" class="form-control" placeholder="Consignee Country " />
                            </div>
                            <div class="form-group">
                                <label for="address">Consignee Phone </label>
                                <input type="text" name="cons_phone" value="{{isset($customer_find)? $customer_find->cons_phone : ''}}" id="address" class="form-control" placeholder="Consignee phone " />
                            </div>
                            <div class="form-group">
                                <label for="address">Consignee Email </label>
                                <input type="text" name="cons_email" value="{{isset($customer_find)? $customer_find->cons_email : ''}}" id="address" class="form-control" placeholder="Consignee Email " />
                            </div>
                            <div class="form-group">
                                <label for="address">Consignee Fax Number </label>
                                <input type="text" name="cons_fax" value="{{isset($customer_find)? $customer_find->cons_fax : ''}}" id="address" class="form-control" placeholder="Consignee Fax Number " />
                            </div>
                            <div class="form-group">
                                <label for="address">Consignee POC </label>
                                <input type="text" name="cons_poc" value="{{isset($customer_find)? $customer_find->cons_poc : ''}}" id="address" class="form-control" placeholder="Consignee POC " />
                            </div>
                            <div class="form-group">
                                <label for="address">Notify Party </label>
                                <input type="text" name="notify_party" value="{{isset($customer_find)? $customer_find->notify_party : ''}}" id="address" class="form-control" placeholder="Notify Party " />
                            </div>
                            <div class="form-group">
                                <label for="address">Notify Party Street Address </label>
                                <input type="text" name="notify_street" value="{{isset($customer_find)? $customer_find->notify_street : ''}}" id="address" class="form-control" placeholder="Notify Party Street Address" />
                            </div>
                            <div class="form-group">
                                <label for="address">Notify Party PO. BOX  </label>
                                <input type="text" name="notify_box" value="{{isset($customer_find)? $customer_find->notify_box : ''}}" id="address" class="form-control" placeholder="Notify Party PO. BOX " />
                            </div>
                            <div class="form-group">
                                <label for="address">Notify Party City </label>
                                <input type="text" name="notify_city" value="{{isset($customer_find)? $customer_find->notify_city : ''}}" id="address" class="form-control" placeholder="Notify Party City" />
                            </div>
                            <div class="form-group">
                                <label for="address">Notify Party state </label>
                                <input type="text" name="notify_state" value="{{isset($customer_find)? $customer_find->notify_state : ''}}" id="address" class="form-control" placeholder="Notify Party State" />
                            </div>
                            <div class="form-group">
                                <label for="address">Notify Party Zip </label>
                                <input type="text" name="notify_zip" value="{{isset($customer_find)? $customer_find->notify_zip : ''}}" id="address" class="form-control" placeholder="Notify Party Zip" />
                            </div>
                            <div class="form-group">
                                <label for="address">Notify Party Country </label>
                                <input type="text" name="notify_country" value="{{isset($customer_find)? $customer_find->notify_country : ''}}" id="address" class="form-control" placeholder="Notify Party Country" />
                            </div>
                            <div class="form-group">
                                <label for="address">Notify Party Phone </label>
                                <input type="text" name="notify_phone" value="{{isset($customer_find)? $customer_find->notify_phone : ''}}" id="address" class="form-control" placeholder="Notify Party Phone" />
                            </div>
                            <div class="form-group">
                                <label for="address">Notify Party Email </label>
                                <input type="text" name="notify_email" value="{{isset($customer_find)? $customer_find->notify_email : ''}}" id="address" class="form-control" placeholder="Notify Party Email" />
                            </div>
                            <div class="form-group">
                                <label for="address">Notify Party Fax Number </label>
                                <input type="text" name="notify_fax"  value="{{isset($customer_find)? $customer_find->notify_fax : ''}}" id="address" class="form-control" placeholder="Notify Party Fax Number" />
                            </div>
                            <div class="form-group">
                                <label for="address">Notify Party POC </label>
                                <input type="text" name="notify_poc" value="{{isset($customer_find)? $customer_find->notify_poc : ''}}" id="address" class="form-control" placeholder="Notify Party POC" />
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="phone">Customer About</label>
                                <textarea rows="10" type="text" name="description"  id="phone" class="form-control" placeholder="enter description" >{{isset($customer_find)? $customer_find->about : ''}}</textarea>
                            </div>
                        </div>
                    <!-- /.col -->

                </div>
                <!-- /.row -->

  
            </div>
            <!-- /.box-body -->
		<div class="card-footer clearfix">
			<button type="submit" class="btn btn-info btn-rounded label-left float-xs-left">
				<span class="btn-label"><i class="ti-save"></i></span>
				Edit
			</button>
		</div>
	 </div>
    </form>
	</div>
  </div>
</div>		
@stop

