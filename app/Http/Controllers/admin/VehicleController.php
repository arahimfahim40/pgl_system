<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\VehicleModel;
use App\CustomerModel;
use App\tbl_base;
use Illuminate\Http\Request;
use DB;
use PDF;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

class VehicleController extends Controller
{
    protected $vehicle;
    public function __construct(VehicleModel $vehicle)
    {
        $this->middleware('auth:admin');  
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
                  "vehicles.carstate_id",
                  "vehicles.car_keys",
                  "vehicles.radio",
                  "vehicles.customer_note",
                  "vehicles.htnumber",  
                  "vehicles.title_number",
                  "vehicles.title_state",
                  "locations.location",
                  "carstates.type",
                  "companies.name"

            )
        // ->rightJoin('vehicles','vehicles.id','=','tbl_bases.vehicle_id')
        // ->leftJoin('containers','containers.id','=','tbl_bases.container_id')
         // ->leftJoin('tbl_bases','tbl_bases.vehicle_id','=','vehicles.id')
         // ->join('containers','containers.id','=','tbl_bases.container_id')
        ->join('locations','locations.id','=','vehicles.ploading')
        ->join('carstates','carstates.id','=','vehicles.carstate_id')
        ->join('companies','companies.id','=','vehicles.company_id')    
        ->orderBy('vehicles.id','desc')
        ->paginate(20);
         return view('admin.vehicle.all_vehicles',['vehicles'=>$vehicles,'paginate'=>20]);

    }
    public function search_all_vehicle(Request $request)
    {
        $pagination=20;
        $searchQuery = trim($request['searchValue']);
        $requestData = ['vehicles.vin', 'vehicles.lot_number','vehicles.year','vehicles.make','vehicles.model','locations.location','companies.name'];
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
                  "vehicles.carstate_id",
                  "vehicles.car_keys",
                  "vehicles.radio",
                  "vehicles.customer_note",
                  "vehicles.htnumber",  
                  "vehicles.title_number",
                  "vehicles.title_state",
                  "locations.location",
                  "carstates.type",
                  "companies.name"      
            )
        ->join('locations','locations.id','=','vehicles.ploading')
        ->join('carstates','carstates.id','=','vehicles.carstate_id')
        ->join('companies','companies.id','vehicles.company_id');
        if($searchQuery!=''){
         $pagination=100;
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
                  "vehicles.carstate_id",
                  "vehicles.car_keys",
                  "vehicles.radio",
                  "vehicles.customer_note",
                  "vehicles.htnumber",  
                  "vehicles.title_number",
                  "vehicles.title_state",
                  "companies.name",

            "tbl_bases.vehicle_id","tbl_bases.container_id","containers.container_number","containers.booking_number","containers.eta_port_discharge","containers.etd_port_loading","locations.location","carstates.type")
        ->rightJoin('vehicles','vehicles.id','=','tbl_bases.vehicle_id')
        ->leftJoin('containers','containers.id','=','tbl_bases.container_id')
        ->join('locations','locations.id','=','vehicles.ploading')
        ->join('carstates','carstates.id','=','vehicles.carstate_id')
        ->join('companies','companies.id','=','vehicles.company_id')
        ->where('containers.container_number','like','%'.$searchQuery.'%')
        ->orderBy('vehicles.id','desc')->paginate($pagination); 
       } 
        return view('admin.vehicle.all_vehicles_data',compact('vehicles'))->render();
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
                  "vehicles.carstate_id",
                  "vehicles.car_keys",
                  "vehicles.radio",
                  "vehicles.customer_note",
                  "vehicles.htnumber",  
                  "vehicles.title_number",
                  "vehicles.title_state",
                  "locations.location",
                  "carstates.type",
                  "companies.name"      
            )
        ->join('locations','locations.id','=','vehicles.ploading')
        ->join('carstates','carstates.id','=','vehicles.carstate_id')
        ->join('companies','companies.id','=','vehicles.company_id')
        ->orderBy('vehicles.id','desc')
        ->paginate($paginate); 
        return view('admin.vehicle.all_vehicles_data',compact('vehicles','paginate'))->render();
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
                  "vehicles.carstate_id",
                  "vehicles.car_keys",
                  "vehicles.radio",
                  "vehicles.customer_note",
                  "vehicles.htnumber",  
                  "vehicles.title_number",
                  "vehicles.title_state",
                  "locations.location",
                  "carstates.type",
                  "companies.name"      
            )
        ->join('locations','locations.id','=','vehicles.ploading')
        ->join('carstates','carstates.id','=','vehicles.carstate_id')
        ->join('companies','companies.id','=','vehicles.company_id')
        ->orderBy('vehicles.id','desc')
        ->paginate($paginate); 
        return view('admin.vehicle.all_vehicles_data',compact('vehicles','paginate'))->render();
      }
    }

// on the way vehicle section 
    public function on_theway_vehicles()
    {
         $vehicles=DB::table('vehicles')
         ->select(
            "vehicles.id",
             "vehicles.vin",
              "vehicles.lot_number",
                "vehicles.c_remark",
                 "vehicles.purchase_date",
                  "vehicles.year",
                  "vehicles.make",
                  "vehicles.model",
                  "vehicles.color",
                  "vehicles.file",
                  "vehicles.is_key",
                  "vehicles.carstate_id",
                  "vehicles.car_keys",
                  "vehicles.auction",
                  "vehicles.auction_city",
                  "vehicles.towingcompany",
                  "vehicles.rpgldate",
                  "vehicles.dpicd",
                  "vehicles.cdname",
                  "vehicles.pickup_due_date",
                  "vehicles.pickup_date",
                  "vehicles.number_days_pur",
                  "vehicles.number_days_rep",
                  "vehicles.htnumber",  
                  "vehicles.title_number",
                  "locations.location",
                  "carstates.type",
                  "companies.name as company_name"

            )
        ->join('locations','locations.id','=','vehicles.ploading')
        ->join('carstates','carstates.id','=','vehicles.carstate_id')
        ->join('companies','companies.id','=','vehicles.company_id')    
        ->where('carstates.id',1)
        ->orderBy('vehicles.id','desc')
        ->paginate(20);
         return view('admin.vehicle.on_theway_vehicles',['vehicles'=>$vehicles,'paginate'=>20]);

    }
    public function search_on_theway_vehicle(Request $request)
    {
        $pagination=20;
        $searchQuery = trim($request['searchValue']);
        $requestData = ['vehicles.vin', 'vehicles.lot_number','vehicles.year','vehicles.make','vehicles.model','locations.location','companies.name'];
        if($request->ajax()){
       $vehicle=DB::table('vehicles')
         ->select(
            "vehicles.id",
             "vehicles.vin",
              "vehicles.lot_number",
                "vehicles.c_remark",
                 "vehicles.purchase_date",
                  "vehicles.year",
                  "vehicles.make",
                  "vehicles.model",
                  "vehicles.color",
                  "vehicles.file",
                  "vehicles.is_key",
                  "vehicles.carstate_id",
                  "vehicles.car_keys",
                  "vehicles.auction",
                  "vehicles.auction_city",
                  "vehicles.towingcompany",
                  "vehicles.rpgldate",
                  "vehicles.dpicd",
                  "vehicles.cdname",
                  "vehicles.pickup_due_date",
                  "vehicles.pickup_date",
                  "vehicles.number_days_pur",
                  "vehicles.number_days_rep",
                  "vehicles.htnumber",  
                  "vehicles.title_number",
                  "locations.location",
                  "carstates.type",
                  "companies.name as company_name"

            )
        ->join('locations','locations.id','=','vehicles.ploading')
        ->join('carstates','carstates.id','=','vehicles.carstate_id')
        ->join('companies','companies.id','=','vehicles.company_id')    
        ->where('carstates.id', 1);
        if($request['searchValue']!=''){
         $pagination=100;
        $vehicle->where(function($q) use($requestData, $searchQuery) {
                    foreach ($requestData as $field)
                       $q->orWhere($field, 'like', "%{$searchQuery}%");
            });
        }
        $vehicles=$vehicle->orderBy('vehicles.id','desc')->paginate($pagination);
        return view('admin.vehicle.on_theway_vehicles_data',compact('vehicles'))->render();
      }
    }
    public function paginate_on_theway_vehicle(Request $request)
    {
        $paginate=20;
        if($request['paginate']){
          $paginate= $request['paginate'];
        }
        if($request->ajax()){
       $vehicles=DB::table('vehicles')
         ->select(
            "vehicles.id",
             "vehicles.vin",
              "vehicles.lot_number",
                "vehicles.c_remark",
                 "vehicles.purchase_date",
                  "vehicles.year",
                  "vehicles.make",
                  "vehicles.model",
                  "vehicles.color",
                  "vehicles.file",
                  "vehicles.is_key",
                  "vehicles.carstate_id",
                  "vehicles.car_keys",
                  "vehicles.auction",
                  "vehicles.auction_city",
                  "vehicles.towingcompany",
                  "vehicles.rpgldate",
                  "vehicles.dpicd",
                  "vehicles.cdname",
                  "vehicles.pickup_due_date",
                  "vehicles.pickup_date",
                  "vehicles.number_days_pur",
                  "vehicles.number_days_rep",
                  "vehicles.htnumber",  
                  "vehicles.title_number",
                  "locations.location",
                  "carstates.type",
                  "companies.name as company_name"

            )
        ->join('locations','locations.id','=','vehicles.ploading')
        ->join('carstates','carstates.id','=','vehicles.carstate_id')
        ->join('companies','companies.id','=','vehicles.company_id')    
        ->where('carstates.id',1)
        ->orderBy('vehicles.id','desc')
        ->paginate($paginate); 
        return view('admin.vehicle.on_theway_vehicles_data',compact('vehicles','paginate'))->render();
      }
    }

    public function paginate_entry_on_theway_vehicle(Request $request)
    {
        $paginate=20;
        if($request['paginate']){
          $paginate= $request['paginate'];
        }
        if($request->ajax()){
       $vehicles=DB::table('vehicles')
         ->select(
            "vehicles.id",
             "vehicles.vin",
              "vehicles.lot_number",
                "vehicles.c_remark",
                 "vehicles.purchase_date",
                  "vehicles.year",
                  "vehicles.make",
                  "vehicles.model",
                  "vehicles.color",
                  "vehicles.file",
                  "vehicles.is_key",
                  "vehicles.carstate_id",
                  "vehicles.car_keys",
                  "vehicles.auction",
                  "vehicles.auction_city",
                  "vehicles.towingcompany",
                  "vehicles.rpgldate",
                  "vehicles.dpicd",
                  "vehicles.cdname",
                  "vehicles.pickup_due_date",
                  "vehicles.pickup_date",
                  "vehicles.number_days_pur",
                  "vehicles.number_days_rep",
                  "vehicles.htnumber",  
                  "vehicles.title_number",
                  "locations.location",
                  "carstates.type",
                  "companies.name as company_name"

            )
        ->join('locations','locations.id','=','vehicles.ploading')
        ->join('carstates','carstates.id','=','vehicles.carstate_id')
        ->join('companies','companies.id','=','vehicles.company_id')    
        ->where('carstates.id',1)
        ->orderBy('vehicles.id','desc')
        ->paginate($paginate); 
        return view('admin.vehicle.on_theway_vehicles_data',compact('vehicles','paginate'))->render();
      }
    }

    // pending vehicle section 
    public function pending_vehicles()
    {
         $vehicles=DB::table('tbl_bases')
         ->select("vehicles.*","tbl_bases.vehicle_id","tbl_bases.container_id","containers.container_number","containers.booking_number","containers.eta_port_discharge","containers.etd_port_loading","locations.location","carstates.type","companies.name as company_name")
        ->rightJoin('vehicles','vehicles.id','=','tbl_bases.vehicle_id')
        ->leftJoin('containers','containers.id','=','tbl_bases.container_id')
        ->join('locations','locations.id','=','vehicles.ploading')
        ->join('carstates','carstates.id','=','vehicles.carstate_id')
        ->join('companies','companies.id','=','vehicles.company_id')
        ->where('carstates.id',6)
        ->orderBy('vehicles.id','desc')
        ->paginate(20);
         return view('admin.vehicle.pending_vehicles',['vehicles'=>$vehicles,'paginate'=>20]);

    }
    public function search_pending_vehicle(Request $request)
    {
        $pagination=20;
        $searchQuery = trim($request['searchValue']);
        $requestData = ['vehicles.vin', 'vehicles.lot_number','vehicles.year','vehicles.make','vehicles.model', 'containers.container_number','locations.location'];
        if($request->ajax()){
       $vehicle=DB::table('tbl_bases')
         ->select("vehicles.*","tbl_bases.vehicle_id","tbl_bases.container_id","containers.container_number","containers.booking_number","containers.eta_port_discharge","containers.etd_port_loading","locations.location","carstates.type","companies.name as company_name")
        ->rightJoin('vehicles','vehicles.id','=','tbl_bases.vehicle_id')
        ->leftJoin('containers','containers.id','=','tbl_bases.container_id')
        ->join('locations','locations.id','=','vehicles.ploading')
        ->join('carstates','carstates.id','=','vehicles.carstate_id')
        ->join('companies','companies.id','=','vehicles.company_id')
        ->where('carstates.id', 6);
        if($request['searchValue']!=''){
         $pagination=100;
        $vehicle->where(function($q) use($requestData, $searchQuery) {
                    foreach ($requestData as $field)
                       $q->orWhere($field, 'like', "%{$searchQuery}%");
            });
        }

       $vehicles=$vehicle->orderBy('vehicles.id','desc')->paginate($pagination); 
        return view('admin.vehicle.pending_vehicles_data',compact('vehicles'))->render();
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
         ->select("vehicles.*","tbl_bases.vehicle_id","tbl_bases.container_id","containers.container_number","containers.booking_number","containers.eta_port_discharge","containers.etd_port_loading","locations.location","carstates.type","companies.name as company_name")
        ->rightJoin('vehicles','vehicles.id','=','tbl_bases.vehicle_id')
        ->leftJoin('containers','containers.id','=','tbl_bases.container_id')
        ->join('locations','locations.id','=','vehicles.ploading')
        ->join('carstates','carstates.id','=','vehicles.carstate_id')
        ->join('companies','companies.id','=','vehicles.company_id')
         ->where('carstates.id', 6)
        ->orderBy('vehicles.id','desc')
        ->paginate($paginate); 
        return view('admin.vehicle.pending_vehicles_data',compact('vehicles','paginate'))->render();
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
         ->select("vehicles.*","tbl_bases.vehicle_id","tbl_bases.container_id","containers.container_number","containers.booking_number","containers.eta_port_discharge","containers.etd_port_loading","locations.location","carstates.type","companies.name as company_name")
        ->rightJoin('vehicles','vehicles.id','=','tbl_bases.vehicle_id')
        ->leftJoin('containers','containers.id','=','tbl_bases.container_id')
        ->join('locations','locations.id','=','vehicles.ploading')
        ->join('carstates','carstates.id','=','vehicles.carstate_id')
        ->join('companies','companies.id','=','vehicles.company_id')
        ->where('carstates.id', 6)
        ->orderBy('vehicles.id','desc')
        ->paginate($paginate); 
        return view('admin.vehicle.pending_vehicles_data',compact('vehicles','paginate'))->render();
      }
    }

// On hand  no title  vehicle section 
    public function onhand_notitle_vehicles()
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
                  "vehicles.carstate_id",
                  "vehicles.car_keys",
                  "vehicles.radio",
                  "vehicles.customer_note",
                  "vehicles.htnumber",  
                  "vehicles.title_number",
                  "vehicles.title_state",
                  "vehicles.auction",
                  "vehicles.auction_city",
                  "locations.location",
                  "carstates.type",
                  "companies.name as company_name",
                  "carstates.type"
            )
         ->join('locations','locations.id','=','vehicles.ploading')
        ->join('carstates','carstates.id','=','vehicles.carstate_id')
        ->join('companies','companies.id','=','vehicles.company_id') 
        ->where('carstates.id',2)
        ->orderBy('vehicles.id','desc')
        ->paginate(20);
         return view('admin.vehicle.onhand_notitle_vehicles',['vehicles'=>$vehicles,'paginate'=>20]);

    }
    public function search_onhand_notitle_vehicle(Request $request)
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
                  "vehicles.carstate_id",
                  "vehicles.car_keys",
                  "vehicles.radio",
                  "vehicles.customer_note",
                  "vehicles.htnumber",  
                  "vehicles.title_number",
                  "vehicles.title_state",
                  "vehicles.auction",
                  "vehicles.auction_city",
                  "locations.location",
                  "carstates.type",
                  "companies.name as company_name",
                  "carstates.type"
            )
        ->join('locations','locations.id','=','vehicles.ploading')
        ->join('carstates','carstates.id','=','vehicles.carstate_id')
        ->join('companies','companies.id','=','vehicles.company_id') 
        ->where('carstates.id',2);
        if($searchQuery!=''){
         $pagination=100;
        $vehicle->where(function($q) use($requestData, $searchQuery) {
                foreach ($requestData as $field)
                 $q->orWhere($field, 'like', "%{$searchQuery}%");
          });
        }
       $vehicles=$vehicle->orderBy('vehicles.id','desc')->paginate($pagination);
        return view('admin.vehicle.onhand_notitle_vehicles_data',compact('vehicles'))->render();
      }
    }
    public function paginate_onhand_notitle_vehicle(Request $request)
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
                  "vehicles.carstate_id",
                  "vehicles.car_keys",
                  "vehicles.radio",
                  "vehicles.customer_note",
                  "vehicles.htnumber",  
                  "vehicles.title_number",
                  "vehicles.title_state",
                  "vehicles.auction",
                  "vehicles.auction_city",
                  "locations.location",
                  "carstates.type",
                  "companies.name as company_name",
                  "carstates.type"
            )
        ->join('locations','locations.id','=','vehicles.ploading')
        ->join('carstates','carstates.id','=','vehicles.carstate_id')
        ->join('companies','companies.id','=','vehicles.company_id') 
         ->where('carstates.id', 2)
        ->orderBy('vehicles.id','desc')
        ->paginate($paginate); 
        return view('admin.vehicle.onhand_notitle_vehicles_data',compact('vehicles','paginate'))->render();
      }
    }

    public function paginate_entry_onhand_notitle_vehicle(Request $request)
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
                  "vehicles.carstate_id",
                  "vehicles.car_keys",
                  "vehicles.radio",
                  "vehicles.customer_note",
                  "vehicles.htnumber",  
                  "vehicles.title_number",
                  "vehicles.title_state",
                  "vehicles.auction",
                  "vehicles.auction_city",
                  "locations.location",
                  "carstates.type",
                  "companies.name as company_name",
                  "carstates.type"
            )
         ->join('locations','locations.id','=','vehicles.ploading')
        ->join('carstates','carstates.id','=','vehicles.carstate_id')
        ->join('companies','companies.id','=','vehicles.company_id') 
        ->where('carstates.id', 2)
        ->orderBy('vehicles.id','desc')
        ->paginate($paginate); 
        return view('admin.vehicle.onhand_notitle_vehicles_data',compact('vehicles','paginate'))->render();
      }
    }

    // On hand  with title  vehicle section 
    public function onhand_withtitle_vehicles()
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
                  "vehicles.carstate_id",
                  "vehicles.car_keys",
                  "vehicles.radio",
                  "vehicles.customer_note",
                  "vehicles.htnumber",  
                  "vehicles.title_number",
                  "vehicles.title_state",
                  "vehicles.title_status",
                  "vehicles.auction",
                  "vehicles.auction_city",
                  "vehicles.weight",
                  "vehicles.vehicle_price",
                  "vehicles.shipas",
                  "locations.location",
                  "carstates.type",
                  "companies.name as company_name",
                  "carstates.type"
            )
         ->join('locations','locations.id','=','vehicles.ploading')
        ->join('carstates','carstates.id','=','vehicles.carstate_id')
        ->join('companies','companies.id','=','vehicles.company_id') 
        ->where('carstates.id',3)
        ->orderBy('vehicles.id','desc')
        ->paginate(20);
         return view('admin.vehicle.onhand_withtitle_vehicles',['vehicles'=>$vehicles,'paginate'=>20]);

    }
    public function search_onhand_withtitle_vehicle(Request $request)
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
                  "vehicles.carstate_id",
                  "vehicles.car_keys",
                  "vehicles.radio",
                  "vehicles.customer_note",
                  "vehicles.htnumber",  
                  "vehicles.title_number",
                  "vehicles.title_state",
                  "vehicles.title_status",
                  "vehicles.auction",
                  "vehicles.auction_city",
                  "vehicles.weight",
                  "vehicles.vehicle_price",
                  "vehicles.shipas",
                  "locations.location",
                  "carstates.type",
                  "companies.name as company_name",
                  "carstates.type"
            )
         ->join('locations','locations.id','=','vehicles.ploading')
        ->join('carstates','carstates.id','=','vehicles.carstate_id')
        ->join('companies','companies.id','=','vehicles.company_id') 
         ->where('carstates.id',3);
        if($request['searchValue']!=''){
         $pagination=100;
        $vehicle->where(function($q) use($requestData, $searchQuery) {
                    foreach ($requestData as $field)
                       $q->orWhere($field, 'like', "%{$searchQuery}%");
            });
        }

       $vehicles=$vehicle->orderBy('vehicles.id','desc')->paginate($pagination); 
        return view('admin.vehicle.onhand_withtitle_vehicles_data',compact('vehicles'))->render();
      }
    }
    public function paginate_onhand_withtitle_vehicle(Request $request)
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
                  "vehicles.carstate_id",
                  "vehicles.car_keys",
                  "vehicles.radio",
                  "vehicles.customer_note",
                  "vehicles.htnumber",  
                  "vehicles.title_number",
                  "vehicles.title_state",
                  "vehicles.title_status",
                  "vehicles.auction",
                  "vehicles.auction_city",
                  "vehicles.weight",
                  "vehicles.vehicle_price",
                  "vehicles.shipas",
                  "locations.location",
                  "carstates.type",
                  "companies.name as company_name",
                  "carstates.type"
            )
         ->join('locations','locations.id','=','vehicles.ploading')
        ->join('carstates','carstates.id','=','vehicles.carstate_id')
        ->join('companies','companies.id','=','vehicles.company_id') 
         ->where('carstates.id',3)
        ->orderBy('vehicles.id','desc')
        ->paginate($paginate); 
        return view('admin.vehicle.onhand_withtitle_vehicles_data',compact('vehicles','paginate'))->render();
      }
    }

    public function paginate_entry_onhand_withtitle_vehicle(Request $request)
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
                  "vehicles.carstate_id",
                  "vehicles.car_keys",
                  "vehicles.radio",
                  "vehicles.customer_note",
                  "vehicles.htnumber",  
                  "vehicles.title_number",
                  "vehicles.title_state",
                  "vehicles.title_status",
                  "vehicles.auction",
                  "vehicles.auction_city",
                  "vehicles.weight",
                  "vehicles.vehicle_price",
                  "vehicles.shipas",
                  "locations.location",
                  "carstates.type",
                  "companies.name as company_name",
                  "carstates.type"
            )
         ->join('locations','locations.id','=','vehicles.ploading')
        ->join('carstates','carstates.id','=','vehicles.carstate_id')
        ->join('companies','companies.id','=','vehicles.company_id') 
        ->where('carstates.id',3)
        ->orderBy('vehicles.id','desc')
        ->paginate($paginate); 
        return view('admin.vehicle.onhand_withtitle_vehicles_data',compact('vehicles','paginate'))->render();
      }
    }

        // shipped vehicle section 
    public function shipped_vehicles()
    {
         $vehicles=DB::table('tbl_bases')
         ->select("vehicles.id","vehicles.link","vehicles.year","vehicles.make","vehicles.model","vehicles.color","vehicles.vin","vehicles.deliver_date","vehicles.shipas","vehicles.is_key","vehicles.lot_number","vehicles.c_remark",
            "vehicles.dport",
            "tbl_bases.vehicle_id","tbl_bases.container_id","containers.container_number","containers.booking_number","containers.eta_port_discharge","containers.etd_port_loading","locations.location","carstates.type","companies.name as company_name")
        ->join('vehicles','vehicles.id','=','tbl_bases.vehicle_id')
        ->join('containers','containers.id','=','tbl_bases.container_id')
        ->join('locations','locations.id','=','vehicles.ploading')
        ->join('carstates','carstates.id','=','vehicles.carstate_id')
        ->join('companies','companies.id','=','vehicles.company_id')
        ->where('carstates.id',5)
        ->orderBy('vehicles.id','desc')
        ->paginate(20);
         return view('admin.vehicle.shipped_vehicles',['vehicles'=>$vehicles,'paginate'=>20]);

    }
    public function search_shipped_vehicle(Request $request)
    {
        $pagination=20;
        $searchQuery = trim($request['searchValue']);
        $requestData = ['vehicles.vin', 'vehicles.lot_number','vehicles.year','vehicles.make','vehicles.model', 'containers.container_number','locations.location'];
        if($request->ajax()){
       $vehicle=DB::table('tbl_bases')
         ->select("vehicles.id","vehicles.link","vehicles.year","vehicles.make","vehicles.model","vehicles.color","vehicles.vin","vehicles.deliver_date","vehicles.shipas","vehicles.is_key","vehicles.lot_number","vehicles.c_remark",
            "vehicles.dport",
            "tbl_bases.vehicle_id","tbl_bases.container_id","containers.container_number","containers.booking_number","containers.eta_port_discharge","containers.etd_port_loading","locations.location","carstates.type","companies.name as company_name")
        ->join('vehicles','vehicles.id','=','tbl_bases.vehicle_id')
        ->join('containers','containers.id','=','tbl_bases.container_id')
        ->join('locations','locations.id','=','vehicles.ploading')
        ->join('carstates','carstates.id','=','vehicles.carstate_id')
         ->join('companies','companies.id','=','vehicles.company_id')
        ->where('carstates.id',5);
        if($request['searchValue']!=''){
         $pagination=100;
        $vehicle->where(function($q) use($requestData, $searchQuery) {
                    foreach ($requestData as $field)
                       $q->orWhere($field, 'like', "%{$searchQuery}%");
            });
        }

       $vehicles=$vehicle->orderBy('vehicles.id','desc')->paginate($pagination); 
        return view('admin.vehicle.shipped_vehicles_data',compact('vehicles'))->render();
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
         ->select("vehicles.id","vehicles.link","vehicles.year","vehicles.make","vehicles.model","vehicles.color","vehicles.vin","vehicles.deliver_date","vehicles.shipas","vehicles.is_key","vehicles.lot_number","vehicles.c_remark",
            "vehicles.dport",
            "tbl_bases.vehicle_id","tbl_bases.container_id","containers.container_number","containers.booking_number","containers.eta_port_discharge","containers.etd_port_loading","locations.location","carstates.type","companies.name as company_name")
        ->join('vehicles','vehicles.id','=','tbl_bases.vehicle_id')
        ->join('containers','containers.id','=','tbl_bases.container_id')
        ->join('locations','locations.id','=','vehicles.ploading')
        ->join('carstates','carstates.id','=','vehicles.carstate_id')
         ->join('companies','companies.id','=','vehicles.company_id')
         ->where('carstates.id',5)
        ->orderBy('vehicles.id','desc')
        ->paginate($paginate); 
        return view('admin.vehicle.shipped_vehicles_data',compact('vehicles','paginate'))->render();
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
         ->select("vehicles.id","vehicles.link","vehicles.year","vehicles.make","vehicles.model","vehicles.color","vehicles.vin","vehicles.deliver_date","vehicles.shipas","vehicles.is_key","vehicles.lot_number","vehicles.c_remark",
            "vehicles.dport",
            "tbl_bases.vehicle_id","vehicles.is_key","tbl_bases.container_id","containers.container_number","containers.booking_number","containers.eta_port_discharge","containers.etd_port_loading","locations.location","carstates.type","companies.name as company_name")
        ->join('vehicles','vehicles.id','=','tbl_bases.vehicle_id')
        ->join('containers','containers.id','=','tbl_bases.container_id')
        ->join('locations','locations.id','=','vehicles.ploading')
        ->join('carstates','carstates.id','=','vehicles.carstate_id')
        ->join('companies','companies.id','=','vehicles.company_id')
        ->where('carstates.id',5)
        ->orderBy('vehicles.id','desc')
        ->paginate($paginate); 
        return view('admin.vehicle.shipped_vehicles_data',compact('vehicles','paginate'))->render();
      }
    }

     // vehicle dateline section 
    public function dateline_vehicles()
    {
         $vehicles=DB::table('tbl_bases')
         ->select("vehicles.id","vehicles.year","vehicles.make","vehicles.model","vehicles.color","vehicles.vin","vehicles.lot_number","vehicles.purchase_date","vehicles.rpgldate","vehicles.deliver_date","vehicles.payment_date","vehicles.towing_request_date","vehicles.dpicd","vehicles.pickup_date","vehicles.number_days_pur","vehicles.number_days_rep","vehicles.is_key",
            "tbl_bases.vehicle_id","tbl_bases.container_id","containers.container_number","containers.booking_number","containers.eta_port_discharge","containers.etd_port_loading","carstates.type","companies.name as company_name")
        ->join('vehicles','vehicles.id','=','tbl_bases.vehicle_id')
        ->join('containers','containers.id','=','tbl_bases.container_id')
        ->join('carstates','carstates.id','=','vehicles.carstate_id')
         ->join('companies','companies.id','=','vehicles.company_id')
        ->orderBy('vehicles.id','desc')
        ->take(100)
        ->paginate(20); 
         return view('admin.vehicle.vehicles_dateline',['vehicles'=>$vehicles,'paginate'=>20]);

    }
    public function search_dateline_vehicle(Request $request)
    {
        $pagination=20;
        $searchQuery = trim($request['searchValue']);
        $requestData = ['vehicles.vin', 'vehicles.lot_number','vehicles.year','vehicles.make','vehicles.model', 'containers.container_number','companies.name'];
        if($request->ajax()){
       $vehicle=DB::table('tbl_bases')
         ->select("vehicles.id","vehicles.year","vehicles.make","vehicles.model","vehicles.color","vehicles.vin","vehicles.lot_number","vehicles.purchase_date","vehicles.rpgldate","vehicles.deliver_date","vehicles.payment_date","vehicles.towing_request_date","vehicles.dpicd","vehicles.pickup_date","vehicles.number_days_pur","vehicles.number_days_rep","tbl_bases.vehicle_id","tbl_bases.container_id","containers.container_number","containers.booking_number","containers.eta_port_discharge","containers.etd_port_loading","carstates.type","companies.name as company_name")
        ->join('vehicles','vehicles.id','=','tbl_bases.vehicle_id')
        ->join('containers','containers.id','=','tbl_bases.container_id')
        ->join('carstates','carstates.id','=','vehicles.carstate_id')
         ->join('companies','companies.id','=','vehicles.company_id');
        if($request['searchValue']!=''){
         $pagination=100;
        $vehicle->where(function($q) use($requestData, $searchQuery) {
                    foreach ($requestData as $field)
                       $q->orWhere($field, 'like', "%{$searchQuery}%");
            });
        }

       $vehicles=$vehicle->orderBy('vehicles.id','desc')->paginate($pagination); 
        return view('admin.vehicle.vehicles_dateline_data',compact('vehicles'))->render();
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
         ->select("vehicles.id","vehicles.year","vehicles.make","vehicles.model","vehicles.color","vehicles.vin","vehicles.lot_number","vehicles.purchase_date","vehicles.rpgldate","vehicles.deliver_date","vehicles.payment_date","vehicles.towing_request_date","vehicles.dpicd","vehicles.pickup_date","vehicles.number_days_pur","vehicles.number_days_rep","tbl_bases.vehicle_id","tbl_bases.container_id","containers.container_number","containers.booking_number","containers.eta_port_discharge","containers.etd_port_loading","carstates.type","companies.name as company_name")
        ->join('vehicles','vehicles.id','=','tbl_bases.vehicle_id')
        ->join('containers','containers.id','=','tbl_bases.container_id')
        ->join('carstates','carstates.id','=','vehicles.carstate_id')
         ->join('companies','companies.id','=','vehicles.company_id')
        ->orderBy('vehicles.id','desc')
        ->paginate($paginate); 
        return view('admin.vehicle.vehicles_dateline_data',compact('vehicles','paginate'))->render();
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
         ->select("vehicles.id","vehicles.year","vehicles.make","vehicles.model","vehicles.color","vehicles.vin","vehicles.lot_number","vehicles.purchase_date","vehicles.rpgldate","vehicles.deliver_date","vehicles.payment_date","vehicles.towing_request_date","vehicles.dpicd","vehicles.pickup_date","vehicles.number_days_pur","vehicles.number_days_rep","tbl_bases.vehicle_id","tbl_bases.container_id","containers.container_number","containers.booking_number","containers.eta_port_discharge","containers.etd_port_loading","carstates.type","companies.name as company_name")
        ->join('vehicles','vehicles.id','=','tbl_bases.vehicle_id')
        ->join('containers','containers.id','=','tbl_bases.container_id')
        ->join('carstates','carstates.id','=','vehicles.carstate_id')
        ->join('companies','companies.id','=','vehicles.company_id')
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
         "tbl_bases.vehicle_id","tbl_bases.container_id","containers.container_number","containers.booking_number","containers.eta_port_discharge","containers.etd_port_loading","companies.name as company_name")
        ->join('vehicles','vehicles.id','=','tbl_bases.vehicle_id')
        ->join('containers','containers.id','=','tbl_bases.container_id')
        ->join('companies','companies.id','=','vehicles.company_id')
        // ->join('locations','locations.id','=','vehicles.ploading')
        // ->join('carstates','carstates.id','=','vehicles.carstate_id')
        ->orderBy('vehicles.id','desc')
        ->paginate(20);
         return view('admin.vehicle.vehicle_cost_analysis',['vehicles'=>$vehicles,'paginate'=>20]);

    }
    public function search_vehicle_cost_analysis(Request $request)
    {
        $pagination=20;
        $searchQuery = trim($request['searchValue']);
        $requestData = ['vehicles.vin','vehicles.year','vehicles.make','vehicles.model', 'containers.container_number','companies.name'];
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
         "tbl_bases.vehicle_id","tbl_bases.container_id","containers.container_number","containers.booking_number","containers.eta_port_discharge","containers.etd_port_loading","companies.name as company_name")
        ->join('vehicles','vehicles.id','=','tbl_bases.vehicle_id')
        ->join('containers','containers.id','=','tbl_bases.container_id')
        ->join('companies','companies.id','=','vehicles.company_id');
        if($request['searchValue']!=''){
         $pagination=20;
        $vehicle->where(function($q) use($requestData, $searchQuery) {
                    foreach ($requestData as $field)
                       $q->orWhere($field, 'like', "%{$searchQuery}%");
            });
        }
       $vehicles=$vehicle->orderBy('vehicles.id','desc')->paginate($pagination); 
        return view('admin.vehicle.vehicle_cost_analysis_data',compact('vehicles'))->render();
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
         "tbl_bases.vehicle_id","tbl_bases.container_id","containers.container_number","containers.booking_number","containers.eta_port_discharge","containers.etd_port_loading","companies.name as company_name")
        ->join('vehicles','vehicles.id','=','tbl_bases.vehicle_id')
        ->join('containers','containers.id','=','tbl_bases.container_id')
        ->join('companies','companies.id','=','vehicles.company_id')
        ->orderBy('vehicles.id','desc')
        ->paginate($paginate); 
        return view('admin.vehicle.vehicle_cost_analysis_data',compact('vehicles','paginate'))->render();
      }
    }

    // tow cost report 
    public function tow_cost_report()
    {
         $vehicles=DB::table('vehicles')
         ->select(
            "vehicles.id",
             "vehicles.vin",
              "vehicles.lot_number",
               "vehicles.towed_from",
                  "vehicles.deliver_date",
                  "vehicles.year",
                  "vehicles.make",
                  "vehicles.model",
                  "vehicles.color",
                  "vehicles.tow_amount",
                  "vehicles.tow_amounts",
                  "vehicles.carstate_id",
                  "vehicles.htnumber",  
                  "locations.location",
                  "companies.name"
            )
        ->join('locations','locations.id','=','vehicles.ploading')
        ->join('carstates','carstates.id','=','vehicles.carstate_id')
        ->join('companies','companies.id','=','vehicles.company_id')    
        ->orderBy('vehicles.id','desc')
        ->paginate(20);
         return view('admin.vehicle.tow_cost_report',['vehicles'=>$vehicles,'paginate'=>20]);

    }
    public function search_tow_cost_report(Request $request)
    {
        $pagination=20;
        $searchQuery = trim($request['searchValue']);
        $requestData = ['vehicles.vin', 'vehicles.towed_from','locations.location','companies.name'];
        if($request->ajax()){
       $vehicle=DB::table('vehicles')
         ->select(
            "vehicles.id",
             "vehicles.vin",
              "vehicles.lot_number",
               "vehicles.towed_from",
                  "vehicles.deliver_date",
                  "vehicles.year",
                  "vehicles.make",
                  "vehicles.model",
                  "vehicles.color",
                  "vehicles.tow_amount",
                  "vehicles.tow_amounts",
                  "vehicles.carstate_id",
                  "vehicles.htnumber",  
                  "locations.location",
                  "companies.name"
            )
        ->join('locations','locations.id','=','vehicles.ploading')
        ->join('carstates','carstates.id','=','vehicles.carstate_id')
        ->join('companies','companies.id','vehicles.company_id');
        if($searchQuery!=''){
         $pagination=100;
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
            "vehicles.id",
             "vehicles.vin",
              "vehicles.lot_number",
               "vehicles.towed_from",
                  "vehicles.deliver_date",
                  "vehicles.year",
                  "vehicles.make",
                  "vehicles.model",
                  "vehicles.color",
                  "vehicles.tow_amount",
                  "vehicles.tow_amounts",
                  "vehicles.carstate_id",
                  "vehicles.htnumber",  
                  "locations.location",
                  "companies.name",

            "tbl_bases.vehicle_id","tbl_bases.container_id","containers.container_number","containers.booking_number","containers.eta_port_discharge","containers.etd_port_loading","locations.location","carstates.type")
        ->rightJoin('vehicles','vehicles.id','=','tbl_bases.vehicle_id')
        ->leftJoin('containers','containers.id','=','tbl_bases.container_id')
        ->join('locations','locations.id','=','vehicles.ploading')
        ->join('carstates','carstates.id','=','vehicles.carstate_id')
        ->join('companies','companies.id','=','vehicles.company_id')
        ->where('containers.container_number','like','%'.$searchQuery.'%')
        ->orderBy('vehicles.id','desc')->paginate($pagination); 
       } 
        return view('admin.vehicle.tow_cost_report_data',compact('vehicles'))->render();
      }
    }
    public function paginate_tow_cost_report(Request $request)
    {
        $paginate=20;
        if($request['paginate']){
          $paginate= $request['paginate'];
        }
        if($request->ajax()){
       $vehicles=DB::table('vehicles')
         ->select(
            "vehicles.id",
             "vehicles.vin",
              "vehicles.lot_number",
               "vehicles.towed_from",
                  "vehicles.deliver_date",
                  "vehicles.year",
                  "vehicles.make",
                  "vehicles.model",
                  "vehicles.color",
                  "vehicles.tow_amount",
                  "vehicles.tow_amounts",
                  "vehicles.carstate_id",
                  "vehicles.htnumber",  
                  "locations.location",
                  "companies.name"
            )
        ->join('locations','locations.id','=','vehicles.ploading')
        ->join('carstates','carstates.id','=','vehicles.carstate_id')
        ->join('companies','companies.id','=','vehicles.company_id')
        ->orderBy('vehicles.id','desc')
        ->paginate($paginate); 
        return view('admin.vehicle.tow_cost_report_data',compact('vehicles','paginate'))->render();
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
        // ->where('vehicles.customer_id',Auth::id())
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
        ->where('locations.id',$request['location_id']);
        // ->where('vehicles.customer_id',Auth::id());
        if($status!='10'){
        $vehicle->where('carstates.id',$status);
       }
        if($searchQuery!=''){
         $pagination=100;
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
        // ->where('vehicles.customer_id',Auth::id())
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
       $vehicle = VehicleModel::find($id);
        return view('admin.vehicle.vehicle_condational_report', ['signle_vehicle' =>$vehicle]); 
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
        // ->where('vehicles.customer_id',Auth::id())
        ->orderBy('vehicles.id','desc')
        ->paginate(20);

          // return PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('customer.vehicle.all_vehicles',['vehicles'=>$vehicles],['format' => ['A4',190,236]])->stream();

        $pdf = PDF::loadView('customer.vehicle.vehicle_pdf',['vehicles'=>$vehicles],['format' => 'A4']);
        return $pdf->download('invoice.pdf');

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
            // ->where('vehicles.customer_id',Auth::id())
            ->orderBy('vehicles.id','desc')
            ->paginate(20);

              return Excel::download($vehicles, 'users.xlsx');

        }

     function vehicle_photo($id=''){
          $data=DB::table('vehicles')->where('id',$id)->first();
           $link=$data->link;
           return view('admin.vehicle.vehicle_photo')->with(['id'=> $id,'link'=>$link]);  
     }

     function delete_vehicle($id=''){
        if(!auth()->guard('admin')->user()->hasPermissions(['Admin','delete-vehicle']))
            return view('admin.error.403');

        $data=DB::table('vehicles')->where('id',$id)->delete();
        return redirect()->back()->with('deleted','success');
     }

     // vehicle summary section 
     public function vehicle_summary(Request $request)
     {  
          $location_id=1;
          $view='vehicle_summary';
          $locations= DB::table('locations')->get();

          if($request['status']){
            
            $customers = DB::table('customers')
             ->select('companies.*','customers.note')
             ->rightJoin('companies','companies.id','=','customers.company_id')
             ->groupBy('companies.id')
             ->get();
            return view('admin.vehicle.vehicle_summary_data')
            ->with(['customers' => $customers,'locations'=>$locations,'location'=>$location_id,'filter'=>'filter']);
        }

          if($request['location_id']){
            // dd($request['location']);
           $location_id=$request['location_id'];
           $view='vehicle_summary_data';

           if($location_id==8){
             $customers = DB::table('customers')
             ->select('companies.*','customers.note')
             ->rightJoin('companies','companies.id','=','customers.company_id')
             ->groupBy('companies.id')
             ->get();
            return view('admin.vehicle.vehicle_summary_data')
            ->with(['customers' => $customers,'locations'=>$locations,'location'=>0]);
           }
           else{
            $customers = DB::table('customers')
             ->select('companies.*','customers.note')
             ->rightJoin('companies','companies.id','=','customers.company_id')
             ->groupBy('companies.id')
             ->get();
            return view('admin.vehicle.vehicle_summary_data')
            ->with(['customers' => $customers,'locations'=>$locations,'location'=>$location_id]);
            }
        }
        else
        {
            $customers = DB::table('customers')
             ->select('companies.*','customers.note')
             ->rightJoin('companies','companies.id','=','customers.company_id')
             ->groupBy('companies.id')
             ->get();
            return view('admin.vehicle.'.$view)
            ->with(['customers' => $customers,'locations'=>$locations,'location'=>$location_id]);
        }

     }
     public function vehicle_summary_search($company_id='',$status='',$location_id='')
     {  
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
                  "vehicles.carstate_id",
                  "vehicles.car_keys",
                  "vehicles.radio",
                  "vehicles.customer_note",
                  "vehicles.htnumber",  
                  "vehicles.title_number",
                  "vehicles.title_state",
                  "locations.location",
                  "carstates.type",
                  "companies.name"

            )
        ->join('locations','locations.id','=','vehicles.ploading')
        ->join('carstates','carstates.id','=','vehicles.carstate_id')
        ->join('companies','companies.id','=','vehicles.company_id')    
        ->orderBy('vehicles.id','desc');
        if($status=='10' and $company_id=='0'){
            $vehicle->where(['vehicles.location_id'=>$location_id]);
        }
        else if($status=='0'){
         $vehicle->where(['vehicles.company_id'=>$company_id,'vehicles.location_id'=>$location_id]);
        }
        else if($status=='10'){
         $vehicle->where('vehicles.company_id', $company_id)->whereIn('vehicles.carstate_id',[1,2,3]);
        }
        else if($location_id=='8'){
           $vehicle->where(['vehicles.company_id'=>$company_id,'vehicles.carstate_id'=> $status]) ; 
        }
        else if($company_id=='0'){
            $vehicle->where(['vehicles.carstate_id'=> $status,'vehicles.location_id'=>$location_id]) ;
        }
        else{
            $vehicle->where(['vehicles.company_id'=>$company_id,'vehicles.carstate_id'=> $status,'vehicles.location_id'=>$location_id]) ; 
        }
        $vehicles=$vehicle->paginate(100);
         return view('admin.vehicle.vehicle_summary_search',['vehicles'=>$vehicles,'paginate'=>20]);

     }

     // adding vehicle 
     public function add_vehicle()
     {
        $customers =DB::table('customers')->get();
        $companies=DB::table('companies')->get();
        $locations=DB::table('locations')->get();
        return view('admin.vehicle.add_vehicle')->with(['companies'=>$companies,'customers'=>$customers,'locations'=>$locations]);
     }
     // inserting vehicle  
     public function add_new_vehicle(Request $request)
     {
        $result=DB::table('vehicles')->where('vin',$request['vin'])->exists();
        if($result){
             return redirect()->back()->with('success', 'The vin number : '.$request['vin'].' already exists! ');
        }
        else {  
            $this->validate($request, ['ploading' => 'required']);
            $add_vehicle = new VehicleModel();
            $add_vehicle->customer_id = $request['customer'];
            $add_vehicle->location_id = $request['ploading'];
            $add_vehicle->auction = $request['auc'];
            $add_vehicle->auction_city = $request['aucity'];
            $add_vehicle->year = $request['year'];
            $add_vehicle->company_id = $request['company'];
            $add_vehicle->cdname = $request['cdname'];
            $add_vehicle->veh_descr = $request['desco'];
            $add_vehicle->payment_date = $request['payment_date'];
            $add_vehicle->shipas = $request['shipas'];
            $add_vehicle->ploading = $request['ploading'];
            $add_vehicle->inform = $request['inform'];
            $add_vehicle->dport = $request['dport'];
            $add_vehicle->buyer_number = $request['buyer_number'];
            $add_vehicle->file=$request['auction_invoice'];
             // if (!empty($request->hasFile('file'))) {
             //     if ($request->hasFile('file')) {
             //         $photo = $request->file('file');
             //         $imagename = time() . '.' . $photo->getClientOriginalExtension();
             //         $destinationPath = public_path('images/file/');
             //         $photo->move($destinationPath, $imagename);
             //         $data['file'] = $imagename;
             //     }
             //     $add_vehicle->file = $imagename;
             // } else {
             //     $add_vehicle->file = 'nothing uploaded';
             // }
            $add_vehicle->link = $request['photo-link'];
            $add_vehicle->title_received_date = $request['trdate'];
            $add_vehicle->title_number = $request['tnumber'];
            $add_vehicle->title_state = $request['tstate'];
            $add_vehicle->purchase_date = $request['purdate'];
            $add_vehicle->rpgldate = $request['rpgldate'];
            $add_vehicle->reported = $request['reported'];
            $add_vehicle->towing_request_date = $request['towingrdate'];
            $add_vehicle->pickup_date = $request['pdate'];
            $add_vehicle->deliver_date = $request['ddate'];
            $add_vehicle->color = $request['color'];
            $add_vehicle->note = $request['note'];
            $add_vehicle->vprice = $request['vprice'];
            $add_vehicle->towed = $request['towed'];
            $add_vehicle->towedby = $request['towedby'];
            $add_vehicle->dpicd = $request['dpicd'];
            $add_vehicle->title = $request['title'];
            //$add_vehicle->age=$request['age'];
            $add_vehicle->model = $request['model'];
            $add_vehicle->vin = $request['vin'];
            $add_vehicle->vehicle_price = $request['vehicle_price'];
            $add_vehicle->auction_fee = $request['auction_fee'];
            $add_vehicle->tow_amounts = $request['tow_amounts'];
            $add_vehicle->dismantal_cost = $request['dcost'];
            $add_vehicle->ship_cost = $request['shipcost'];
            $add_vehicle->auction_storage_cost = $request['astoragecost'];
            $add_vehicle->pgl_storage_costs = $request['pglscost'];
            $add_vehicle->us_custom_cost = $request['uscost'];
            $add_vehicle->us_demurage = $request['usd'];
            $add_vehicle->dubai_custom_cost = $request['dcustomcost'];
            $add_vehicle->dubai_storage_cost = $request['dstoragecost'];
            $add_vehicle->dubai_demurage = $request['ddcost'];
            $add_vehicle->other_cost = $request['othercost'];
            if (!empty($request['totalcost'])) {
                $add_vehicle->total_cost = $request['totalcost'];
            } else {
                $add_vehicle->total_cost = 0;
            }
            $add_vehicle->sales_cost = $request['salescost'];
            $add_vehicle->profit = $request['profit'];
            $add_vehicle->percent_profit = $request['percent'];
            $add_vehicle->number_days_rep = $request['number_days_rep'];
            $add_vehicle->number_days_pur = $request['number_days_pur'];
            $add_vehicle->weight = $request['weight'];
            $add_vehicle->towingcompany = $request['towingcompany'];
            $add_vehicle->pgl_storage_cost = $request['pgl_storage_cost'];
            $add_vehicle->value = $request['value'];
            $add_vehicle->licence_number = $request['license'];
            $add_vehicle->storage_amount = $request['stamount'];
            $add_vehicle->htnumber = $request['htnumber'];
            $add_vehicle->make = $request['make'];
            $add_vehicle->check_number = $request['chnumber'];
            $add_vehicle->add_charges = $request['acharges'];
            $add_vehicle->lot_number = $request['lotn'];
            $add_vehicle->towed_from = $request['towedf'];
            $add_vehicle->tow_amount = $request['towamount'];
            $add_vehicle->car_keys = $request['Keys'];
            $add_vehicle->radio = $request['radio'];
            $add_vehicle->casette = $request['casette'];
            $add_vehicle->cd_player = $request['cdp'];
            $add_vehicle->cd_charger = $request['cdch'];
            $add_vehicle->floor_mat = $request['fmt'];
            $add_vehicle->gps = $request['gns'];
            $add_vehicle->mirror = $request['mirror'];
            $add_vehicle->spare_tire = $request['stj'];
            $add_vehicle->speaker = $request['speaker'];
            $add_vehicle->wheel_covers = $request['wc'];
            $add_vehicle->other = $request['other'];
            $add_vehicle->txt1 = $request['txt1'];
            $add_vehicle->txt2 = $request['txt2'];
            $add_vehicle->txt3 = $request['txt3'];
            $add_vehicle->txt4 = $request['txt4'];
            $add_vehicle->txt5 = $request['txt5'];
            $add_vehicle->txt6 = $request['txt6'];
            $add_vehicle->txt7 = $request['txt7'];
            $add_vehicle->txt8 = $request['txt8'];
            $add_vehicle->txt9 = $request['txt9'];
            $add_vehicle->txt10 = $request['txt10'];
            $add_vehicle->txt11 = $request['txt11'];
            $add_vehicle->txt12 = $request['txt12'];
            $add_vehicle->txt13 = $request['txt13'];
            $add_vehicle->txt14 = $request['txt14'];
            $add_vehicle->txt15 = $request['txt15'];
            $add_vehicle->txt16 = $request['txt16'];
            $add_vehicle->txt17 = $request['txt17'];
            $add_vehicle->txt18 = $request['txt18'];
            $add_vehicle->txt19 = $request['txt19'];
            $add_vehicle->txt20 = $request['txt20'];
            $add_vehicle->txt21 = $request['txt21'];
            $add_vehicle->pickup_due_date = $request['pickup_due_date'];
             $add_vehicle->invoice_description = $request['invoice_description'];
            $add_vehicle->user_id = Auth::guard('admin')->id();
            $add_vehicle->save();
            $data = $request->all();
            Mail::send('emails.first', $data, function ($message)  {
             $message->from('info@peacegl.com', 'Peace Global Logistics');
             $message->to(Input::get('email'))->subject('STATUS -  ' . Input::get('year') . Input::get('make') . Input::get('model') . Input::get('color') . ' With  VIN#  ' . Input::get('vin') . '  ON THEY WAY To PGL');
            });
            return redirect()->route('all_vehicle_admin')->with('success', 'saved!');
        }
     }
     // show vehicle for update
     public function edit_vehicle($id='')
     {
        if(!auth()->guard('admin')->user()->hasPermissions(['Admin','edit-vehicle']))
            return view('admin.error.403');

        $vehicle=VehicleModel::find($id);
        $customers =DB::table('customers')->get();
        $companies=DB::table('companies')->get();
        $locations=DB::table('locations')->get();
        return view('admin.vehicle.edit_vehicle')->with(['vehicle'=>$vehicle,'companies'=>$companies,'customers'=>$customers,'locations'=>$locations]);
     }

     public function update_vehicle(Request $request)
    {
        $update_vehicles = VehicleModel::find($request['id']);
        $update_vehicles->customer_id = $request['customer'];
        $update_vehicles->location_id = $request['ploading'];
        $update_vehicles->auction = $request['auc'];
        $update_vehicles->auction_city = $request['aucity'];
        $update_vehicles->cdname = $request['cdname'];
        $update_vehicles->year = $request['year'];
        $update_vehicles->company_id = $request['company'];
        $update_vehicles->veh_descr = $request['desco'];
        $update_vehicles->payment_date = $request['payment_date'];
        $update_vehicles->shipas = $request['shipas'];
        $update_vehicles->ploading = $request['ploading'];
        $update_vehicles->dport = $request['dport'];
        $update_vehicles->buyer_number = $request['buyer_number'];
        $update_vehicles->file=$request['auction_invoice'];
         // if (!empty($request->hasFile('file'))) {
         //     if ($request->hasFile('file')) {
         //         $photo = $request->file('file');
         //         $imagename = time() . '.' . $photo->getClientOriginalExtension();
         //         $destinationPath = public_path('images/file/');
         //         $photo->move($destinationPath, $imagename);
         //         $data['file'] = $imagename;
         //     }
         //     $update_vehicles->file = $imagename;
         // } else {
         //     $update_vehicles->file = $request['fname'];
         // }
        $update_vehicles->link = $request['photo-link'];
        $update_vehicles->inform = $request['inform'];
        $update_vehicles->title_received_date = $request['trdate'];
        $update_vehicles->title_number = $request['tnumber'];
        $update_vehicles->title_state = $request['tstate'];
        $update_vehicles->purchase_date = $request['purdate'];
        $update_vehicles->rpgldate = $request['rpgldate'];
        $update_vehicles->reported = $request['reported'];
        $update_vehicles->towing_request_date = $request['towingrdate'];
        $update_vehicles->pickup_date = $request['pdate'];
        $update_vehicles->deliver_date = $request['ddate'];
        $update_vehicles->color = $request['color'];
        $update_vehicles->note = $request['note'];
        $update_vehicles->vprice = $request['vprice'];
        $update_vehicles->towed = $request['towed'];
        $update_vehicles->towedby = $request['towedby'];
        $update_vehicles->dpicd = $request['dpicd'];
        $update_vehicles->title = $request['title'];
        //$update_vehicles->age=$request['age'];
        $update_vehicles->model = $request['Model'];
        $update_vehicles->vin = $request['vin'];
        $update_vehicles->vehicle_price = $request['vehicle_price'];
        $update_vehicles->auction_fee = $request['auction_fee'];
        $update_vehicles->tow_amounts = $request['tow_amounts'];
        $update_vehicles->dismantal_cost = $request['dcost'];
        $update_vehicles->ship_cost = $request['shipcost'];
        $update_vehicles->auction_storage_cost = $request['astoragecost'];
        $update_vehicles->pgl_storage_costs = $request['pglscost'];
        $update_vehicles->us_custom_cost = $request['uscost'];
        $update_vehicles->us_demurage = $request['usd'];
        $update_vehicles->dubai_custom_cost = $request['dcustomcost'];
        $update_vehicles->dubai_storage_cost = $request['dstoragecost'];
        $update_vehicles->dubai_demurage = $request['ddcost'];
        $update_vehicles->other_cost = $request['othercost'];
        if (!empty($request['totalcost'])) {
            $update_vehicles->total_cost = $request['totalcost'];
        } else {
            $update_vehicles->total_cost = 0;
        }
        $update_vehicles->sales_cost = $request['salescost'];
        $update_vehicles->profit = $request['profit'];
        $update_vehicles->percent_profit = $request['percent'];
        $update_vehicles->number_days_rep = $request['number_days_rep'];
        $update_vehicles->number_days_pur = $request['number_days_pur'];
        $update_vehicles->weight = $request['weight'];
        $update_vehicles->towingcompany = $request['towingcompany'];
        $update_vehicles->pgl_storage_cost = $request['pgl_storage_cost'];
        $update_vehicles->value = $request['value'];
        $update_vehicles->licence_number = $request['license'];
        $update_vehicles->storage_amount = $request['stamount'];
        $update_vehicles->htnumber = $request['htnumber'];
        $update_vehicles->make = $request['make'];
        $update_vehicles->check_number = $request['chnumber'];
        $update_vehicles->add_charges = $request['acharges'];
        $update_vehicles->lot_number = $request['lotn'];
        $update_vehicles->towed_from = $request['towedf'];
        $update_vehicles->tow_amount = $request['towamount'];
        $update_vehicles->car_keys = $request['Keys'];
        $update_vehicles->radio = $request['radio'];
        $update_vehicles->casette = $request['casette'];
        $update_vehicles->cd_player = $request['cdp'];
        $update_vehicles->cd_charger = $request['cdch'];
        $update_vehicles->floor_mat = $request['fmt'];
        $update_vehicles->gps = $request['gns'];
        $update_vehicles->mirror = $request['mirror'];
        $update_vehicles->spare_tire = $request['stj'];
        $update_vehicles->speaker = $request['speaker'];
        $update_vehicles->wheel_covers = $request['wc'];
        $update_vehicles->other = $request['other'];
        $update_vehicles->txt1 = $request['txt1'];
        $update_vehicles->txt2 = $request['txt2'];
        $update_vehicles->txt3 = $request['txt3'];
        $update_vehicles->txt4 = $request['txt4'];
        $update_vehicles->txt5 = $request['txt5'];
        $update_vehicles->txt6 = $request['txt6'];
        $update_vehicles->txt7 = $request['txt7'];
        $update_vehicles->txt8 = $request['txt8'];
        $update_vehicles->txt9 = $request['txt9'];
        $update_vehicles->txt10 = $request['txt10'];
        $update_vehicles->txt11 = $request['txt11'];
        $update_vehicles->txt12 = $request['txt12'];
        $update_vehicles->txt13 = $request['txt13'];
        $update_vehicles->txt14 = $request['txt14'];
        $update_vehicles->txt15 = $request['txt15'];
        $update_vehicles->txt16 = $request['txt16'];
        $update_vehicles->txt17 = $request['txt17'];
        $update_vehicles->txt18 = $request['txt18'];
        $update_vehicles->txt19 = $request['txt19'];
        $update_vehicles->txt20 = $request['txt20'];
        $update_vehicles->txt21 = $request['txt21'];
        $update_vehicles->pickup_due_date = $request['pickup_due_date'];
        $update_vehicles->invoice_description = $request['invoice_description'];
        $update_vehicles->user_id = Auth::guard('admin')->id();
        $update_vehicles->update();
        $product = DB::table('vehicles')->where('id', $request['id'])->first();
        if (!empty($request->photos)) {
            foreach ($request->photos as $photo) {
                $imagename = strtotime("now") .rand(1,100).$photo->getClientOriginalName().'.' . $photo->getClientOriginalExtension();
                $destinationPath = public_path('images/vehicle/');
                $photo->move($destinationPath, $imagename);
                $data['photo'] = $imagename;
                DB::table('vehicle_images')->insert([
                    'vehicle_id' => $product->id,
                    'photo' => $imagename
                ]);
            }
        }
        if (!empty($request->container)) {
            DB::table('tbl_bases')->insert([
               'vehicle_id' => $product->id,
               'container_id' => $request->container,
               'user_id' => Auth::guard('admin')->id()
           ]);

        }
        return redirect()->route('all_vehicle_admin')->with('success', 'saved!');
    }

    // find a customer vin to check if vin exist or no
   public function singel_vehicle_vin(Request $request)
    {
      $vin=DB::table('vehicles')->where('vin',$request['vin'])->exists();
        if($vin) echo true;
        else echo false;
    }

    public function change_status_vehicle(Request $request)
    {
        if(!auth()->guard('admin')->user()->hasPermissions(['Admin','add-status']))
            return view('admin.error.403');

        $id=explode(",",$request->ids);
        $veh_status='ON HAND NO TITLE';
        $is_reserve='0';
        if($request->status=='3'){
           $veh_status="ON HAND WITH TITLE"; 
           $is_reserve='1';
        }
        else if($request->status=='6'){
            $veh_status="Pending";
        }
        
        $update_vehicle_status= VehicleModel::find($id);
            if($request->status=='3'){
                if($update_vehicle_status[0]['title_number']==''){
                  return response()->json(['status'=>false,'message'=>'No title number !']);  
                }
            }
            DB::table('vehicles')->where('id',$id)->update(['carstate_id'=>$request->status,'is_reserve'=>$is_reserve]);
            $location = DB::table('locations')->where('id', $update_vehicle_status[0]['location_id'])->first();
            $comp = DB::table('companies')->where('id',$update_vehicle_status[0]['company_id'])->first();
            $custom = DB::table('customers')->where('id', $update_vehicle_status[0]['customer_id'])->first();
           $data1 = ['veh_status'=>$veh_status, 'email' => $custom->email, 'poc' => $custom->customer_name, 'vin' => $update_vehicle_status[0]['vin'], 'desc' => $update_vehicle_status[0]['make'] . $update_vehicle_status[0]['model'] . $update_vehicle_status[0]['year'] . $update_vehicle_status[0]['color'], 'company' => $comp->name, 'terminal' => $location->location, 'key' => $update_vehicle_status[0]['key'], 'title' => $update_vehicle_status[0]['title']];
            Mail::send('admin.emails.info_email', ['data2' => $data1], function ($message) use ($data1) {
                $message->from('info@peacegl.com', 'Peace Global Logistics');
                $message->to($data1["email"])->subject('STATUS - ' . $data1["desc"] . ' With VIN#' . $data1["vin"] . ' is ' . $data1['veh_status'] . '  At PGL');

            });

        return response()->json(['status'=>true,'message'=>'Status changed Successfully !']);
    }

    // change the status of on hand with title vehicles 
    public function change_on_hand_with_title_vehicle_status(Request $request)
    {
        if(!auth()->guard('admin')->user()->hasPermissions(['Admin','add-status']))
            return view('admin.error.403');
        $arrId=explode(",",$request->veh_id);
        $id= $arrId[0];
        if($id==''){
             return response()->json(['status'=>false,'message'=>'Status Not changed !']);
        }
        $update_vehicle = VehicleModel::find($id);
        $update_vehicle->carstate_id = $request['status'];
        $update_vehicle->update();

        $tbl_base_update = tbl_base::where('vehicle_id', $id)->first();
        if (!empty($tbl_base_update)) {
            $tbl_base_update->delete();
        }
       return response()->json(['status'=>true,'message'=>'Status changed Successfully !']);
    }


    // add vehicle to container 
    public function add_to_container(Request $request)
    {
        if(!auth()->guard('admin')->user()->hasPermissions(['Admin','add-to-container']))
            return view('admin.error.403');

        $data = $request->all();
        $id=$request['id'];
        $rcontainer=DB::table('containers')->where('id',$data['container'])->first();
        if (!empty($id)) {
            $data_check = DB::table('tbl_bases')->where('vehicle_id', $id)->first();
            if ($data_check) {
                return redirect()->back()->with('error','Already added to container');
            } else {
                $customergullkhan=VehicleModel::where('id',$id)->first();
                $add_to_cont_cars = new tbl_base();
                $add_to_cont_cars->container_id = $request->get('container');
                $add_to_cont_cars->vehicle_id = $id;
                $add_to_cont_cars->user_id = Auth::guard('admin')->id();
                $add_to_cont_cars->customer_id=$customergullkhan->customer_id;
                $add_to_cont_cars->save();
                
                $update_status_vehicle = VehicleModel::find($id);
                $update_status_vehicle->carstate_id = '5';
                $update_status_vehicle->cont_id = '';
                $update_status_vehicle->save();
                $location = DB::table('locations')->where('id', $update_status_vehicle->location_id)->first();
                $comp = DB::table('companies')->where('id', $update_status_vehicle->company_id)->first();
                $custom = CustomerModel::where('id', $update_status_vehicle->customer_id)->first();
                $cont_number = DB::table("tbl_bases")->join('containers', 'tbl_bases.container_id', 'containers.id')->rightJoin('vehicles', 'tbl_bases.vehicle_id', 'vehicles.id')->where('tbl_bases.vehicle_id', $update_status_vehicle->id)->first();
                
                $data1 = ['email' => $custom->email, 'poc' => @$custom->customer_name, 'vin' => $update_status_vehicle->vin, 'desc' => $update_status_vehicle->make . $update_status_vehicle->model . $update_status_vehicle->year . $update_status_vehicle->color, 'company' => @$comp->name, 'terminal' => $location->location, 'key' => $update_status_vehicle->key, 'title' => $update_status_vehicle->title, 'booking_number' => $cont_number->booking_number, 'dest' => $cont_number->port_discharge, 'cont_id' => $cont_number->container_id,'status'=>$request['status']];
                Mail::send('admin.emails.add_to_container', ['data2' => $data1], function ($message) use ($data1) {
                    $message->from('info@peacegl.com', 'Peace Global Logistics');
                    $message->to($data1["email"])->subject('STATUS - ' . $data1["desc"] . ' With VIN#' . $data1["vin"] . ' is ' . $data1['status'] . '  To ' . $data1['dest']);
                });

                return redirect()->back()->with('success','Successfully added to container');
            }
        }
         return redirect()->back()->with('error','Please select a vehicle !');

    }



}
