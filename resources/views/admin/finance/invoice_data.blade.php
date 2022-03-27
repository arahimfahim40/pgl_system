<table class="table table-bordered">
    <thead class="bg-info dataTable" id="table-2">
    <tr>
        <th>#</th>
        @if($status=='')
            <th>Edit</th>
        @endif
        @if($status !='' and $status !='4')
            <th> <input type="checkbox" id="check_all"> &nbsp;Select</th>
        @endif
        @if($status=='4')
            <th>Approve</th>
        @endif
        <th>Consignee Name</th>
        <th>Customer Name </th>
        <th>Company</th>
        <th>IMP Code</th>

    </tr>
    </thead>
    <tbody >
    <?php $id = 1;$invoice_amount=0;$payment_received=0;$balancedue=0;?>
    @foreach($invoices as $invoice)
        <?php
        $invoice_amount+=$invoice->id;
        $payment_received+=$invoice->id;
        ?>
        <tr id="searchBody">
            <td><?=$id++; ?></td>
            @if($status=='')
                <td>
                    <a href="{{route('edit_invoice_admin',$invoice->id)}}" class="btn btn-info btn-circle waves-effect waves-light"><span class="fa fa-pencil"></span>
                    </a>
                </td>
            @endif
            @if($status !='' and $status !='4')
                <td> <input type="checkbox" class="checkbox" data-id={{$invoice->id}}"> </td>
						@endif
                    @if($status=='4')
                            <td>
                                <a  class="btn btn-warning btn-circle" onclick="javascript:return confirm('Are you sure you want to approve ?')" href="{{route('approve_invoice',$invoice->id)}}"><span class="fa fa-check"></span>
                    </a>
                </td>
            @endif
            <td>{{$invoice->id}}</td>
            <td><span class="tag tag-success">{{@$invoice->id}}</span></td>
            <td>{{$invoice->id}}</td>
            <td>{{$invoice->id}}</td>

        </tr>
    @endforeach
    </tbody>
</table>
@if(!empty($invoices))
{{ $invoices->appends(Request::All())->links()}}
@endif
</div>
</div>
</div>
