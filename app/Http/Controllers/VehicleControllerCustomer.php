<?php

namespace App\Http\Controllers;

use App\VehicleModel;
use Illuminate\Http\Request;
use DB;
use PDF;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class VehicleControllerCustomer extends Controller
{
    protected $vehicle;
    public function __construct(VehicleModel $vehicle)
    {
        $this->middleware('auth');
        $this->vehicle=$vehicle;

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function all_vehicles()
    {
         $vehicles=DB::table('vehicles')
         ->select(
            "vehicles.id","vehicles.link",
             "vehicles.vin",
              "vehicles.lot_number",
               "vehicles.title_status",
                "vehicles.c_remark",
                 "vehicles.purchase_date",
                  "vehicles.deliver_date",
                  "vehicles.year",
                  "vehicles.make",
                  "vehicles.model",
                  "vehicles.color",
                  "vehicles.file",
                  "vehicles.is_key",
                  "vehicles.customer_note",
                  "locations.location",
                  "carstates.type"      
            )
        // ->rightJoin('vehicles','vehicles.id','=','tbl_bases.vehicle_id')
        // ->leftJoin('containers','containers.id','=','tbl_bases.container_id')
         // ->leftJoin('tbl_bases','tbl_bases.vehicle_id','=','vehicles.id')
         // ->join('containers','containers.id','=','tbl_bases.container_id')
        ->join('locations','locations.id','=','vehicles.ploading')
        ->join('carstates','carstates.id','=','vehicles.carstate_id')
        ->where('vehicles.customer_id',Auth::id())
        ->orderBy('vehicles.id','desc')
        ->paginate(20);
         return view('customer.vehicle.all_vehicles',['vehicles'=>$vehicles,'paginate'=>20]);

    }
    public function search_all_vehicle(Request $request)
    {
        $pagination=20;
        $searchQuery = trim($request['searchValue']);
        $requestData = ['vehicles.vin', 'vehicles.lot_number','vehicles.year','vehicles.make','vehicles.model','locations.location'];
        if($request->ajax()){
       $vehicle=DB::table('vehicles')
         ->select(
            "vehicles.id","vehicles.link",
             "vehicles.vin",
              "vehicles.lot_number",
               "vehicles.title_status",
                "vehicles.c_remark",
                 "vehicles.purchase_date",
                  "vehicles.deliver_date",
                  "vehicles.year",
                  "vehicles.make",
                  "vehicles.model",
                  "vehicles.color",
                  "vehicles.file",
                  "vehicles.is_key",
                  "vehicles.customer_note",
                  "locations.location",
                  "carstates.type"      
            )
        ->join('locations','locations.id','=','vehicles.ploading')
        ->join('carstates','carstates.id','=','vehicles.carstate_id')
        ->where('vehicles.customer_id',Auth::id());
        if($searchQuery!=''){
         $pagination=20000;
        $vehicle->where(function($q) use($requestData, $searchQuery) {
                foreach ($requestData as $field)
                 $q->orWhere($field, 'like', "%{$searchQuery}%");
          });
        }
       $vehicles=$vehicle->orderBy('vehicles.id','desc')->paginate($pagination);
       // dd($vehicles[0]);
       if($vehicles[0]==null){
        $vehicles=DB::table('tbl_bases')
        ->select(
            "vehicles.id","vehicles.link",
             "vehicles.vin",
              "vehicles.lot_number",
               "vehicles.title_status",
                "vehicles.c_remark",
                 "vehicles.purchase_date",
                  "vehicles.deliver_date",
                  "vehicles.year",
                  "vehicles.make",
                  "vehicles.model",
                  "vehicles.color",
                  "vehicles.file",
                  "vehicles.is_key",
                  "vehicles.customer_note",
            "tbl_bases.vehicle_id","tbl_bases.container_id","containers.container_number","containers.booking_number","containers.eta_port_discharge","containers.etd_port_loading","locations.location","carstates.type")
        ->rightJoin('vehicles','vehicles.id','=','tbl_bases.vehicle_id')
        ->leftJoin('containers','containers.id','=','tbl_bases.container_id')
        ->join('locations','locations.id','=','vehicles.ploading')
        ->join('carstates','carstates.id','=','vehicles.carstate_id')
        ->where('vehicles.customer_id',Auth::id())
        ->where('containers.container_number','like','%'.$searchQuery.'%')
        ->orderBy('vehicles.id','desc')->paginate($pagination); 
       } 
        return view('customer.vehicle.all_vehicles_data',compact('vehicles'))->render();
      }
    }
    public function paginate_all_vehicle(Request $request)
    {
        $paginate=20;
        if($request['paginate']){
          $paginate= $request['paginate'];
        }
        if($request->ajax()){
       $vehicles=DB::table('vehicles')
         ->select(
            "vehicles.id","vehicles.link",
             "vehicles.vin",
              "vehicles.lot_number",
               "vehicles.title_status",
                "vehicles.c_remark",
                 "vehicles.purchase_date",
                  "vehicles.deliver_date",
                  "vehicles.year",
                  "vehicles.make",
                  "vehicles.model",
                  "vehicles.color",
                  "vehicles.file",
                  "vehicles.is_key",
                  "vehicles.customer_note",
                  "locations.location",
                  "carstates.type"      
            )
        ->join('locations','locations.id','=','vehicles.ploading')
        ->join('carstates','carstates.id','=','vehicles.carstate_id')
        ->where('vehicles.customer_id',Auth::id())
        ->orderBy('vehicles.id','desc')
        ->paginate($paginate); 
        return view('customer.vehicle.all_vehicles_data',compact('vehicles','paginate'))->render();
      }
    }

    public function paginate_entry_all_vehicle(Request $request)
    {
        $paginate=20;
        if($request['paginate']){
          $paginate= $request['paginate'];
        }
        if($request->ajax()){
       $vehicles=DB::table('vehicles')
         ->select(
            "vehicles.id","vehicles.link",
             "vehicles.vin",
              "vehicles.lot_number",
               "vehicles.title_status",
                "vehicles.c_remark",
                 "vehicles.purchase_date",
                  "vehicles.deliver_date",
                  "vehicles.year",
                  "vehicles.make",
                  "vehicles.model",
                  "vehicles.color",
                  "vehicles.file",
                  "vehicles.is_key",
                  "vehicles.customer_note",
                  "locations.location",
                  "carstates.type"      
            )
        ->join('locations','locations.id','=','vehicles.ploading')
        ->join('carstates','carstates.id','=','vehicles.carstate_id')
        ->where('vehicles.customer_id',Auth::id())
        ->orderBy('vehicles.id','desc')
        ->paginate($paginate); 
        return view('customer.vehicle.all_vehicles_data',compact('vehicles','paginate'))->render();
      }
    }

// on the way vehicle section 
    public function on_theway_vehicles()
    {
         $vehicles=DB::table('tbl_bases')
         ->select("vehicles.*","tbl_bases.vehicle_id","tbl_bases.container_id","containers.container_number","containers.booking_number","containers.eta_port_discharge","containers.etd_port_loading","locations.location","carstates.type")
        ->rightJoin('vehicles','vehicles.id','=','tbl_bases.vehicle_id')
        ->leftJoin('containers','containers.id','=','tbl_bases.container_id')
        ->join('locations','locations.id','=','vehicles.ploading')
        ->join('carstates','carstates.id','=','vehicles.carstate_id')
        ->where('vehicles.customer_id',Auth::id())
        ->where('carstates.id',1)
        ->orderBy('vehicles.id','desc')
        ->paginate(20);
         return view('customer.vehicle.on_theway_vehicles',['vehicles'=>$vehicles,'paginate'=>20]);

    }
    public function search_on_theway_vehicle(Request $request)
    {
        $pagination=20;
        $searchQuery = trim($request['searchValue']);
        $requestData = ['vehicles.vin', 'vehicles.lot_number','vehicles.year','vehicles.make','vehicles.model', 'containers.container_number','locations.location'];
        if($request->ajax()){
       $vehicle=DB::table('tbl_bases')
         ->select("vehicles.*","tbl_bases.vehicle_id","tbl_bases.container_id","containers.container_number","containers.booking_number","containers.eta_port_discharge","containers.etd_port_loading","locations.location","carstates.type")
        ->rightJoin('vehicles','vehicles.id','=','tbl_bases.vehicle_id')
        ->leftJoin('containers','containers.id','=','tbl_bases.container_id')
        ->join('locations','locations.id','=','vehicles.ploading')
        ->join('carstates','carstates.id','=','vehicles.carstate_id')
        ->where('carstates.id', 1)
        ->where('vehicles.customer_id',Auth::id());
        if($request['searchValue']!=''){
         $pagination=20000;
        $vehicle->where(function($q) use($requestData, $searchQuery) {
                    foreach ($requestData as $field)
                       $q->orWhere($field, 'like', "%{$searchQuery}%");
            });
        }

       $vehicles=$vehicle->orderBy('vehicles.id','desc')->paginate($pagination); 
        return view('customer.vehicle.on_theway_vehicles_data',compact('vehicles'))->render();
      }
    }
    public function paginate_on_theway_vehicle(Request $request)
    {
        $paginate=20;
        if($request['paginate']){
          $paginate= $request['paginate'];
        }
        if($request->ajax()){
       $vehicles=DB::table('tbl_bases')
         ->select("vehicles.*","tbl_bases.vehicle_id","tbl_bases.container_id","containers.container_number","containers.booking_number","containers.eta_port_discharge","containers.etd_port_loading","locations.location","carstates.type")
        ->rightJoin('vehicles','vehicles.id','=','tbl_bases.vehicle_id')
        ->leftJoin('containers','containers.id','=','tbl_bases.container_id')
        ->join('locations','locations.id','=','vehicles.ploading')
        ->join('carstates','carstates.id','=','vehicles.carstate_id')
        ->where('vehicles.customer_id',Auth::id())->orderBy('vehicles.id','desc')
         ->where('carstates.id', 1)
        ->orderBy('vehicles.id','desc')
        ->paginate($paginate); 
        return view('customer.vehicle.on_theway_vehicles_data',compact('vehicles','paginate'))->render();
      }
    }

    public function paginate_entry_on_theway_vehicle(Request $request)
    {
        $paginate=20;
        if($request['paginate']){
          $paginate= $request['paginate'];
        }
        if($request->ajax()){
       $vehicles=DB::table('tbl_bases')
         ->select("vehicles.*","tbl_bases.vehicle_id","tbl_bases.container_id","containers.container_number","containers.booking_number","containers.eta_port_discharge","containers.etd_port_loading","locations.location","carstates.type")
        ->rightJoin('vehicles','vehicles.id','=','tbl_bases.vehicle_id')
        ->leftJoin('containers','containers.id','=','tbl_bases.container_id')
        ->join('locations','locations.id','=','vehicles.ploading')
        ->join('carstates','carstates.id','=','vehicles.carstate_id')
        ->where('vehicles.customer_id',Auth::id())->orderBy('vehicles.id','desc')
        ->where('carstates.id', 1)
        ->orderBy('vehicles.id','desc')
        ->paginate($paginate); 
        return view('customer.vehicle.on_theway_vehicles_data',compact('vehicles','paginate'))->render();
      }
    }

    // pending vehicle section 
    public function pending_vehicles()
    {
         $vehicles=DB::table('tbl_bases')
         ->select("vehicles.*","tbl_bases.vehicle_id","tbl_bases.container_id","containers.container_number","containers.booking_number","containers.eta_port_discharge","containers.etd_port_loading","locations.location","carstates.type")
        ->rightJoin('vehicles','vehicles.id','=','tbl_bases.vehicle_id')
        ->leftJoin('containers','containers.id','=','tbl_bases.container_id')
        ->join('locations','locations.id','=','vehicles.ploading')
        ->join('carstates','carstates.id','=','vehicles.carstate_id')
        ->where('vehicles.customer_id',Auth::id())
        ->where('carstates.id',6)
        ->orderBy('vehicles.id','desc')
        ->paginate(20);
         return view('customer.vehicle.pending_vehicles',['vehicles'=>$vehicles,'paginate'=>20]);

    }
    public function search_pending_vehicle(Request $request)
    {
        $pagination=20;
        $searchQuery = trim($request['searchValue']);
        $requestData = ['vehicles.vin', 'vehicles.lot_number','vehicles.year','vehicles.make','vehicles.model', 'containers.container_number','locations.location'];
        if($request->ajax()){
       $vehicle=DB::table('tbl_bases')
         ->select("vehicles.*","tbl_bases.vehicle_id","tbl_bases.container_id","containers.container_number","containers.booking_number","containers.eta_port_discharge","containers.etd_port_loading","locations.location","carstates.type")
        ->rightJoin('vehicles','vehicles.id','=','tbl_bases.vehicle_id')
        ->leftJoin('containers','containers.id','=','tbl_bases.container_id')
        ->join('locations','locations.id','=','vehicles.ploading')
        ->join('carstates','carstates.id','=','vehicles.carstate_id')
        ->where('carstates.id', 6)
        ->where('vehicles.customer_id',Auth::id());
        if($request['searchValue']!=''){
         $pagination=20000;
        $vehicle->where(function($q) use($requestData, $searchQuery) {
                    foreach ($requestData as $field)
                       $q->orWhere($field, 'like', "%{$searchQuery}%");
            });
        }

       $vehicles=$vehicle->orderBy('vehicles.id','desc')->paginate($pagination); 
        return view('customer.vehicle.pending_vehicles_data',compact('vehicles'))->render();
      }
    }
    public function paginate_pending_vehicle(Request $request)
    {
        $paginate=20;
        if($request['paginate']){
          $paginate= $request['paginate'];
        }
        if($request->ajax()){
       $vehicles=DB::table('tbl_bases')
         ->select("vehicles.*","tbl_bases.vehicle_id","tbl_bases.container_id","containers.container_number","containers.booking_number","containers.eta_port_discharge","containers.etd_port_loading","locations.location","carstates.type")
        ->rightJoin('vehicles','vehicles.id','=','tbl_bases.vehicle_id')
        ->leftJoin('containers','containers.id','=','tbl_bases.container_id')
        ->join('locations','locations.id','=','vehicles.ploading')
        ->join('carstates','carstates.id','=','vehicles.carstate_id')
        ->where('vehicles.customer_id',Auth::id())->orderBy('vehicles.id','desc')
         ->where('carstates.id', 6)
        ->orderBy('vehicles.id','desc')
        ->paginate($paginate); 
        return view('customer.vehicle.pending_vehicles_data',compact('vehicles','paginate'))->render();
      }
    }

    public function paginate_entry_pending_vehicle(Request $request)
    {
        $paginate=20;
        if($request['paginate']){
          $paginate= $request['paginate'];
        }
        if($request->ajax()){
       $vehicles=DB::table('tbl_bases')
         ->select("vehicles.*","tbl_bases.vehicle_id","tbl_bases.container_id","containers.container_number","containers.booking_number","containers.eta_port_discharge","containers.etd_port_loading","locations.location","carstates.type")
        ->rightJoin('vehicles','vehicles.id','=','tbl_bases.vehicle_id')
        ->leftJoin('containers','containers.id','=','tbl_bases.container_id')
        ->join('locations','locations.id','=','vehicles.ploading')
        ->join('carstates','carstates.id','=','vehicles.carstate_id')
        ->where('vehicles.customer_id',Auth::id())->orderBy('vehicles.id','desc')
        ->where('carstates.id', 6)
        ->orderBy('vehicles.id','desc')
        ->paginate($paginate); 
        return view('customer.vehicle.pending_vehicles_data',compact('vehicles','paginate'))->render();
      }
    }

// On hand  no title  vehicle section 
    public function onhand_notitle_vehicles()
    {
         $vehicles=DB::table('tbl_bases')
         ->select("vehicles.*","tbl_bases.vehicle_id","tbl_bases.container_id","containers.container_number","containers.booking_number","containers.eta_port_discharge","containers.etd_port_loading","locations.location","carstates.type")
        ->rightJoin('vehicles','vehicles.id','=','tbl_bases.vehicle_id')
        ->leftJoin('containers','containers.id','=','tbl_bases.container_id')
        ->join('locations','locations.id','=','vehicles.ploading')
        ->join('carstates','carstates.id','=','vehicles.carstate_id')
        ->where('vehicles.customer_id',Auth::id())
        ->where('carstates.id',2)
        ->orderBy('vehicles.id','desc')
        ->paginate(20);
         return view('customer.vehicle.onhand_notitle_vehicles',['vehicles'=>$vehicles,'paginate'=>20]);

    }
    public function search_onhand_notitle_vehicle(Request $request)
    {
        $pagination=20;
        $searchQuery = trim($request['searchValue']);
        $requestData = ['vehicles.vin', 'vehicles.lot_number','vehicles.year','vehicles.make','vehicles.model', 'containers.container_number','locations.location'];
        if($request->ajax()){
       $vehicle=DB::table('tbl_bases')
         ->select("vehicles.*","tbl_bases.vehicle_id","tbl_bases.container_id","containers.container_number","containers.booking_number","containers.eta_port_discharge","containers.etd_port_loading","locations.location","carstates.type")
        ->rightJoin('vehicles','vehicles.id','=','tbl_bases.vehicle_id')
        ->leftJoin('containers','containers.id','=','tbl_bases.container_id')
        ->join('locations','locations.id','=','vehicles.ploading')
        ->join('carstates','carstates.id','=','vehicles.carstate_id')
        ->where('carstates.id', 2)
        ->where('vehicles.customer_id',Auth::id());
        if($request['searchValue']!=''){
         $pagination=20000;
        $vehicle->where(function($q) use($requestData, $searchQuery) {
                    foreach ($requestData as $field)
                       $q->orWhere($field, 'like', "%{$searchQuery}%");
            });
        }

       $vehicles=$vehicle->orderBy('vehicles.id','desc')->paginate($pagination); 
        return view('customer.vehicle.onhand_notitle_vehicles_data',compact('vehicles'))->render();
      }
    }
    public function paginate_onhand_notitle_vehicle(Request $request)
    {
        $paginate=20;
        if($request['paginate']){
          $paginate= $request['paginate'];
        }
        if($request->ajax()){
       $vehicles=DB::table('tbl_bases')
         ->select("vehicles.*","tbl_bases.vehicle_id","tbl_bases.container_id","containers.container_number","containers.booking_number","containers.eta_port_discharge","containers.etd_port_loading","locations.location","carstates.type")
        ->rightJoin('vehicles','vehicles.id','=','tbl_bases.vehicle_id')
        ->leftJoin('containers','containers.id','=','tbl_bases.container_id')
        ->join('locations','locations.id','=','vehicles.ploading')
        ->join('carstates','carstates.id','=','vehicles.carstate_id')
        ->where('vehicles.customer_id',Auth::id())->orderBy('vehicles.id','desc')
         ->where('carstates.id', 2)
        ->orderBy('vehicles.id','desc')
        ->paginate($paginate); 
        return view('customer.vehicle.onhand_notitle_vehicles_data',compact('vehicles','paginate'))->render();
      }
    }

    public function paginate_entry_onhand_notitle_vehicle(Request $request)
    {
        $paginate=20;
        if($request['paginate']){
          $paginate= $request['paginate'];
        }
        if($request->ajax()){
       $vehicles=DB::table('tbl_bases')
         ->select("vehicles.*","tbl_bases.vehicle_id","tbl_bases.container_id","containers.container_number","containers.booking_number","containers.eta_port_discharge","containers.etd_port_loading","locations.location","carstates.type")
        ->rightJoin('vehicles','vehicles.id','=','tbl_bases.vehicle_id')
        ->leftJoin('containers','containers.id','=','tbl_bases.container_id')
        ->join('locations','locations.id','=','vehicles.ploading')
        ->join('carstates','carstates.id','=','vehicles.carstate_id')
        ->where('vehicles.customer_id',Auth::id())->orderBy('vehicles.id','desc')
        ->where('carstates.id', 2)
        ->orderBy('vehicles.id','desc')
        ->paginate($paginate); 
        return view('customer.vehicle.onhand_notitle_vehicles_data',compact('vehicles','paginate'))->render();
      }
    }

    // On hand  with title  vehicle section 
    public function onhand_withtitle_vehicles()
    {
         $vehicles=DB::table('tbl_bases')
         ->select("vehicles.*","tbl_bases.vehicle_id","tbl_bases.container_id","containers.container_number","containers.booking_number","containers.eta_port_discharge","containers.etd_port_loading","locations.location","carstates.type")
        ->rightJoin('vehicles','vehicles.id','=','tbl_bases.vehicle_id')
        ->leftJoin('containers','containers.id','=','tbl_bases.container_id')
        ->join('locations','locations.id','=','vehicles.ploading')
        ->join('carstates','carstates.id','=','vehicles.carstate_id')
        ->where('vehicles.customer_id',Auth::id())
        ->where('carstates.id',3)
        ->orderBy('vehicles.id','desc')
        ->paginate(20);
         return view('customer.vehicle.onhand_withtitle_vehicles',['vehicles'=>$vehicles,'paginate'=>20]);

    }
    public function search_onhand_withtitle_vehicle(Request $request)
    {
        $pagination=20;
        $searchQuery = trim($request['searchValue']);
        $requestData = ['vehicles.vin', 'vehicles.lot_number','vehicles.year','vehicles.make','vehicles.model', 'containers.container_number','locations.location'];
        if($request->ajax()){
       $vehicle=DB::table('tbl_bases')
         ->select("vehicles.*","tbl_bases.vehicle_id","tbl_bases.container_id","containers.container_number","containers.booking_number","containers.eta_port_discharge","containers.etd_port_loading","locations.location","carstates.type")
        ->rightJoin('vehicles','vehicles.id','=','tbl_bases.vehicle_id')
        ->leftJoin('containers','containers.id','=','tbl_bases.container_id')
        ->join('locations','locations.id','=','vehicles.ploading')
        ->join('carstates','carstates.id','=','vehicles.carstate_id')
        ->where('carstates.id', 3)
        ->where('vehicles.customer_id',Auth::id());
        if($request['searchValue']!=''){
         $pagination=20000;
        $vehicle->where(function($q) use($requestData, $searchQuery) {
                    foreach ($requestData as $field)
                       $q->orWhere($field, 'like', "%{$searchQuery}%");
            });
        }

       $vehicles=$vehicle->orderBy('vehicles.id','desc')->paginate($pagination); 
        return view('customer.vehicle.onhand_withtitle_vehicles_data',compact('vehicles'))->render();
      }
    }
    public function paginate_onhand_withtitle_vehicle(Request $request)
    {
        $paginate=20;
        if($request['paginate']){
          $paginate= $request['paginate'];
        }
        if($request->ajax()){
       $vehicles=DB::table('tbl_bases')
         ->select("vehicles.*","tbl_bases.vehicle_id","tbl_bases.container_id","containers.container_number","containers.booking_number","containers.eta_port_discharge","containers.etd_port_loading","locations.location","carstates.type")
        ->rightJoin('vehicles','vehicles.id','=','tbl_bases.vehicle_id')
        ->leftJoin('containers','containers.id','=','tbl_bases.container_id')
        ->join('locations','locations.id','=','vehicles.ploading')
        ->join('carstates','carstates.id','=','vehicles.carstate_id')
        ->where('vehicles.customer_id',Auth::id())->orderBy('vehicles.id','desc')
         ->where('carstates.id',3)
        ->orderBy('vehicles.id','desc')
        ->paginate($paginate); 
        return view('customer.vehicle.onhand_withtitle_vehicles_data',compact('vehicles','paginate'))->render();
      }
    }

    public function paginate_entry_onhand_withtitle_vehicle(Request $request)
    {
        $paginate=20;
        if($request['paginate']){
          $paginate= $request['paginate'];
        }
        if($request->ajax()){
       $vehicles=DB::table('tbl_bases')
         ->select("vehicles.*","tbl_bases.vehicle_id","tbl_bases.container_id","containers.container_number","containers.booking_number","containers.eta_port_discharge","containers.etd_port_loading","locations.location","carstates.type")
        ->rightJoin('vehicles','vehicles.id','=','tbl_bases.vehicle_id')
        ->leftJoin('containers','containers.id','=','tbl_bases.container_id')
        ->join('locations','locations.id','=','vehicles.ploading')
        ->join('carstates','carstates.id','=','vehicles.carstate_id')
        ->where('vehicles.customer_id',Auth::id())->orderBy('vehicles.id','desc')
        ->where('carstates.id',3)
        ->orderBy('vehicles.id','desc')
        ->paginate($paginate); 
        return view('customer.vehicle.onhand_withtitle_vehicles_data',compact('vehicles','paginate'))->render();
      }
    }

        // shipped vehicle section 
    public function shipped_vehicles()
    {
         $vehicles=DB::table('tbl_bases')
         ->select("vehicles.id","vehicles.link","vehicles.year","vehicles.make","vehicles.model","vehicles.color","vehicles.vin","vehicles.deliver_date","vehicles.shipas","tbl_bases.vehicle_id","tbl_bases.container_id","containers.container_number","containers.booking_number","containers.eta_port_discharge","containers.etd_port_loading","locations.location","carstates.type")
        ->join('vehicles','vehicles.id','=','tbl_bases.vehicle_id')
        ->join('containers','containers.id','=','tbl_bases.container_id')
        ->join('locations','locations.id','=','vehicles.ploading')
        ->join('carstates','carstates.id','=','vehicles.carstate_id')
        ->where('vehicles.customer_id',Auth::id())
        ->where('carstates.id',5)
        ->orderBy('vehicles.id','desc')
        ->paginate(20);
         return view('customer.vehicle.shipped_vehicles',['vehicles'=>$vehicles,'paginate'=>20]);

    }
    public function search_shipped_vehicle(Request $request)
    {
        $pagination=20;
        $searchQuery = trim($request['searchValue']);
        $requestData = ['vehicles.vin', 'vehicles.lot_number','vehicles.year','vehicles.make','vehicles.model', 'containers.container_number','locations.location'];
        if($request->ajax()){
       $vehicle=DB::table('tbl_bases')
         ->select("vehicles.id","vehicles.link","vehicles.year","vehicles.make","vehicles.model","vehicles.color","vehicles.vin","vehicles.deliver_date","vehicles.shipas","tbl_bases.vehicle_id","tbl_bases.container_id","containers.container_number","containers.booking_number","containers.eta_port_discharge","containers.etd_port_loading","locations.location","carstates.type")
        ->join('vehicles','vehicles.id','=','tbl_bases.vehicle_id')
        ->join('containers','containers.id','=','tbl_bases.container_id')
        ->join('locations','locations.id','=','vehicles.ploading')
        ->join('carstates','carstates.id','=','vehicles.carstate_id')
        ->where('carstates.id',5)
        ->where('vehicles.customer_id',Auth::id());
        if($request['searchValue']!=''){
         $pagination=20000;
        $vehicle->where(function($q) use($requestData, $searchQuery) {
                    foreach ($requestData as $field)
                       $q->orWhere($field, 'like', "%{$searchQuery}%");
            });
        }

       $vehicles=$vehicle->orderBy('vehicles.id','desc')->paginate($pagination); 
        return view('customer.vehicle.shipped_vehicles_data',compact('vehicles'))->render();
      }
    }
    public function paginate_shipped_vehicle(Request $request)
    {
        $paginate=20;
        if($request['paginate']){
          $paginate= $request['paginate'];
        }
        if($request->ajax()){
       $vehicles=DB::table('tbl_bases')
         ->select("vehicles.id","vehicles.link","vehicles.year","vehicles.make","vehicles.model","vehicles.color","vehicles.vin","vehicles.deliver_date","vehicles.shipas","tbl_bases.vehicle_id","tbl_bases.container_id","containers.container_number","containers.booking_number","containers.eta_port_discharge","containers.etd_port_loading","locations.location","carstates.type")
        ->join('vehicles','vehicles.id','=','tbl_bases.vehicle_id')
        ->join('containers','containers.id','=','tbl_bases.container_id')
        ->join('locations','locations.id','=','vehicles.ploading')
        ->join('carstates','carstates.id','=','vehicles.carstate_id')
        ->where('vehicles.customer_id',Auth::id())
         ->where('carstates.id',5)
        ->orderBy('vehicles.id','desc')
        ->paginate($paginate); 
        return view('customer.vehicle.shipped_vehicles_data',compact('vehicles','paginate'))->render();
      }
    }

    public function paginate_entry_shipped_vehicle(Request $request)
    {
        $paginate=20;
        if($request['paginate']){
          $paginate= $request['paginate'];
        }
        if($request->ajax()){
       $vehicles=DB::table('tbl_bases')
         ->select("vehicles.id","vehicles.link","vehicles.year","vehicles.make","vehicles.model","vehicles.color","vehicles.vin","vehicles.deliver_date","vehicles.shipas","tbl_bases.vehicle_id","tbl_bases.container_id","containers.container_number","containers.booking_number","containers.eta_port_discharge","containers.etd_port_loading","locations.location","carstates.type")
        ->join('vehicles','vehicles.id','=','tbl_bases.vehicle_id')
        ->join('containers','containers.id','=','tbl_bases.container_id')
        ->join('locations','locations.id','=','vehicles.ploading')
        ->join('carstates','carstates.id','=','vehicles.carstate_id')
        ->where('vehicles.customer_id',Auth::id())
        ->where('carstates.id',5)
        ->orderBy('vehicles.id','desc')
        ->paginate($paginate); 
        return view('customer.vehicle.shipped_vehicles_data',compact('vehicles','paginate'))->render();
      }
    }

     // vehicle dateline section 
    public function dateline_vehicles()
    {
         $vehicles=DB::table('tbl_bases')
         ->select("vehicles.id","vehicles.year","vehicles.make","vehicles.model","vehicles.color","vehicles.vin","vehicles.lot_number","vehicles.purchase_date","vehicles.rpgldate","vehicles.deliver_date","vehicles.payment_date","vehicles.towing_request_date","vehicles.dpicd","vehicles.pickup_date","vehicles.number_days_pur","vehicles.number_days_rep","tbl_bases.vehicle_id","tbl_bases.container_id","containers.container_number","containers.booking_number","containers.eta_port_discharge","containers.etd_port_loading","carstates.type")
        ->join('vehicles','vehicles.id','=','tbl_bases.vehicle_id')
        ->join('containers','containers.id','=','tbl_bases.container_id')
        ->join('carstates','carstates.id','=','vehicles.carstate_id')
        ->where('vehicles.customer_id',Auth::id())
        ->orderBy('vehicles.id','desc')
        ->take(100)
        ->paginate(20); 
         return view('customer.vehicle.vehicles_dateline',['vehicles'=>$vehicles,'paginate'=>20]);

    }
    public function search_dateline_vehicle(Request $request)
    {
        $pagination=20;
        $searchQuery = trim($request['searchValue']);
        $requestData = ['vehicles.vin', 'vehicles.lot_number','vehicles.year','vehicles.make','vehicles.model', 'containers.container_number'];
        if($request->ajax()){
       $vehicle=DB::table('tbl_bases')
         ->select("vehicles.id","vehicles.year","vehicles.make","vehicles.model","vehicles.color","vehicles.vin","vehicles.lot_number","vehicles.purchase_date","vehicles.rpgldate","vehicles.deliver_date","vehicles.payment_date","vehicles.towing_request_date","vehicles.dpicd","vehicles.pickup_date","vehicles.number_days_pur","vehicles.number_days_rep","tbl_bases.vehicle_id","tbl_bases.container_id","containers.container_number","containers.booking_number","containers.eta_port_discharge","containers.etd_port_loading","carstates.type")
        ->join('vehicles','vehicles.id','=','tbl_bases.vehicle_id')
        ->join('containers','containers.id','=','tbl_bases.container_id')
        ->join('carstates','carstates.id','=','vehicles.carstate_id')
        ->where('vehicles.customer_id',Auth::id());
        if($request['searchValue']!=''){
         $pagination=20000;
        $vehicle->where(function($q) use($requestData, $searchQuery) {
                    foreach ($requestData as $field)
                       $q->orWhere($field, 'like', "%{$searchQuery}%");
            });
        }

       $vehicles=$vehicle->orderBy('vehicles.id','desc')->paginate($pagination); 
        return view('customer.vehicle.vehicles_dateline_data',compact('vehicles'))->render();
      }
    }
    public function paginate_dateline_vehicle(Request $request)
    {
        $paginate=20;
        if($request['paginate']){
          $paginate= $request['paginate'];
        }
        if($request->ajax()){
       $vehicles=DB::table('tbl_bases')
         ->select("vehicles.id","vehicles.year","vehicles.make","vehicles.model","vehicles.color","vehicles.vin","vehicles.lot_number","vehicles.purchase_date","vehicles.rpgldate","vehicles.deliver_date","vehicles.payment_date","vehicles.towing_request_date","vehicles.dpicd","vehicles.pickup_date","vehicles.number_days_pur","vehicles.number_days_rep","tbl_bases.vehicle_id","tbl_bases.container_id","containers.container_number","containers.booking_number","containers.eta_port_discharge","containers.etd_port_loading","carstates.type")
        ->join('vehicles','vehicles.id','=','tbl_bases.vehicle_id')
        ->join('containers','containers.id','=','tbl_bases.container_id')
        ->join('carstates','carstates.id','=','vehicles.carstate_id')
        ->where('vehicles.customer_id',Auth::id())->orderBy('vehicles.id','desc')
        ->orderBy('vehicles.id','desc')
        ->paginate($paginate); 
        return view('customer.vehicle.vehicles_dateline_data',compact('vehicles','paginate'))->render();
      }
    }

    public function paginate_entry_dateline_vehicle(Request $request)
    {
        $paginate=20;
        if($request['paginate']){
          $paginate= $request['paginate'];
        }
        if($request->ajax()){
       $vehicles=DB::table('tbl_bases')
         ->select("vehicles.id","vehicles.year","vehicles.make","vehicles.model","vehicles.color","vehicles.vin","vehicles.lot_number","vehicles.purchase_date","vehicles.rpgldate","vehicles.deliver_date","vehicles.payment_date","vehicles.towing_request_date","vehicles.dpicd","vehicles.pickup_date","vehicles.number_days_pur","vehicles.number_days_rep","tbl_bases.vehicle_id","tbl_bases.container_id","containers.container_number","containers.booking_number","containers.eta_port_discharge","containers.etd_port_loading","carstates.type")
        ->join('vehicles','vehicles.id','=','tbl_bases.vehicle_id')
        ->join('containers','containers.id','=','tbl_bases.container_id')
        ->join('carstates','carstates.id','=','vehicles.carstate_id')
        ->where('vehicles.customer_id',Auth::id())->orderBy('vehicles.id','desc')
        ->orderBy('vehicles.id','desc')
        ->paginate($paginate); 
        return view('customer.vehicle.vehicles_dateline_data',compact('vehicles','paginate'))->render();
      }
    }

    // vehicle cost analysis section 
    public function vehicle_cost_analysis()
    {
         $vehicles=DB::table('tbl_bases')
         ->select(
             "vehicles.vin",
                  "vehicles.year",
                  "vehicles.make",
                  "vehicles.model",
                  "vehicles.color",
                  "vehicles.vehicle_price",
                  "vehicles.tow_amounts",
                  "vehicles.dismantal_cost",
                  "vehicles.ship_cost",
                  "vehicles.pgl_storage_costs",
                  "vehicles.storage_pod_cost",
                  "vehicles.dubai_custom_cost",
                  "vehicles.other_cost",
                  "vehicles.total_cost",
                  "vehicles.sales_cost",
                  "vehicles.profit",
                  "vehicles.percent_profit",
         "tbl_bases.vehicle_id","tbl_bases.container_id","containers.container_number","containers.booking_number","containers.eta_port_discharge","containers.etd_port_loading")
        ->join('vehicles','vehicles.id','=','tbl_bases.vehicle_id')
        ->join('containers','containers.id','=','tbl_bases.container_id')
        // ->join('locations','locations.id','=','vehicles.ploading')
        // ->join('carstates','carstates.id','=','vehicles.carstate_id')
        ->where('vehicles.customer_id',Auth::id())
        ->orderBy('vehicles.id','desc')
        ->paginate(20);
         return view('customer.vehicle.vehicle_cost_analysis',['vehicles'=>$vehicles,'paginate'=>20]);

    }
    public function search_vehicle_cost_analysis(Request $request)
    {
        $pagination=20;
        $searchQuery = trim($request['searchValue']);
        $requestData = ['vehicles.vin','vehicles.year','vehicles.make','vehicles.model', 'containers.container_number'];
        if($request->ajax()){
       $vehicle=DB::table('tbl_bases')
         ->select(
             "vehicles.vin",
                  "vehicles.year",
                  "vehicles.make",
                  "vehicles.model",
                  "vehicles.color",
                  "vehicles.vehicle_price",
                  "vehicles.tow_amounts",
                  "vehicles.dismantal_cost",
                  "vehicles.ship_cost",
                  "vehicles.pgl_storage_costs",
                  "vehicles.storage_pod_cost",
                  "vehicles.dubai_custom_cost",
                  "vehicles.other_cost",
                  "vehicles.total_cost",
                  "vehicles.sales_cost",
                  "vehicles.profit",
                  "vehicles.percent_profit",
         "tbl_bases.vehicle_id","tbl_bases.container_id","containers.container_number","containers.booking_number","containers.eta_port_discharge","containers.etd_port_loading")
        ->join('vehicles','vehicles.id','=','tbl_bases.vehicle_id')
        ->join('containers','containers.id','=','tbl_bases.container_id')
        ->where('vehicles.customer_id',Auth::id());
        if($request['searchValue']!=''){
         $pagination=20;
        $vehicle->where(function($q) use($requestData, $searchQuery) {
                    foreach ($requestData as $field)
                       $q->orWhere($field, 'like', "%{$searchQuery}%");
            });
        }

       $vehicles=$vehicle->orderBy('vehicles.id','desc')->paginate($pagination); 
        return view('customer.vehicle.vehicle_cost_analysis_data',compact('vehicles'))->render();
      }
    }
    public function paginate_vehicle_cost_analysis(Request $request)
    {
        $paginate=20;
        if($request['paginate']){
          $paginate= $request['paginate'];
        }
        if($request->ajax()){
       $vehicles=DB::table('tbl_bases')
         ->select(
             "vehicles.vin",
                  "vehicles.year",
                  "vehicles.make",
                  "vehicles.model",
                  "vehicles.color",
                  "vehicles.vehicle_price",
                  "vehicles.tow_amounts",
                  "vehicles.dismantal_cost",
                  "vehicles.ship_cost",
                  "vehicles.pgl_storage_costs",
                  "vehicles.storage_pod_cost",
                  "vehicles.dubai_custom_cost",
                  "vehicles.other_cost",
                  "vehicles.total_cost",
                  "vehicles.sales_cost",
                  "vehicles.profit",
                  "vehicles.percent_profit",
         "tbl_bases.vehicle_id","tbl_bases.container_id","containers.container_number","containers.booking_number","containers.eta_port_discharge","containers.etd_port_loading")
        ->join('vehicles','vehicles.id','=','tbl_bases.vehicle_id')
        ->join('containers','containers.id','=','tbl_bases.container_id')
        ->where('vehicles.customer_id',Auth::id())->orderBy('vehicles.id','desc')
        ->orderBy('vehicles.id','desc')
        ->paginate($paginate); 
        return view('customer.vehicle.vehicle_cost_analysis_data',compact('vehicles','paginate'))->render();
      }
    }

    // find vehicle base on location and status
    public function vehicle_base_location_and_status($location_id='',$status='')
    {
        $pagination=20;
       $vehicle=DB::table('vehicles')
         ->select(
            "vehicles.id","vehicles.link",
             "vehicles.vin",
              "vehicles.lot_number",
               "vehicles.title_status",
                "vehicles.c_remark",
                 "vehicles.purchase_date",
                  "vehicles.deliver_date",
                  "vehicles.year",
                  "vehicles.make",
                  "vehicles.model",
                  "vehicles.color",
                  "vehicles.file",
                  "vehicles.customer_note",
                  "locations.location",
                  "carstates.type"      
            )
        ->join('locations','locations.id','=','vehicles.ploading')
        ->join('carstates','carstates.id','=','vehicles.carstate_id')
        ->where('vehicles.customer_id',Auth::id())
        ->where('locations.id',$location_id)
       ->orderBy('vehicles.id','desc');
       if($status!='10'){
        $vehicle->where('carstates.id',$status);
       }
      $vehicles=$vehicle->paginate(20); 
        return view('customer.vehicle.search_vehicle',['vehicles'=>$vehicles,'paginate'=>20,'veh_location'=>$location_id,'veh_status'=>$status]);
    }

    public function vehicle_base_location_and_status_search(Request $request)
    {
        $pagination=20;
        $status=$request['status'];
        $searchQuery = trim($request['searchValue']);
        $requestData = ['vehicles.vin', 'vehicles.lot_number','vehicles.year','vehicles.make','vehicles.model','locations.location'];
        if($request->ajax()){
       $vehicle=DB::table('vehicles')
         ->select(
            "vehicles.id","vehicles.link",
             "vehicles.vin",
              "vehicles.lot_number",
               "vehicles.title_status",
                "vehicles.c_remark",
                 "vehicles.purchase_date",
                  "vehicles.deliver_date",
                  "vehicles.year",
                  "vehicles.make",
                  "vehicles.model",
                  "vehicles.color",
                  "vehicles.file",
                  "vehicles.customer_note",
                  "locations.location",
                  "carstates.type"      
            )
        ->join('locations','locations.id','=','vehicles.ploading')
        ->join('carstates','carstates.id','=','vehicles.carstate_id')
        ->where('locations.id',$request['location_id'])
        ->where('vehicles.customer_id',Auth::id());
        if($status!='10'){
        $vehicle->where('carstates.id',$status);
       }
        if($searchQuery!=''){
         $pagination=20000;
        $vehicle->where(function($q) use($requestData, $searchQuery) {
                foreach ($requestData as $field)
                 $q->orWhere($field, 'like', "%{$searchQuery}%");
          });
        }
       $vehicles=$vehicle->orderBy('vehicles.id','desc')->paginate($pagination); 
        return view('customer.vehicle.all_vehicles_data',compact('vehicles'))->render();
      }
    }

    public function paginate_entry_vehicle_base_location_and_status(Request $request)
    {
       $paginate=20;
       $status=$request['status'];
        if($request['paginate']){
          $paginate= $request['paginate'];
        }
        if($request->ajax()){
       $vehicle=DB::table('vehicles')
         ->select(
            "vehicles.id","vehicles.link",
             "vehicles.vin",
              "vehicles.lot_number",
               "vehicles.title_status",
                "vehicles.c_remark",
                 "vehicles.purchase_date",
                  "vehicles.deliver_date",
                  "vehicles.year",
                  "vehicles.make",
                  "vehicles.model",
                  "vehicles.color",
                  "vehicles.file",
                  "vehicles.customer_note",
                  "locations.location",
                  "carstates.type"      
            )
        ->join('locations','locations.id','=','vehicles.ploading')
        ->join('carstates','carstates.id','=','vehicles.carstate_id')
        ->where('vehicles.customer_id',Auth::id())
        // ->where('carstates.id',$request['status'])
        ->where('locations.id',$request['location_id'])
        ->orderBy('vehicles.id','desc');
        if($status!='10'){
        $vehicle->where('carstates.id',$status);
       }
        $vehicles=$vehicle->paginate($paginate); 
        return view('customer.vehicle.all_vehicles_data',compact('vehicles','paginate'))->render();
      } 
    }

    public function vehicle_condational_report($id='')
    {
       $vehicle = $this->vehicle::find($id);
        return view('customer.vehicle.vehicle_condational_report', ['signle_vehicle' =>$vehicle]); 
    }

    public function addnote_for_vehicle(Request $request)
    {
         if($vehicle=DB::table('vehicles')
        ->where('id',$request['vehicle_id'])
        ->update(['customer_note'=>$request['note'],'customer_note_date'=>date('Y-m-d')])){
            echo json_encode(true);
         }
         else {
            echo json_encode(false);
         }
    }

    public function vehicle_pdf($name='')
    {
       $vehicles=DB::table('tbl_bases')
         ->select(
            "vehicles.id","vehicles.link",
             "vehicles.vin",
              "vehicles.lot_number",
               "vehicles.title_status",
                "vehicles.c_remark",
                 "vehicles.purchase_date",
                  "vehicles.deliver_date",
                  "vehicles.year",
                  "vehicles.make",
                  "vehicles.model",
                  "vehicles.color",
                  "vehicles.customer_note",
            "tbl_bases.vehicle_id","tbl_bases.container_id","containers.container_number","containers.booking_number","containers.eta_port_discharge","containers.etd_port_loading","locations.location","carstates.type")
        ->join('vehicles','vehicles.id','=','tbl_bases.vehicle_id')
        ->join('containers','containers.id','=','tbl_bases.container_id')
        ->join('locations','locations.id','=','vehicles.ploading')
        ->join('carstates','carstates.id','=','vehicles.carstate_id')
        ->where('vehicles.customer_id',Auth::id())
        ->orderBy('vehicles.id','desc')
        ->paginate(20);

          // return PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('customer.vehicle.all_vehicles',['vehicles'=>$vehicles],['format' => ['A4',190,236]])->stream();

        $pdf = PDF::loadView('customer.vehicle.vehicle_pdf',['vehicles'=>$vehicles],['format' => 'A4']);
        return $pdf->download('vehicle.pdf');

    }

     public function vehicle_excel($name='')
        {
           $vehicles=DB::table('tbl_bases')
             ->select(
                "vehicles.id","vehicles.link",
                 "vehicles.vin",
                  "vehicles.lot_number",
                   "vehicles.title_status",
                    "vehicles.c_remark",
                     "vehicles.purchase_date",
                      "vehicles.deliver_date",
                      "vehicles.year",
                      "vehicles.make",
                      "vehicles.model",
                      "vehicles.color",
                      "vehicles.customer_note",
                "tbl_bases.vehicle_id","tbl_bases.container_id","containers.container_number","containers.booking_number","containers.eta_port_discharge","containers.etd_port_loading","locations.location","carstates.type")
            ->join('vehicles','vehicles.id','=','tbl_bases.vehicle_id')
            ->join('containers','containers.id','=','tbl_bases.container_id')
            ->join('locations','locations.id','=','vehicles.ploading')
            ->join('carstates','carstates.id','=','vehicles.carstate_id')
            ->where('vehicles.customer_id',Auth::id())
            ->orderBy('vehicles.id','desc')
            ->paginate(20);

              return Excel::download($vehicles, 'users.xlsx');

        }

     function vehicle_photo($id=''){
          $data=DB::table('vehicles')->where('id',$id)->first();
           $link=$data->link;
           return view('customer.vehicle.vehicle_photo')->with(['id'=> $id,'link'=>$link]);  
     }

     // change vehicle status 
    public function change_status_shipment(Request $request)
    {
        $ids = $request->ids;
         DB::table('vehicles')->whereIn('id',explode(",",$ids))
         ->update(['status' =>$request->status]);
        return response()->json(['status'=>true,'message'=>'Status changed Successfully !']);
    }
    
}
