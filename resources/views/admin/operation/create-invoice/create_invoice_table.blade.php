
			<table class="table table-bordered">
				<thead class="bg-info dataTable" id="table-2">
					<tr>
						<th width="5px;">#</th>
						<th>Clearance Charges</th>
						{{--  <th>Create log</th>  --}}
						<th>Delivery Order Charges</th>
						<th>Transporter Charges</th>
						<th>Other Charges</th>
						<th>Detention Charges</th>
						<th>Demurrage Charges</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody >
					<?php $id =1; ?>
					@foreach($createInvoice as $createInvoices)
					<tr id="searchBody">
						<td><?=$id++; ?></td>
                        <td>{{$createInvoices->clearance_charges}}</td>
                        {{--  <td>{{$createInvoices->clearLog}}</td>  --}}
						<td>{{$createInvoices->delivery_order_charges}}</td>
                        <td>{{$createInvoices->transporter_charges}}</td>
                        <td>{{$createInvoices->other_charges}}</td>
                        <td>{{$createInvoices->detention_charges}}</td>
                        <td>{{$createInvoices->demurrage_charges}}</td>
                       <td>
	                   	<a href="#edit_company{{$createInvoices->id}}" class="btn btn-primary btn-circle" data-toggle="modal"><span class="fa fa-pencil"></span>
	                   	</a>
	                   	<a  class="btn btn-warning btn-circle" onclick="javascript:return confirm('Are you sure you want to delete ?')" href="{{route('delete_clearance_invoices_admin',$createInvoices->id)}}"><span class="fa fa-trash"></span>
	                   	</a>
	                   </td>
					</tr>
					<!-- Edit company modal -->
					<div class="modal fade small-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="edit_company{{$createInvoices->id}}">
						<div class="modal-dialog modal-md">
							<form class="form" action="{{route('edit_clearance_invoices_admin')}}" method="post">
								@csrf
								<input type="hidden" name="id" value="{{$createInvoices->id}}">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">×</span>
										</button>
										<h4 class="modal-title">Edit ClearLog</h4>
									</div>
									<div class="modal-body">
										{{--  <div class="form-group">
											<label for="name">Select Container</label>
											<select name="cont" id="" class="select2" style="width: 100%">
												<?php $conto=DB::table('clear_logs')->where('id',isset($createInvoices)?$createInvoices->log_clear_id : '' )->first(); ?>
												<option value="<?php echo $conto->id ?>"><?php echo $conto->consignee_name?></option>
											<?php $conti_find=DB::table('clear_logs')->get();
											foreach ($conti_find as $cont){?>
													<option value="{{$cont->id}}">{{$cont->consignee_name}}</option>
											<?php }?>
                                        </select>
										</div>  --}}
										<div class="form-group">
											<label>Clearance Charges</label>
											<input type="text" name="clearance_charges" value="{{$createInvoices->clearance_charges}}" class="form-control" required>
										</div>
										<div class="form-group">
											<label>Delivery Order Charges</label>
											<input type="text" name="delivery_order_charges" class="form-control" value="{{$createInvoices->delivery_order_charges}}" required>
										</div>
										<div class="form-group">
											<label>Transporter Charges</label>
											<input type="text" name="transporter_charges" class="form-control" value="{{$createInvoices->transporter_charges}}" required>
										</div>
										<div class="form-group">
											<label>Other Charges</label>
											<input type="text" name="other_charges" class="form-control" value="{{$createInvoices->other_charges}}" required>
										</div>
										<div class="form-group">
											<label>Detention Charges</label>
											<input type="text" name="detention_charges" class="form-control" value="{{$createInvoices->detention_charges}}" required>
										</div>
										<div class="form-group">
											<label>Demurrage Charges</label>
											<input type="text" name="demurrage_charges" value="{{$createInvoices->demurrage_charges}}" class="form-control" required>
										</div>
								</div>
									<div class="modal-footer">
										<button type="submit" class="btn btn-primary">Edit</button>
										<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
									</div>
								</div>
							</form>
						</div>
					</div>
					@endforeach
				</tbody>
				<tfoot class="">
					<tr>
						<th>#</th>
						<th>Clearance Charges</th>
						{{--  <th>Create Log</th>  --}}
						<th>Delivery Order Charges</th>
						<th>Transporter Charges</th>
						<th>Other Charges</th>
						<th>Detention Charges</th>
						<th>Demurrage Charges</th>
                        <th>Action</th>
					</tr>
				</tfoot>
			</table>
			@if(!empty($createInvoice))
			{{ $createInvoice->appends(Request::All())->links()}}
			@endif
		</div>
	</div>
</div>
<!-- add Clear Log -->
<div class="modal fade small-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="add_company">
	<div class="modal-dialog modal-md">
		<form class="form" action="{{route('add_clearance_invoices_admin')}}" method="post">
			@csrf
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
					<h4 class="modal-title">Add Clear Log</h4>
				</div>
				<div class="modal-body">
						<div class="form-group">
							<label for="name">Select Clear Log</label>
							<select name="log_clear_id" id="" class="select2" style="width: 100%" required="required">
								<option value=""></option>
								<?php foreach ($clearLog as $clear_logs){?>
										<option value="{{$clear_logs->id}}">{{$clear_logs->consignee_name}}</option>
								<?php }?>
							</select>
						</div>
						<input type="hidden" name="report_by" value="">

					<div class="form-group">
							<label>Clearance Charges</label>
							<input type="text" name="clearance_charges" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Delivery Order Charges</label>
							<input type="text" name="delivery_order_charges" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Transporter Charges</label>
							<input type="text" name="transporter_charges" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Other Charges</label>
							<input type="text" name="other_charges" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Detention Charges</label>
							<input type="text" name="detention_charges" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Demurrage Charges</label>
							<input type="text" name="demurrage_charges" class="form-control" required>
						</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary">Add</button>
					<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
				</div>
			</div>
		</form>
	</div>
</div>
