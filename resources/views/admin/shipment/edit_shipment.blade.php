@extends('admin.layout.main')
@section('title','Shipments')
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
					<h5 class="float-xs-left mb-0">Edit Shipment</h5>
				</div>
				<div class="card-block">
					<div class="row mb-2">	
				 <!-- row -->
                <div class="row">
                    <div class="col-md-12 col-md-offset-0">
                        <form action="{{url('update_shipment')}}" method="post" enctype="multipart/form-data">
                            {!! csrf_field() !!}
                            <div class="col-md-12">
                                <input type="hidden" name="id" value="{{@$container->id}}">
                                <div class="col-md-6">
                                    <?php $row=DB::table('users')
                                         ->where('id',@$container->create_by)->first(); ?>
                                    <div class="form-group">
                                        <label>Created By:</label>
                                        <input type="text" name="reported" readonly="" class="form-control" placeholder="Created By" value="{{@$row->username}}">
                                        <!-- /.input group -->
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="name">Booking Number</label>
                                        <input type="text" name="book_number" value="{{@$container->booking_number}}" id="name" class="form-control" placeholder="book number" />
                                    </div>

                                    <div class="form-group">
                                        <label for="name">AES ITN Number</label>
                                        <input type="text" value="{{
                                            @$container->aes_itn_number}}" name="itn_number"  class="form-control" placeholder="AES ITN Number" />
                                    </div>
                                    <div class="form-group">
                                        <label for="name"> Container Number</label>
                                        <input type="text" value="{{@$container->container_number}}" name="cont_number"  class="form-control" placeholder=" Container Number" />
                                    </div>
                                    <div class="form-group">
                                        <label for="name"> Bill of Lading Number</label>
                                        <input type="text" value="{{@$container->bolading_number}}" name="lading_number"  class="form-control" placeholder="Bill of Lading Number" />
                                    </div>
                                    <div class="form-group">
                                        <label for="name"> PGL Reference Number</label>
                                        <input type="text" value="{{@$container->pglr_number}}" name="pgl_number"  class="form-control" placeholder="PGL Reference Number" />
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Seal Number</label>
                                        <input type="text" value="{{@$container->seal_number}}" name="seal_number"  class="form-control" placeholder="Seal Number" />
                                    </div>
                                    
                                      <div class="form-group">
                                        <label for="name">Pin Out</label>
                                        <input type="text" value="{{@$container->pin_out}}" name="pin_out"  class="form-control" placeholder="Pin Out" />
                                      </div>
                                      
                                       <div class="form-group">
                                          <label for="name">Pin In </label>
                                          <input type="text" value="{{@$container->pin_in}}" name="pin_in"  class="form-control" placeholder="Pin In" />
                                     </div>

                                    <div class="form-group">
                                        <label for="name">Container Size/Type</label>
                                        <input type="text" value="{{@$container->c_size}}" name="cont_size"  class="form-control" placeholder="Container Size/Type" />
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Cut Off Date</label>
                                        <input type="date" value="{{@$container->cut_off_date}}" name="cut_date"  class="form-control" placeholder="Cut Off Date" />
                                    </div>

                                    <div class="form-group">
                                        <label for="name"> Loading Date</label>
                                        <input type="date" value="{{@$container->loading_date}}" name="load_date"  class="form-control" placeholder="  Loading Date" />
                                    </div>

                                    <div class="form-group">
                                        <label for="name">ETD at Port of Loading</label>
                                        <input type="date" value="{{@$container->etd_port_loading}}" name="port_loading"  class="form-control" placeholder="ETD at Port of Loading" />
                                    </div>
                                    <div class="form-group">
                                        <label for="name">ETA at Port of Discharge</label>
                                        <input type="date" value="{{@$container->eta_port_discharge}}" name="port_discharge"  class="form-control" placeholder="ETA at Port of Discharge" />
                                    </div>

                                    <div class="form-group">
                                        <label for="name">Vessel Name</label>
                                        <input type="text" value="{{@$container->vessel_name}}" name="vessel_name"  class="form-control" placeholder="Vessel Name" />
                                    </div>

                                    <div class="form-group">
                                        <label for="name">Voyage Number</label>
                                        <input type="text" value="{{@$container->voyage_number}}" name="voyage_number"  class="form-control" placeholder="Voyage Number" />
                                    </div>

                                    <div class="form-group">
                                        <label for="name">Flag</label>
                                        <input type="text" value="{{@$container->flag}}" name="flag"  class="form-control" placeholder="Flag" />
                                    </div>

                                    <div class="form-group">
                                        <label for="name">Steamship Line</label>
                                        <input type="text" value="{{@$container->steamship_line}}" name="line"  class="form-control" placeholder="Steamship Line" />
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="name">Actions</label>
                                        <input type="text" name="actions" value="{{@$container->actions}}"  class="form-control" placeholder="Actions" />
                                    </div>
                            
                                </div>
                                <!-- /.col -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Created Date:</label>
                                        <input type="text" name="reported" readonly="" class="form-control" placeholder="Created Date" value="{{@$container->create_date}}">
                                        <!-- /.input group -->
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Place of Receipt</label>
                                        <input type="text" value="{{@$container->place_receipt}}" name="place_rec"  class="form-control" placeholder="Place of Receipt" />
                                    </div>

                                    <div class="form-group">
                                        <label for="name">PIER</label>
                                        <input type="text" value="{{@$container->pier}}" name="pier"  class="form-control" placeholder="PIER" />
                                    </div>
                                    <!--<div class="form-group">-->
                                    <!--    <label for="name">Port of Loading</label>-->
                                    <!--    <input type="text" value="{{isset($container) ? $container->port_loading : ''}}" name="port_of_loading"  class="form-control" placeholder="Port of Loading" />-->
                                    <!--</div>-->
                                    
                                     <div class="form-group">
                                        <label for="customer">Port of loading</label>
                                        <select name="port_of_loading" class="ploading form-control select2" required="required">
                                            <option></option>
                                            <?php $data=DB::table('locations')->get(); ?>
                                            @foreach($data as $datum)
                                            <option value="{{$datum->location}}" <?php if(stripos($datum->location,$container->port_loading) !== false) echo "selected"; ?> >{{$datum->location}}</option>
                                              @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="name">Loading Terminal</label>
                                        <input type="text" value="{{@$container->loading_terminal}}" name="loading_terminal"  class="form-control" placeholder="Loading Terminal" />
                                    </div>

                                    <div class="form-group">
                                        <label for="name">Port of Discharge</label>
                                        <input type="text" value="{{@$container->port_discharge}}" name="port_of_discharge"  class="form-control" placeholder="Port of Discharge" />
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Release Date</label>
                                        <input type="date" value="{{@$container->    release_date}}" name="release_date"  class="form-control" placeholder="Release Date" />
                                    </div>
                                    <div class="form-group">
                                        <label for="name">POC for Cargo Release</label>
                                        <input type="text" value="{{isset($container) ? $container->poc_cargo_release : ''}}" name="poc_cargo_re"  class="form-control" placeholder="POC for Cargo Release" />
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Country of Origin</label>
                                        <input type="text" value="{{isset($container) ? $container->country_origin : ''}}" name="country_or"  class="form-control" placeholder="Country of Origin" />
                                    </div>
                                    <div class="form-group">
                                        <label for="name">SCAC Code</label>
                                        <input type="text" value="{{isset($container) ? $container->scac_code : ''}}" name="scac_code"  class="form-control" placeholder="SCAC Code" />
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Transportation Cost</label>
                                        <input type="text" value="{{isset($container) ? $container->t_cost : ''}}" name="t_cost"  class="form-control" placeholder="Transportation Cost" />
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Broker Name</label>
                                        <input type="text" value="{{isset($container) ? $container->broker_name : ''}}" name="broker_name"  class="form-control" placeholder="Broker Name" />
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Pre-Carriage By</label>
                                        <input type="text" value="{{isset($container) ? $container->    prec_by : ''}}" name="pre_carriage"  class="form-control" placeholder="Pre-Carriage By" />
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Place of Receipt by Pre Carrier</label>
                                        <input type="text" value="{{isset($container) ? $container->place_pre_carrier : ''}}" name="porbpc"  class="form-control" placeholder="Place of Receipt by Pre Carrier" />
                                    </div>
                                    {{--<input type="hidden" name="pname" value="{{isset($container)? $container->file : ''}}" />--}}
                                    <div class="form-group">
                                        <label for="name">Chose Photo</label>
                                        <input type="file"  name="file[]" multiple  class="form-control"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Photo Link</label>
                                        <input type="text" name="photo_link"  class="form-control" placeholder="Photo Link" value="{{isset($container)? $container->photo_link : ''}}" />
                                    </div>

                                    <input type="hidden" name="fname" value="{{isset($container)? $container->validate_doc : ''}}" />
                                    <div class="form-group">
                                        <label for="name">Add Validated/Signed Documents</label>
                                        <input type="file"  name="file1[]" multiple  class="form-control"/>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="col-md-12">

                                <h3 class="box-title">Shipping Document information</h3>
                                <br>
                                <hr>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Shipper/Exporter </label>
                                        <input type="text" value="{{isset($container) ? $container->    shipper_exporter : ''}}" name="shipper" id="name" class="form-control" placeholder="Shipper/Exporter" />
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Shipper/Exporter Street Address</label>
                                        <input type="text" value="{{isset($container) ? $container->shipper_street_address : ''}}" name="shipper_street" id="name" class="form-control" placeholder="Shipper/Exporter Street Address" />
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Shipper/Exporter City</label>
                                        <input type="text" value="{{isset($container) ? $container->shipper_city : ''}}" name="shipper_city" id="name" class="form-control" placeholder="Shipper/Exporter City" />
                                    </div>

                                    <div class="form-group">
                                        <label for="name">Shipper/Exporter State</label>
                                        <input type="text" value="{{isset($container) ? $container->shipper_state : ''}}" name="shipper_state" id="name" class="form-control" placeholder="Shipper/Exporter State" />
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Shipper/Exporter Zip Code</label>
                                        <input type="text" value="{{isset($container) ? $container->    shipper_zip_code : ''}}" name="shipper_zip" id="name" class="form-control" placeholder="Shipper/Exporter Zip Code" />
                                    </div>

                                    <div class="form-group">
                                        <label for="name">Shipper/Exporter Email Address</label>
                                        <input type="text" value="{{isset($container) ? $container->shipper_email_address : ''}}" name="shipper_email" id="name" class="form-control" placeholder="Shipper/Exporter Email Address" />
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Shipper/Exporter Phone Number</label>
                                        <input type="text" value="{{isset($container) ? $container->shipper_phone_number : ''}}" name="shipper_phone" id="name" class="form-control" placeholder="Shipper/Exporter Phone Number" />
                                    </div>

                                    <div class="form-group">
                                        <label for="name">Shipper/Exporter Fax Number</label>
                                        <input type="text" value="{{isset($container) ? $container->    shipper_fax_number : ''}}" name="shipper_fax" id="name" class="form-control" placeholder="Shipper/Exporter Fax Number" />
                                    </div>

                                    <div class="form-group">
                                        <label for="name">Shipper/Exporter POC</label>
                                        <input type="text" value="{{isset($container) ? $container->    shipper_poc : ''}}" name="shipper_poc" id="name" class="form-control" placeholder="Shipper/Exporter POC" />
                                    </div>

                                    <div class="form-group">
                                        <label for="name">Forwarding Agent</label>
                                        <input type="text" value="{{isset($container) ? $container->f_agent : ''}}" name="forward_agent" id="name" class="form-control" placeholder="Forwarding Agent" />
                                    </div>

                                    <div class="form-group">
                                        <label for="name">Forwarding Agent Street Address</label>
                                        <input type="text" value="{{isset($container) ? $container->f_street_address : ''}}" name="forward_agent_add" id="name" class="form-control" placeholder="Forwarding Agent Street Address" />
                                    </div>


                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Forwarding Agent City</label>
                                        <input type="text" value="{{isset($container) ? $container->f_city : ''}}" name="forward_agent_city" id="name" class="form-control" placeholder="Forwarding Agent City" />
                                    </div>

                                    <div class="form-group">
                                        <label for="name">Forwarding Agent State</label>
                                        <input type="text" value="{{isset($container) ? $container->f_state : ''}}" name="forward_agent_state" id="name" class="form-control" placeholder="Forwarding Agent State" />
                                    </div>

                                    <div class="form-group">
                                        <label for="name">Forwarding Agent Zip Code</label>
                                        <input type="text" value="{{isset($container) ? $container->f_zip_code : ''}}" name="forward_agent_zip" id="name" class="form-control" placeholder="Forwarding Agent Zip Code" />
                                    </div>

                                    <div class="form-group">
                                        <label for="name">Forwarding Agent Email Address</label>
                                        <input type="text" value="{{isset($container) ? $container->f_email_address : ''}}" name="forward_agent_email" id="name" class="form-control" placeholder="Forwarding Agent Email Address" />
                                    </div>

                                    <div class="form-group">
                                        <label for="name">Forwarding Agent Phone Number</label>
                                        <input type="text" value="{{isset($container) ? $container->f_phone_number : ''}}" name="forward_agent_phone" id="name" class="form-control" placeholder="Forwarding Agent Phone Number" />
                                    </div>

                                    <div class="form-group">
                                        <label for="name">Forwarding Agent Fax Number</label>
                                        <input type="text" value="{{isset($container) ? $container->f_fax_number : ''}}" name="forward_agent_fax" id="name" class="form-control" placeholder="Forwarding Agent Fax Number" />
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Forwarding Agent POC</label>
                                        <input type="text" value="{{isset($container) ? $container->f_poc : ''}}" name="forward_agent_poc" id="name" class="form-control" placeholder="Forwarding Agent POC" />
                                    </div>

                                    <div class="form-group">
                                        <label for="name">Measurement</label>
                                        <input type="text" value="{{isset($container) ? $container->meas : ''}}" name="measure" id="name" class="form-control" placeholder="Measurement" />
                                    </div>

                                    <div class="form-group">
                                        <label for="name">Number/Description of Units Loaded</label>
                                        <input type="text" value="{{isset($container) ? $container->n_units_load : ''}}" name="number_unit" id="name" class="form-control" placeholder="Number/Description of Units Loaded" />
                                    </div>
                                    <div class="form-group">
                                    <label for="company">Select Company</label>
                                    <select name="company_id" class="company form-control select2" id="company_id">
                                        <option ></option>
                                        <?php $row=DB::table('companies')->get(); ?>
                                        @foreach($row as $ro)

                                        <option value="{{$ro->id}}" <?=$ro->id==$container->company_id?"selected":"";?>>&nbsp;{{$ro->name}}&nbsp;</option>

                                        @endforeach
                                    </select>
                                </div>
                                 <div class="form-group">
                                    <label for="name">Invoice Number </label>
                                    <input type="text" name="inv_number" id="name" class="form-control" placeholder="Invoice Number" value="<?=$container->inv_number?>" />
                                </div>
                                <div class="form-group">
                                    <label for="name">Amount </label>
                                    <input type="text" name="amount" id="name" class="form-control" placeholder="Amount" value="<?=$container->amount?>" />
                                </div>


                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Export References and Instructions</label>
                                    <textarea name="export_ref" id="" cols="30" rows="10" class="textarea wysihtml5-editor placeholder form-control">{{isset($container) ? $container->export_instruc : ''}}</textarea>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Basic Instruction</label>
                                    <textarea name="basic_ins" id="" cols="30" rows="10" class="textarea wysihtml5-editor placeholder form-control">{{isset($container) ? $container->basic_instruc : ''}}</textarea>
                                </div>
                            </div>
                        <!-- /.col -->
                    </div>
                <!-- /.row -->
			  </div>		
		</div>
		<div class="card-footer clearfix">
			<button type="submit" class="btn btn-info label-left float-xs-left">
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
