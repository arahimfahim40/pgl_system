<!-- eta modal start -->
<div class="modal fade  modal1" tabindex="-1" id="eta{{$item->id}}" role="dialog">
    <div class="modal-dialog modal-sm " role="document" style="  height: 150px !important;">
        <div class="modal-content">
            <div class="modal-header" align="center">
                <h4 class="modal-title" id="myModalLabel"> Update ETA Date </h4>
            </div>
            <div class="modal-body" style="text-align: center;">
              <input type="date" id="eta{{$item->id}}" name="eta_update_date" value="{{$item->eta_port_discharge}}">
            </div>
            <div class="modal-footer" style="text-align: center;">
              <div style="">
                <button class="btn btn-info btn_eta_update btn-sm" type="button" id="{{$item->id}}">
                    Update</button>
                <button type="button" class="btn btn-default  btn-sm" data-dismiss="modal">
                        dismiss</button>
                </div>
              </div>
        </div>
    </div>
</div>
<!-- eta modal end -->