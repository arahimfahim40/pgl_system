<!-- etd modal start -->
<div class="modal fade  modal1" tabindex="-1" id="etd{{$item->id}}" role="dialog">
    <div class="modal-dialog modal-sm " role="document" style="  height: 150px !important;">
        <div class="modal-content">
            <div class="modal-header" align="center">
                <h4 class="modal-title" id="myModalLabel"> Update ETD Date </h4>
            </div>
            <div class="modal-body" style="text-align: center;">
              <input type="date" id="etd{{$item->id}}" name="etd_update_date" value="{{$item->etd_port_loading}}">
            </div>
            <div class="modal-footer" style="text-align: center;">
              <div style="">
                <button class="btn btn-info btn-sm btn_etd_update" type="button" id="{{$item->id}}">
                    Update</button>
                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">
                        dismiss</button>
                </div>
              </div>
        </div>
    </div>
</div>
<!-- etd modal end -->