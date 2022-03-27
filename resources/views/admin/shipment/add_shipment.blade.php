@extends('admin.layout.main')
@section('title','Add Ship')
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
					<h5 class="float-xs-left mb-0">Add Shipment</h5>
				</div>
				<div class="card-block">
					<div class="row mb-2">
						
						 <!-- row -->
                <div class="row">
                   <div class="col-md-12 col-md-offset-0">
                       <form action="{{url('add_new_shipment')}}" method="post" enctype="multipart/form-data">
                           {!! csrf_field() !!}
                    <div class="col-md-12">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Creating By</label>
                            <input type="text" name="create_by" readonly="" class="form-control" placeholder="Reported By" value="{{session('username')}}">
                        </div>
                        
                        <div class="form-group">
                            <label for="name">Booking Number</label>
                            <input type="text" name="book_number" id="name" class="form-control" placeholder="book number" />
                        </div>

                        <div class="form-group">
                            <label for="name">AES ITN Number</label>
                            <input type="text" name="itn_number"  class="form-control" placeholder="AES ITN Number" />
                        </div>
                        <div class="form-group">
                            <label for="name"> Container Number</label>
                            <input type="text" name="cont_number"  class="form-control" placeholder=" Container Number"  id="container_no" />
                            <span id="container_exist" style="color: red;font-weight: bold;"></span>
                        </div>
                        <div class="form-group">
                            <label for="name"> Bill of Lading Number</label>
                            <input type="text" name="lading_number"  class="form-control" placeholder="Bill of Lading Number" />
                        </div>
                        <div class="form-group">
                            <label for="name"> PGL Reference Number</label>
                            <input type="text" name="pgl_number"  class="form-control" placeholder="PGL Reference Number" />
                        </div>
                        <div class="form-group">
                            <label for="name">Seal Number</label>
                            <input type="text" name="seal_number"  class="form-control" placeholder="Seal Number" />
                        </div>
                        <div class="form-group">
                            <label for="name">Pin Out</label>
                            <input type="text" name="pin_out"  class="form-control" placeholder="Pin Out" />
                        </div>
                        <div class="form-group">
                            <label for="name">Pin In</label>
                            <input type="text" name="pin_in"  class="form-control" placeholder="Pin In " />
                        </div>
                          
                        <div class="form-group">
                            <label for="name">Container Size/Type</label>
                            <input type="text" name="cont_size"  class="form-control" placeholder="Container Size/Type" />
                        </div>
                        <div class="form-group">
                            <label for="name">Cut Off Date</label>
                            <input type="date" name="cut_date"  class="form-control" placeholder="Cut Off Date" />
                        </div>

                        <div class="form-group">
                            <label for="name"> Loading Date</label>
                            <input type="date" name="load_date"  class="form-control" placeholder="  Loading Date" />
                        </div>

                        <div class="form-group">
                            <label for="name">ETD at Port of Loading</label>
                            <input type="date" name="port_loading"  class="form-control" placeholder="ETD at Port of Loading" />
                        </div>
                        <div class="form-group">
                            <label for="name">ETA at Port of Discharge</label>
                            <input type="date" name="port_discharge"  class="form-control" placeholder="ETA at Port of Discharge" />
                        </div>

                        <div class="form-group">
                            <label for="name">Vessel Name</label>
                            <input type="text" name="vessel_name"  class="form-control" placeholder="Vessel Name" />
                        </div>

                        <div class="form-group">
                            <label for="name">Voyage Number</label>
                            <input type="text" name="voyage_number"  class="form-control" placeholder="Voyage Number" />
                        </div>

                        <div class="form-group">
                            <label for="name">Flag</label>
                            <input type="text" name="flag"  class="form-control" placeholder="Flag" />
                        </div>

                        <div class="form-group">
                            <label for="name">Steamship Line</label>
                            <input type="text" name="line"  class="form-control" placeholder="Steamship Line" />
                        </div>
                     
                        <div class="form-group">
                            <label for="name">Actions</label>
                            <input type="text" name="actions"  class="form-control" placeholder="Actions" />
                        </div>
                        
                    </div>
                    <!-- /.col -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Creating Date </label>
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" name="create_date" class="reproteds form-control pull-right" id="reproted" readonly=""  value="{{date('Y-m-d  h:i:s')}}">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="name">Place of Receipt</label>
                            <input type="text" name="place_rec"  class="form-control" placeholder="Place of Receipt" />
                        </div>

                        <div class="form-group">
                            <label for="name">PIER</label>
                            <input type="text" name="pier"  class="form-control" placeholder="PIER" />
                        </div>
                        <!--<div class="form-group">-->
                        <!--    <label for="name">Port of Loading</label>-->
                        <!--    <input type="text" name="port_of_loading"  class="form-control" placeholder="Port of Loading" />-->
                        <!--</div>-->
                        
                        <div class="form-group">
                            <label for="customer">Port of loading</label>
                            <select name="port_of_loading" class="ploading form-control select2" required="required">
                                <option></option>
                                <?php $data=DB::table('locations')->get(); ?>
                                @foreach($data as $datum)
                                <option value="{{$datum->location}}">{{$datum->location}}</option>
                                  @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="name">Loading Terminal</label>
                            <input type="text" name="loading_terminal"  class="form-control" placeholder="Loading Terminal" />
                        </div>

                        <div class="form-group">
                            <label for="name">Port of Discharge</label>
                            <input type="text" name="port_of_discharge"  class="form-control" placeholder="Port of Discharge" />
                        </div>
                        <div class="form-group">
                            <label for="name">Release Date</label>
                            <input type="date" name="release_date"  class="form-control" placeholder="Release Date" />
                        </div>
                        <div class="form-group">
                            <label for="name">POC for Cargo Release</label>
                            <input type="text" name="poc_cargo_re"  class="form-control" placeholder="POC for Cargo Release" />
                        </div>
                        <div class="form-group">
                            <label for="name">Country of Origin</label>
                            <input type="text" name="country_or"  class="form-control" placeholder="Country of Origin" />
                        </div>
                        <div class="form-group">
                            <label for="name">SCAC Code</label>
                            <input type="text" name="scac_code"  class="form-control" placeholder="SCAC Code" />
                        </div>
                        <div class="form-group">
                            <label for="name">Transportation Cost</label>
                            <input type="text" name="t_cost"  class="form-control" placeholder="Transportation Cost" />
                        </div>
                        <div class="form-group">
                            <label for="name">Broker Name</label>
                            <input type="text" name="broker_name"  class="form-control" placeholder="Broker Name" />
                        </div>
                        <div class="form-group">
                            <label for="name">Pre-Carriage By</label>
                            <input type="text" name="pre_carriage"  class="form-control" placeholder="Pre-Carriage By" />
                        </div>
                        <div class="form-group">
                            <label for="name">Place of Receipt by Pre Carrier</label>
                            <input type="text" name="porbpc"  class="form-control" placeholder="Place of Receipt by Pre Carrier" />
                        </div>
                        <div class="form-group">
                            <label for="name">Choose Photos</label>
                            <input type="file" name="file[]" multiple  class="form-control"/>
                        </div>
						 <div class="form-group">
                            <label for="name">Photo Link</label>
                            <input type="text" name="photo_link"  class="form-control" placeholder="Photo Link" />
                        </div>
                        <div class="form-group">
                            <label for="name">Add Validated/Signed Documents</label>
                            <input type="file" name="file1[]" multiple  class="form-control"/>
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
                                    <input type="text" value="Peace Global Logistics" name="shipper" id="name" class="form-control" placeholder="Shipper/Exporter" />
                                </div>
                                <div class="form-group">
                                    <label for="name">Shipper/Exporter Street Address</label>
                                    <input type="text" value="2824 Tremont Road" name="shipper_street" id="name" class="form-control" placeholder="Shipper/Exporter Street Address" />
                                </div>
                                <div class="form-group">
                                    <label for="name">Shipper/Exporter City</label>
                                    <input type="text" value="Savannah" name="shipper_city" id="name" class="form-control" placeholder="Shipper/Exporter City" />
                                </div>

                                <div class="form-group">
                                    <label for="name">Shipper/Exporter State</label>
                                    <input type="text" value="GA" name="shipper_state" id="name" class="form-control" placeholder="Shipper/Exporter State" />
                                </div>
                                <div class="form-group">
                                    <label for="name">Shipper/Exporter Zip Code</label>
                                    <input type="text" value="31405" name="shipper_zip" id="name" class="form-control" placeholder="Shipper/Exporter Zip Code" />
                                </div>

                                <div class="form-group">
                                    <label for="name">Shipper/Exporter Email Address</label>
                                    <input type="text" value="docs@peacegl.com" name="shipper_email" id="name" class="form-control" placeholder="Shipper/Exporter Email Address" />
                                </div>
                                <div class="form-group">
                                    <label for="name">Shipper/Exporter Phone Number</label>
                                    <input type="text" value="571-699-9855" name="shipper_phone" id="name" class="form-control" placeholder="Shipper/Exporter Phone Number" />
                                </div>

                                <div class="form-group">
                                    <label for="name">Shipper/Exporter Fax Number</label>
                                    <input type="text" name="shipper_fax" id="name" class="form-control" placeholder="Shipper/Exporter Fax Number" />
                                </div>

                                <div class="form-group">
                                    <label for="name">Shipper/Exporter POC</label>
                                    <input type="text" value="Abdul Hamid Tamim" name="shipper_poc" id="name" class="form-control" placeholder="Shipper/Exporter POC" />
                                </div>

                                <div class="form-group">
                                    <label for="name">Forwarding Agent</label>
                                    <input type="text" value="Peace Global Logistics" name="forward_agent" id="name" class="form-control" placeholder="Forwarding Agent" />
                                </div>

                                <div class="form-group">
                                    <label for="name">Forwarding Agent Street Address</label>
                                    <input type="text" value="2824 Tremont Road" name="forward_agent_add" id="name" class="form-control" placeholder="Forwarding Agent Street Address" />
                                </div>

                                 <div class="form-group">
                                     <input type="checkbox" id="rcontainer" name="rcontainer" value="3">
                                     <label for="vehicle1"> Reserve Container</label>
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Forwarding Agent City</label>
                                    <input type="text" value="Savannah" name="forward_agent_city" id="name" class="form-control" placeholder="Forwarding Agent City" />
                                </div>

                                <div class="form-group">
                                    <label for="name">Forwarding Agent State</label>
                                    <input type="text" value="GA" name="forward_agent_state" id="name" class="form-control" placeholder="Forwarding Agent State" />
                                </div>

                                <div class="form-group">
                                    <label for="name">Forwarding Agent Zip Code</label>
                                    <input type="text" value="31405" name="forward_agent_zip" id="name" class="form-control" placeholder="Forwarding Agent Zip Code" />
                                </div>

                                <div class="form-group">
                                    <label for="name">Forwarding Agent Email Address</label>
                                    <input type="text" value="docs@peacegl.com" name="forward_agent_email" id="name" class="form-control" placeholder="Forwarding Agent Email Address" />
                                </div>

                                <div class="form-group">
                                    <label for="name">Forwarding Agent Phone Number</label>
                                    <input type="text" value="571-699-9855" name="forward_agent_phone" id="name" class="form-control" placeholder="Forwarding Agent Phone Number" />
                                </div>

                                <div class="form-group">
                                    <label for="name">Forwarding Agent Fax Number</label>
                                    <input type="text" name="forward_agent_fax" id="name" class="form-control" placeholder="Forwarding Agent Fax Number" />
                                </div>
                                <div class="form-group">
                                    <label for="name">Forwarding Agent POC</label>
                                    <input type="text" value="Abdul Hamid Tamim" name="forward_agent_poc" id="name" class="form-control" placeholder="Forwarding Agent POC" />
                                </div>

                                <div class="form-group">
                                    <label for="name">Measurement</label>
                                    <input type="text" name="measure" id="name" class="form-control" placeholder="Measurement" />
                                </div>

                                <div class="form-group">
                                    <label for="name">Number/Description of Units Loaded</label>
                                    <input type="text" name="number_unit" id="name" class="form-control" placeholder="Number/Description of Units Loaded" />
                                </div>
								
								<div class="form-group">
									<label for="company">Select Company</label>
									<select name="company_id" class="company form-control select2" id="company_id">
										<option ></option>
										<?php $row=DB::table('companies')->get(); ?>
										@foreach($row as $ro)

										<option value="{{$ro->id}}">&nbsp;{{$ro->name}}&nbsp;</option>

										@endforeach
									</select>
								</div>
								 <div class="form-group">
                                    <label for="name">Invoice Number </label>
                                    <input type="text" name="inv_number" id="name" class="form-control" placeholder="Invoice Number" />
                                </div>
								<div class="form-group">
                                    <label for="name">Amount </label>
                                    <input type="text" name="amount" id="name" class="form-control" placeholder="Amount" />
                                </div>

                            </div>
                        </div>
                           <div class="col-md-6">
                               <div class="form-group">
                                   <label for="">Export References and Instructions</label>
                                   <textarea name="export_ref" id="" cols="30" rows="10" class="textarea wysihtml5-editor placeholder form-control"></textarea>
                               </div>
                           </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Basic Instruction</label>
                                <textarea name="basic_ins" id="" cols="30" rows="10" class="textarea wysihtml5-editor placeholder form-control"></textarea>
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
				Save
			</button>
		</div>
	 </div>
    </form>
	</div>
  </div>
</div>		
@stop
@section('js')
<script>
    $(document).ready(function(){
        $('#container_no').focusout(function(){
           $('#container_exist').html("<div style='color:blue !important'><img width='30px' src= '"+"{{asset('img/loading.gif')}}"+"' alt='Loading ...'> </div> ");
            var container_no=$(this).val();
           var request = $.ajax({
              url: "{{route('check_container_number')}}",
              method: "GET",
              data: {container_number:container_no},
            }); 
            request.done(function( msg ) {
                if(msg)
                $('#container_exist').text('This container number already exist ! ');
                else  $('#container_exist').text('');
            });
            request.fail(function( jqXHR, textStatus ) {
                alert(textStatus)
          });
       });
    });
</script>
@stop
