<?php

namespace App\Http\Controllers;

use App\ShipmentModel;
use Illuminate\Http\Request;
use DB;
use PDF;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ShipmentControllerCustomer extends Controller
{
    protected $shipment;
    public function __construct(ShipmentModel $shipment)
    {
        $this->middleware('auth');
        $this->shipment=$shipment;

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function view_shipment($status='')
    {
        if($status==5){
            $status=array();
            $sta=5;
        }
         elseif($status==0){
            $status=[0,3];
            $sta=0;
        }
        elseif($status==1){
            $status=[1,4,5];
            $sta=1;
        }
        elseif($status==2){
            $status=[2];
            $sta=2;
        }
        $shipment = DB::table('containers')
           ->select("containers.*","tbl_bases.container_id","containers.id as cid")
           ->leftJoin('tbl_bases','tbl_bases.container_id','=','containers.id')
           ->where('customer_id',Auth::id());
           if(!empty($status)){
           $shipment->whereIn('containers.status',$status);
            }
           $shipment->groupBy('cid')
           ->orderBy('containers.id','desc');
          $shipments=$shipment->paginate(20);
           return view('customer.shipment.all_shipment',['shipments'=>$shipments,'paginate'=>20,'status'=>$sta]);
           
    }

    public function search_all_shipment(Request $request)
    {
       $pagination=20;
       $status = $request['status'];
       if($status==5){
            $status=array();
            $sta=5;
        }
         elseif($status==0){
            $status=[0,3];
            $sta=0;
        }
        elseif($status==1){
            $status=[1,4,5];
            $sta=1;
        }
        elseif($status==2){
            $status=[2];
            $sta=2;
        }
        $searchQuery = trim($request['searchValue']);
        $requestData = ['containers.booking_number','containers.container_number','containers.port_loading'];
        if($request->ajax()){
        $shipment = DB::table('containers')->select("containers.*","tbl_bases.container_id","containers.id as cid")
           ->leftJoin('tbl_bases','tbl_bases.container_id','=','containers.id')
           ->where('customer_id',Auth::id());
           if($searchQuery!=''){
             $pagination=100;
            $shipment->where(function($q) use($requestData, $searchQuery) {
                    foreach ($requestData as $field)
                     $q->orWhere($field, 'like', "%{$searchQuery}%");
                });
            }
           if(!empty($status)){
           $shipment->whereIn('containers.status',$status);
            }
           $shipment->groupBy('cid')
           ->orderBy('containers.id','desc');
          $shipments=$shipment->paginate($pagination);
           return view('customer.shipment.all_shipment_data',['shipments'=>$shipments,'paginate'=>20,'status'=>$sta]);
        } 
    }

    public function paginate_all_shipment(Request $request)
    {
        $pagination=20;
        $status='';
        if($request['paginate']){
          $pagination= $request['paginate'];
        }
        if($request['status']){
          $status= $request['status'];
        }
        if($status==5){
            $status=array();
            $sta=5;
        }
         elseif($status==0){
            $status=[0,3];
            $sta=0;
        }
        elseif($status==1){
            $status=[1,4,5];
            $sta=1;
        }
        elseif($status==2){
            $status=[2];
            $sta=2;
        }
         if($request->ajax()){
             $shipment = DB::table('containers')->select("containers.*","tbl_bases.container_id","containers.id as cid")
               ->leftJoin('tbl_bases','tbl_bases.container_id','=','containers.id')
               ->where('customer_id',Auth::id());
               if(!empty($status)){
               $shipment->whereIn('containers.status',$status);
                }
               $shipment->groupBy('cid')
               ->orderBy('containers.id','desc');
              $shipments=$shipment->paginate($pagination);
               return view('customer.shipment.all_shipment_data',['shipments'=>$shipments,'paginate'=>20,'status'=>$sta]);
        } 
    }

    // shipment base on location and status 
    public function shipment_base_location_and_status($location='',$status='')
    {

        if($status==3){
            $status=[0,1,2];
            $sta=3;
        }
         elseif($status==0){
            $status=[0,3];
            $sta=0;
        }
        elseif($status==1){
            $status=[1,4,5];
            $sta=1;
        }
        elseif($status==2){
            $status=[2];
            $sta=2;
        }
        if($location=='Savannah, GA'){
            $location='Savannah';
        }
        $shipment = DB::table('containers')
           ->select("containers.*","tbl_bases.container_id","containers.id as cid")
           ->leftJoin('tbl_bases','tbl_bases.container_id','=','containers.id')
           ->where('containers.port_loading','like','%'.trim($location).'%')
           ->where('customer_id',Auth::id());
           if(!empty($status)){
           $shipment->whereIn('containers.status',$status);
            }
           $shipment->groupBy('cid')
           ->orderBy('containers.id','desc');
          $shipments=$shipment->paginate(20);
           return view('customer.shipment.search_shipment',['shipments'=>$shipments,'paginate'=>20,'status'=>$sta,'location'=>$location]);
    }

    public function shipment_base_location_and_status_search(Request $request)
    {
        $pagination=20;
        $status = $request['status'];
        if($status==3){
            $status=[0,1,2];
            $sta=3;
        }
         elseif($status==0){
            $status=[0,3];
            $sta=0;
        }
        elseif($status==1){
            $status=[1,4,5];
            $sta=1;
        }
        elseif($status==2){
            $status=[2];
            $sta=2;
        }
        $location=$request['location'];
        if($location=='Savannah, GA'){
            $location='Savannah';
        }
        $searchQuery = trim($request['searchValue']);
        $requestData = ['containers.booking_number','containers.container_number','containers.port_loading'];
        if($request->ajax()){
        $shipment = DB::table('containers')->select("containers.*","tbl_bases.container_id","containers.id as cid")
           ->leftJoin('tbl_bases','tbl_bases.container_id','=','containers.id')
           ->where('containers.port_loading','like','%'.trim($location).'%')
           ->where('customer_id',Auth::id());
           if($searchQuery!=''){
             $pagination=20000;
            $shipment->where(function($q) use($requestData, $searchQuery) {
                    foreach ($requestData as $field)
                     $q->orWhere($field, 'like', "%{$searchQuery}%");
                });
            }
            if(!empty($status)){
           $shipment->whereIn('containers.status',$status);
            }
           $shipment->groupBy('cid')
           ->orderBy('containers.id','desc');
          $shipments=$shipment->paginate($pagination);
           return view('customer.shipment.all_shipment_data',['shipments'=>$shipments,'paginate'=>20,'status'=>$status,'location'=>$location]);
        } 
    }

    public function paginate_shipment_base_location_and_status(Request $request)
    {
        $pagination=20;
        $status='';
        if($request['paginate']){
          $pagination= $request['paginate'];
        }
        if($request['status']){
          $status= $request['status'];
        }
        if($status==3){
            $status=[0,1,2];
            $sta=3;
        }
         elseif($status==0){
            $status=[0,3];
            $sta=0;
        }
        elseif($status==1){
            $status=[1,4,5];
            $sta=1;
        }
        elseif($status==2){
            $status=[2];
            $sta=2;
        }
        $location=$request['location'];
        if($location=='Savannah, GA'){
            $location='Savannah';
        }
         if($request->ajax()){
             $shipment = DB::table('containers')->select("containers.*","tbl_bases.container_id","containers.id as cid")
               ->leftJoin('tbl_bases','tbl_bases.container_id','=','containers.id')
               ->where('containers.port_loading','like','%'.trim($location).'%')
               ->where('customer_id',Auth::id());
               if(!empty($status)){
               $shipment->whereIn('containers.status',$status);
                }
               $shipment->groupBy('cid')
               ->orderBy('containers.id','desc');
              $shipments=$shipment->paginate($pagination);
               return view('customer.shipment.all_shipment_data',['shipments'=>$shipments,'paginate'=>20,'status'=>$status]);
        } 
    }
    // bol for customer 
    public function bol($id='')
    {
        $container = $this->shipment::find($id);
        return view('customer.shipment.bol', ['conti' => $container]);
    }

    public function bol_pdf($id='')
    {
        $container = $this->shipment::find($id);
        // return PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('customer.shipment.bol_pdf', ['conti' => $container],['format' =>'A4'])->stream();

        $pdf = PDF::loadView('customer.shipment.bol_pdf', ['conti' => $container],['format' =>['A4',190,236]]);
        return $pdf->download('BOL.pdf');
        
    }

    // dock recepit for customer 
    public function dock_recepit($id='')
    {
        $container = $this->shipment::find($id);
        return view('customer.shipment.dock_recepit', ['conti' => $container]);
    }







}
