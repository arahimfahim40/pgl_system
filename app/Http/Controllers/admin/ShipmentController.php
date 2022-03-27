<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ShipmentModel;
use DB;
use PDF;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ShipmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');  
    }

    public function shipment($status='',$locations='',Request $request)
    {
        if(!auth()->guard('admin')->user()->hasPermissions(['Admin','shipment-management']))
            return view('admin.error.403');
        $paginate=500;
        if($request['paginate']){
          $paginate= $request['paginate'];
        }
        if($status==10 or $status==2){
            $paginate=20;
        }
        if($status==1){
           $paginate=200; 
        }
        $sta=$status;
        $location=$locations;
        if($status==10){
            $status=array();
            $sta=10;
        }
         elseif($status==9){
            $status=[0,3,4,5];
            $sta=9;
        }
        else{
            $status=[$status];
        }
        if($location != 10){
            if($location=='Savannah, GA')
                $location='Savannah';
            else $location = $locations;
        }

        $shipment = DB::table('containers')
           ->select("containers.*","containers.id as cid","companies.name as company_name")
           // ->leftJoin('tbl_bases','tbl_bases.container_id','=','containers.id')
           ->leftJoin('companies','companies.id','=','containers.company_id');
           if(!empty($status)){
           $shipment->whereIn('containers.status',$status);
             }
           if($sta=='9'){
           $shipment->where('containers.cut_off_date',date('Y-m-d'));
            }
            if($location !='10'){
               $shipment->where('containers.port_loading','like', '%'.$location.'%');
            }
           $shipment->orderBy('containers.id','desc');
          $shipments=$shipment->paginate($paginate);
           return view('admin.shipment.shipment',['shipments'=>$shipments,'paginate'=>$paginate,'status'=>$sta,'location'=>$location]);      
    }

    public function search_shipment(Request $request)
    {
       $pagination=20;
       $status ='';
       $location=$request['locations'];
       $sta=$request['status'];
       if($request['status']){
          $status= $request['status'];
        }
        if($status==10){
            $status=array();
            $sta=10;
        }
         elseif($status==9){
             $status=[0,3,4,5];
            $sta=9;
        }
        else{
            $status=[$request['status']];
        }
        if($location != 10){
            if($location=='Savannah, GA')
                $location='Savannah';
            else $location = $request['locations'];
        }
        $searchQuery = trim($request['searchValue']);
        $requestData = ['containers.booking_number','containers.container_number','containers.port_loading','containers.vessel_name','companies.name'];
        if($request->ajax()){
        $shipment = DB::table('containers')->select("containers.*","containers.id as cid","companies.name as company_name")
           ->leftjoin('companies','companies.id','=','containers.company_id');
           if(strlen($searchQuery) >=3){
             $pagination=100;
            $shipment->where(function($q) use($requestData, $searchQuery) {
                    foreach ($requestData as $field)
                     $q->orWhere($field, 'like', "%{$searchQuery}%");
                });
            }
           if(!empty($status)){
           $shipment->whereIn('containers.status',$status);
            }
            if($sta=='9'){
           $shipment->where('containers.cut_off_date',date('Y-m-d'));
            }
            if($location !='10'){
               $shipment->where('containers.port_loading','like', '%'.$location.'%');
            }
           $shipment->orderBy('containers.id','desc');
          $shipments=$shipment->paginate($pagination);
           return view('admin.shipment.shipment_data',['shipments'=>$shipments,'paginate'=>20,'status'=>$sta,'location'=>$location]);
        } 
    }

    public function paginate_shipment(Request $request)
    {
        $pagination=20;
        $status='';
        $location=$request['locations'];
        $sta=$request['status'];
        if($request['paginate']){
          $pagination= $request['paginate'];
        }
        if($request['status']){
          $status= $request['status'];
        }
        if($status==10){
            $status=array();
            $sta=10;
        }
         elseif($status==9){
             $status=[0,3,4,5];
            $sta=9;
        }
        else{
            $status=[$request['status']];
        }
        if($location != 10){
            if($location=='Savannah, GA')
                $location='Savannah';
            else $location = $request['locations'];
        }

         if($request->ajax()){
             $shipment = DB::table('containers')
             ->select("containers.*","containers.id as cid","companies.name as company_name")
               ->leftJoin('companies','companies.id','=','containers.company_id');
               if(!empty($status)){
               $shipment->whereIn('containers.status',$status);
                }
                if($sta=='9'){
               $shipment->where('containers.cut_off_date',date('Y-m-d'));
                }
              if($location !='10'){
               $shipment->where('containers.port_loading','like', '%'.$location.'%');
               }
               $shipment->orderBy('containers.id','desc');
              $shipments=$shipment->paginate($pagination);
               return view('admin.shipment.shipment_data',['shipments'=>$shipments,'paginate'=>20,'status'=>$sta,'location'=>$location]);
        } 
    }

    // add shipment
    public function add_new_shipment(Request $request)
    {
        if(!auth()->guard('admin')->user()->hasPermissions(['Admin','add-shipment']))
            return view('admin.error.403');

        $container_no=DB::table('containers')->where('container_number',$request['cont_number'])->exists();
        if($container_no){
            return redirect()->back()->with('error','container number already exist');
        }
        $add_contanier = new ShipmentModel();
        $add_contanier->booking_number = $request['book_number'];
        $add_contanier->aes_itn_number = $request['itn_number'];
        $add_contanier->container_number = $request['cont_number'];
        $add_contanier->bolading_number = $request['lading_number'];
        $add_contanier->pglr_number = $request['pgl_number'];
        $add_contanier->seal_number = $request['seal_number'];
        $add_contanier->c_size = $request['cont_size'];
         $add_contanier->company_id = $request['company_id'];
         if($request['rcontainer']){
             $add_contanier->status = $request['rcontainer'];
         }
         if($request['company_id']){
                $company_vip=DB::table('companies')
                ->where('id',$request['company_id'])->first();
                 $add_contanier->vip = $company_vip->vip;
            }
        $add_contanier->inv_number = $request['inv_number'];
        $add_contanier->amount = $request['amount'];
        $add_contanier->cut_off_date = $request['cut_date'];
        $add_contanier->loading_date = $request['load_date'];
        $add_contanier->etd_port_loading = $request['port_loading'];
        $add_contanier->eta_port_discharge = $request['port_discharge'];
        $add_contanier->vessel_name = $request['vessel_name'];
        $add_contanier->voyage_number = $request['voyage_number'];
        $add_contanier->flag = $request['flag'];
        $add_contanier->steamship_line = $request['line'];
        $add_contanier->place_receipt = $request['place_rec'];
        $add_contanier->pier = $request['pier'];
        $add_contanier->port_loading = $request['port_of_loading'];
        $add_contanier->loading_terminal = $request['loading_terminal'];
        $add_contanier->port_discharge = $request['port_of_discharge'];
        $add_contanier->release_date = $request['release_date'];
        $add_contanier->poc_cargo_release = $request['poc_cargo_re'];
        $add_contanier->country_origin = $request['country_or'];
        $add_contanier->scac_code = $request['scac_code'];
        $add_contanier->t_cost = $request['t_cost'];
        $add_contanier->broker_name = $request['broker_name'];
        $add_contanier->prec_by = $request['pre_carriage'];
        $add_contanier->place_pre_carrier = $request['porbpc'];
        $add_contanier->pin_in=$request['pin_in'];
        $add_contanier->pin_out=$request['pin_out'];
        $add_contanier->shipper_exporter = $request['shipper'];
        $add_contanier->shipper_street_address = $request['shipper_street'];
        $add_contanier->shipper_city = $request['shipper_city'];
        $add_contanier->shipper_state = $request['shipper_state'];
        $add_contanier->shipper_zip_code = $request['shipper_zip'];
        $add_contanier->shipper_email_address = $request['shipper_email'];
        $add_contanier->shipper_phone_number = $request['shipper_phone'];
        $add_contanier->shipper_fax_number = $request['shipper_fax'];
        $add_contanier->shipper_poc = $request['shipper_poc'];
        $add_contanier->f_agent = $request['forward_agent'];
        $add_contanier->f_street_address = $request['forward_agent_add'];
        $add_contanier->f_city = $request['forward_agent_city'];
        $add_contanier->f_state = $request['forward_agent_state'];
        $add_contanier->f_zip_code = $request['forward_agent_zip'];
        $add_contanier->f_email_address = $request['forward_agent_email'];
        $add_contanier->f_phone_number = $request['forward_agent_phone'];
        $add_contanier->f_fax_number = $request['forward_agent_fax'];
        $add_contanier->f_poc = $request['forward_agent_poc'];
        $add_contanier->meas = $request['measure'];
        $add_contanier->n_units_load = $request['number_unit'];
        $add_contanier->export_instruc = $request['export_ref'];
        $add_contanier->basic_instruc = $request['basic_ins'];
        $add_contanier->create_date = $request['create_date'];
        $add_contanier->create_by = session('id');
        $add_contanier->save();
        $container = DB::table('containers')->orderBy('id', 'desc')->first();
        if (!empty($request->file)) {
            foreach ($request->file as $photo) {
                $imagename = random_int(0, 10000) . time() . '.' . $photo->getClientOriginalExtension();
                $destinationPath = public_path('images/container');
                $photo->move($destinationPath, $imagename);
                $data['file'] = $imagename;
                DB::table('container_images')->insert([
                      'container_id' => $container->id,
                      'photo' => $imagename
                  ]);
            }
        }
        if (!empty($request->file1)) {
            foreach ($request->file1 as $photo) {
                $imagename = random_int(0, 10000) . time() . '.' . $photo->getClientOriginalExtension();
                $destinationPath = public_path('images/container_file');
                $photo->move($destinationPath, $imagename);
                $data['file1'] = $imagename;
                DB::table('container_files')->insert([
                     'container_id' => $container->id,
                     'file' => $imagename
                 ]);
            }
        }
         // flog('Container','Add new container ',$request['book_number']);
        return redirect()->back()->with('success', 'saved!');
    }
    // will make a copy of a shipm with diffrent booking an container no 
    public function duplicate_shipment($id='')
    {
        $container = ShipmentModel::find($id);
        return view('admin.shipment.duplicate_shipment',['container'=>$container]);
    }

    public function edit_shipment($id='')
    {
        if(!auth()->guard('admin')->user()->hasPermissions(['Admin','edit-shipment']))
            return view('admin.error.403');

        $container = ShipmentModel::find($id);
        return view('admin.shipment.edit_shipment',['container'=>$container]);
    }

    public function update_shipment(Request $request)
    {
        $update_shipment = ShipmentModel::find($request['id']);
        $update_shipment->booking_number = $request['book_number'];
        $update_shipment->aes_itn_number = $request['itn_number'];
        if($update_shipment->container_number != $request['cont_number']){
          $update_shipment->container_no_update_date= date('Y-m-d');
        }
        $update_shipment->container_number = $request['cont_number'];
        $update_shipment->bolading_number = $request['lading_number'];
        $update_shipment->pglr_number = $request['pgl_number'];
        $update_shipment->seal_number = $request['seal_number'];
        $update_shipment->c_size = $request['cont_size'];
        $update_shipment->inv_number = $request['inv_number'];
        $update_shipment->amount = $request['amount'];
        $update_shipment->company_id = $request['company_id'];
        $update_shipment->cut_off_date = $request['cut_date'];
        $update_shipment->loading_date = $request['load_date'];
        $update_shipment->etd_port_loading = $request['port_loading'];
        $update_shipment->eta_port_discharge = $request['port_discharge'];
        $update_shipment->vessel_name = $request['vessel_name'];
        $update_shipment->voyage_number = $request['voyage_number'];
        $update_shipment->flag = $request['flag'];
        $update_shipment->steamship_line = $request['line'];
        $update_shipment->place_receipt = $request['place_rec'];
        $update_shipment->pier = $request['pier'];
        $update_shipment->port_loading = $request['port_of_loading'];
        $update_shipment->loading_terminal = $request['loading_terminal'];
        $update_shipment->port_discharge = $request['port_of_discharge'];
        $update_shipment->release_date = $request['release_date'];
        $update_shipment->poc_cargo_release = $request['poc_cargo_re'];
        $update_shipment->country_origin = $request['country_or'];
        $update_shipment->scac_code = $request['scac_code'];
        $update_shipment->t_cost = $request['t_cost'];
        $update_shipment->broker_name = $request['broker_name'];
        $update_shipment->prec_by = $request['pre_carriage'];
        $update_shipment->place_pre_carrier = $request['porbpc'];
        $update_shipment->pin_in = $request['pin_in'];
        $update_shipment->pin_out = $request['pin_out'];
        $update_shipment->shipper_exporter = $request['shipper'];
        $update_shipment->shipper_street_address = $request['shipper_street'];
        $update_shipment->shipper_city = $request['shipper_city'];
        $update_shipment->shipper_state = $request['shipper_state'];
        $update_shipment->shipper_zip_code = $request['shipper_zip'];
        $update_shipment->shipper_email_address = $request['shipper_email'];
        $update_shipment->shipper_phone_number = $request['shipper_phone'];
        $update_shipment->shipper_fax_number = $request['shipper_fax'];
        $update_shipment->shipper_poc = $request['shipper_poc'];
        $update_shipment->f_agent = $request['forward_agent'];
        $update_shipment->f_street_address = $request['forward_agent_add'];

        $update_shipment->f_city = $request['forward_agent_city'];
        $update_shipment->f_state = $request['forward_agent_state'];
        $update_shipment->f_zip_code = $request['forward_agent_zip'];
        $update_shipment->f_email_address = $request['forward_agent_email'];
        $update_shipment->f_phone_number = $request['forward_agent_phone'];
        $update_shipment->f_fax_number = $request['forward_agent_fax'];
        $update_shipment->f_poc = $request['forward_agent_poc'];
        $update_shipment->meas = $request['measure'];
        $update_shipment->n_units_load = $request['number_unit'];
        $update_shipment->export_instruc = $request['export_ref'];
        $update_shipment->basic_instruc = $request['basic_ins'];
        $update_shipment->update();
        $container = DB::table('containers')->where('id', $request['id'])->first();
        if (!empty($request->file)) {
            foreach ($request->file as $photo) {
                $imagename = random_int(0, 10000) . time() . '.' . $photo->getClientOriginalExtension();
                $destinationPath = public_path('images/container');
                $photo->move($destinationPath, $imagename);
                $data['file'] = $imagename;
                DB::table('container_images')->insert([
                  'container_id' => $container->id,
                  'photo' => $imagename
               ]);
            }
        }
        if (!empty($request->file1)) {
            foreach ($request->file1 as $photo) {
                $imagename = $photo->getClientOriginalName();
                $destinationPath = public_path('images/container_file');
                $photo->move($destinationPath, $imagename);
                $data['file1'] = $imagename;
                DB::table('container_files')->insert([
                     'container_id' => $container->id,
                     'file' => $imagename
                 ]);
            }
        }
        // flog('Container','Update container ',$update_shipment->booking_number);
        return redirect()->route('shipment_admin',['10','10'])->with('success', 'saved!');
    }

    public function delete_shipment($id='')
    {
        if(!auth()->guard('admin')->user()->hasPermissions(['Admin','delete-shipment']))
            return view('admin.error.403');

        $delete_shipment = ShipmentModel::find($id);
        // flog('Container','Delete container ',$delete_shipment->booking_number);
        $delete_shipment->delete();
        return redirect()->back()->with('success', 'deleted');
    }

    // bol for admin 
    public function bol($id='')
    {
        $container = ShipmentModel::find($id);
        return view('admin.shipment.bol', ['conti' => $container]);
    }
    // bol pdf 
    public function bol_pdf($id='')
    {
        $container = ShipmentModel::find($id);
        $pdf = PDF::loadView('admin.shipment.bol_pdf', ['conti' => $container],['format' =>['A4',190,236]]);
        return $pdf->download('BOL.pdf');
        
    }

    // dock recepit for customer 
    public function dock_recepit($id='')
    {
        $container = ShipmentModel::find($id);
        return view('admin.shipment.dock_recepit', ['conti' => $container]);
    }
    // shipment custom form
    public function custom_form($id='')
    {
        $container = ShipmentModel::find($id);
        return view('admin.shipment.custom_form', ['conti' => $container]);
    }
    // release document
    public function release_document($id='')
    {
        $container = ShipmentModel::find($id);
        return view('admin.shipment.release_document', ['conti' => $container]);
        
    }
    // change shipment status 
    public function change_status_shipment(Request $request)
    {
        if(!auth()->guard('admin')->user()->hasPermissions(['Admin','add-status']))
            return view('admin.error.403');

        $ids = $request->ids;
         DB::table('containers')->whereIn('id',explode(",",$ids))
         ->update(['status' =>$request->status]);
        return response()->json(['status'=>true,'message'=>'Status changed Successfully !']);
    }

    function shipment_summary(Request $request)
    {
        $locations=DB::table('locations')->get();
        if($request['location'])
        {
            $location=$request['location'];
            if($location=='Savannah, GA'){$location='Savannah';}
            $container = DB::table('companies')
            ->select('companies.*','companies.id as cid')
            ->rightjoin('containers','containers.company_id','=','companies.id')
            // ->where('containers.port_loading','like','%'.$request['location'].'%')
            // ->groupby('companies.id')   
            ->when($location !='All',
                function($q) use ($location){
                    return $q->where('containers.port_loading','like', '%'.$location.'%');
                }
            )->groupby('companies.id') 
            ->get();
        return view('admin.shipment.shipment_summary_data')
        ->with(['shipments' => $container,'locations'=>$locations]);
        }
        else{
        $container = DB::table('companies')
            ->select('companies.*','companies.id as cid')
            ->groupby('companies.id')
            ->get();
        return view('admin.shipment.shipment_summary')
        ->with(['shipments' => $container,'locations'=>$locations]);
       }
    }

    public function shipment_summary_search($company_id='', $status='')
    {  
        $shipment = DB::table('containers')
           ->select("containers.*","containers.id as cid","companies.name as company_name")
           ->leftJoin('companies','companies.id','=','containers.company_id');
           if($status !='5'){
           $shipment->where(['containers.status'=>$status,'containers.company_id'=>$company_id]);
             }
           $shipment->orderBy('containers.id','desc');
           $shipments=$shipment->paginate(100);
           return view('admin.shipment.shipment_summary_search',['shipments'=>$shipments,'status'=>10,'company_id'=>$company_id]); 
    }

    // check container existens base on container no  
   public function check_container_number(Request $request)
    {
      $container_no=DB::table('containers')->where('container_number',$request['container_number'])->exists();
        if($container_no) echo true;
        else echo false;
    }

    // update the etd containers date
    function update_etd_date(Request $request)
    {
       $container_id=$request['container_id'];
       $etd_date=$request['etd_date'];

       $container=ShipmentModel::find($container_id);
       $container->etd_port_loading=$etd_date;
       if($container->update()){
        echo json_encode($etd_date);
       }
       else{
        echo json_encode(0);
       }

    }

     // update the eta containers date
    function update_eta_date(Request $request)
    {
       $container_id=$request['container_id'];
       $eta_date=$request['eta_date'];

       $container=ShipmentModel::find($container_id);
       $container->eta_port_discharge=$eta_date;
       if($container->update()){
        echo json_encode($eta_date);
       }
       else{
        echo json_encode(0);
       }

    }

    // Archive or shipment section 
    public function archive_shipment()
    {
        if(!auth()->guard('admin')->user()->hasPermissions(['Admin','shipment-management']))
            return view('admin.error.403');

        $shipments = DB::table('containers')
          ->select(
                "containers.id",
                "containers.container_number",
                "containers.booking_number",
                "containers.inv_number",
                 "containers.aes_itn_number",
                "containers.customer_note",
                "companies.name as company_name")
           ->leftJoin('companies','companies.id','=','containers.company_id')
           ->where('containers.port_loading','like', '%'.'Savannah'.'%')
           ->orderBy('containers.id','desc')
           ->paginate(20);
           return view('admin.shipment.archive_shipment',['shipments'=>$shipments,'paginate'=>20,'status'=>0,'location'=>'Savannah']);      
    }

    public function search_archive_shipment(Request $request)
    {
       $pagination=20;
       $status ='Savannah';
       $location=$request['locations'];
        $searchQuery = trim($request['searchValue']);
        $requestData = ['containers.booking_number','containers.container_number','containers.vessel_name','containers.inv_number'];
        if($request->ajax()){
        $shipment = DB::table('containers')
        ->select(
             "containers.id",
            "containers.container_number",
            "containers.booking_number",
            "containers.inv_number",
            "containers.customer_note",
            "containers.aes_itn_number",
            "companies.name as company_name")
           ->leftjoin('companies','companies.id','=','containers.company_id');
           if(strlen($searchQuery) >=3){
             $pagination=100;
            $shipment->where(function($q) use($requestData, $searchQuery) {
                    foreach ($requestData as $field)
                     $q->orWhere($field, 'like', "%{$searchQuery}%");
                });
            }
           $shipment
           ->where('containers.port_loading','like', '%'.'Savannah'.'%')
           ->orderBy('containers.id','desc');
          $shipments=$shipment->paginate($pagination);
           return view('admin.shipment.archive_shipment_data',['shipments'=>$shipments,'paginate'=>20,'status'=>$status,'location'=>$location]);
        } 
    }

    public function paginate_archive_shipment(Request $request)
    {
        $pagination=20;
        $status ='Savannah';
        $location=$request['locations'];
        if($request['paginate']){
          $pagination= $request['paginate'];
        }

         if($request->ajax()){
             $shipments = DB::table('containers')
             ->select(
                "containers.id",
                "containers.container_number",
                "containers.booking_number",
                "containers.inv_number",
                 "containers.aes_itn_number",
                "containers.customer_note",
                "companies.name as company_name")
               ->leftJoin('companies','companies.id','=','containers.company_id')
              ->where('containers.port_loading','like', '%'.'Savannah'.'%')
              ->orderBy('containers.id','desc')
              ->paginate($pagination);
               return view('admin.shipment.archive_shipment_data',['shipments'=>$shipments,'paginate'=>20,'status'=>$status,'location'=>$location]);
        
      }
    }

    public function add_archive_shipment(Request $request)
    {
       $update_shipment = ShipmentModel::find($request['id']);
        $update_shipment->title_archive_reference_no = $request['reference_no'];
        $update_shipment->title_archive_note = $request['note'];
        $update_shipment->update();
        return redirect()->back()->with('success','Update Successfully');  
    }



}
