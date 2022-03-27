<button type="button" class="excel btn btn-outline-warning mb-0-25 waves-effect waves-light">
    <a href="{{url('/delivery_invoice_export/'.$status)}}">Excel <i class="fa fa-file-excel-o"></i></a>
</button>


<table class="table table-bordered">
    <thead class="bg-info dataTable" id="table-2">
    <tr>
        @if(Auth::guard('admin')->user()->hasPermissions(['Admin','edit-finance']))
            @if($status != 1)
                <th>Action</th>
            @endif
        @endif

        <th>PDF</th>
        <th>Status</th>
        <th>container</th>
        <th>Customer Name</th>
        <th>Delivery Charges</th>
        <th>Consignee Name</th>
        <th>Bolading No.</th>
        <th>ETA</th>

    </tr>
    </thead>
    <tbody>
    <?php $id = 1; ?>
    @foreach($delivery as $deliveries)
        {{--        {{ dd($deliveries) }}--}}
        <tr id="searchBody">
            @if(Auth::guard('admin')->user()->hasPermissions(['Admin','edit-finance']))
                @if($status != 1)
                    <td>
                        <?php if($deliveries->status == 2){ ?>
                        <a type="submit" class="btn btn-warning btn-circle" id="deliveryPendingStatus"
                           data-id="{{ $deliveries->id }}" data-token="{{ csrf_token() }}"><span
                                    class="fa fa-check"></span></a>
                        <?php } elseif(($deliveries->status == 1) || ($deliveries->status == 3) || ($deliveries->status == 4)){   ?>

                        <input type="checkbox" class="checkbox" data-id={{ $deliveries->id }}">
                <?php } ?>
                                </td>
                        @endif
                        @endif

                           <td><a href="<?php echo URL::to('/invoice_pdf1_admin/' . $deliveries->id) ?>" target="_blank"><i
                                class="fa fa-file-pdf-o fa-2x"
                                style="margin-top: 18px;"
                                aria-hidden="true"></i></a>
                    </td>
                    <td><?php if ($deliveries->status == 1) {
                            echo '<span style="color:#006400;">Open Invoice</span>';
                        } elseif ($deliveries->status == 2) {
                            echo '<span style="color:#FF8C00;">Pending Invoice</span>';
                        } elseif ($deliveries->status == 3) {
                            echo '<span style="color:#0000ff;">Past Due Invoice</span>';
                        } elseif ($deliveries->status == 4) {
                            echo '<span style="color:#8B0000;">Paid Invoice</span>';
                        } ?>
                    </td>
                     <td>{{ $deliveries->container->container_number??'' }}</td>
                    <td>{{$deliveries->getCustomer->customer_name??'' }}</td>
                    <td>{{$deliveries->delivery_charges??''}}</td>
                    <td>{{$deliveries->getCustomer->consignee??''}}</td>
                    <td>{{$deliveries->container->bolading_number??''}}</td>
                    <td>{{$deliveries->container->eta_port_discharge??''}}</td>

        </tr>

    @endforeach
    </tbody>
    <tfoot class="bg-info">
    <tr>
        @if(Auth::guard('admin')->user()->hasPermissions(['Admin','edit-finance']))
            @if($status != 1)
                <th>Action</th>
            @endif
        @endif
        <th>PDF</th>
        <th>Status</th>
        <th>container</th>
        <th>Customer Name</th>
        <th>Delivery Charges</th>
        <th>Consignee Name</th>
        <th>Bolading No.</th>
        <th>ETA</th>
    </tr>
    </tfoot>
</table>
@if(Auth::guard('admin')->user()->hasPermissions(['Admin','edit-finance']))
    @if($status !='1' && $status !='2')
        <div class="form-group col-md-1 col-lg-1 col-sm-6 col-xs-12" style="margin:1%">
            <button type="button" class="btn btn-warning btn-rounded mb-0-25 waves-effect waves-light"
                    data-toggle="modal"
                    data-target="#delivery_change_status"><b><i class="fa fa-info-circle"></i></b> Change Status
            </button>
        </div>
    @endif
@endif



