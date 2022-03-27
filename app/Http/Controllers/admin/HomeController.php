<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
     
    public function __construct()
    {
        $this->middleware('auth:admin');                
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('admin/auth/login');
    }
    public function dashboard()
    {
        
        $locations=DB::table('locations')->get();
        $vehicles=DB::table('vehicles')->count();
        $containers = DB::table('containers')->count();
        // $containers= count($container);
        $invoices=DB::table('pgl_invoices')->count();
        $customers=DB::table('customers')->count();
         // $invoices=count($invoice);

        $messages=DB::table('notifications')
        ->where(['admin_id'=>session('id'),'type'=>0])
        ->orderBy('id','desc')
        ->paginate(30);

        $messages=DB::table('notifications')
        ->where(['admin_id'=>session('id'),'type'=>0])
        ->orderBy('id','desc')
        ->orderBy('status','desc')
        ->paginate(30);

        return view('admin.dashboard.dashboard')->with(['locations',$locations,'vehicles'=>$vehicles,'containers'=>$containers,'invoices'=>$invoices,'customers'=>$customers,'messages'=>$messages]);
                
    }

function vehicle_summary(Request $request){
    if($request->ajax()){
    $sum=0;
    $sum1=0; 
    $sum2=0; 
    $sum3=0; 
    $sum4=0;
    $sum5=0;
    $sumo=0;
    $sum_on_the_way=0; 
    $on_the_war10=0; 
    $on_the_war12=0; 
    $on_the_war13=0; 
    $on_the_war14=0;

    $AllData="<tr> 
    <th > Location </th>
    <th style='text-align: center'> On the way </th>
    <th style='text-align: center'> On hand no/title </th>
    <th style='text-align: center'> On hand with/title </th>
    <th style='text-align: center'> Shipped </th> 
    <th style='text-align: center'> Pending </th>
    <th style='text-align: center'> Total</th> 
    </tr>";
     $location= DB::table('locations')->get();
      foreach ($location as $key => $loc) {
           $AllData.="<tr>";
            $AllData.="<th>".$loc->location. "</th>";
           $AllData.="<td style='text-align: center'>
             <a href=" . url('vehicle_summary_search',['0','1',$loc->id]).">".
                $on_the_way=DB::table('vehicles')
                ->where('location_id',$loc->id)
                ->where('carstate_id',1)->count();
                "</a> 
            </td>";
            $AllData.="<td style='text-align: center'>
             <a href=" . url('vehicle_summary_search',['0','2',$loc->id]).">".
                $on_hand_no_title=DB::table('vehicles')
                ->where('location_id',$loc->id)
                ->where('carstate_id',2)->count();
                "</a> 
            </td>";

            $AllData.="<td style='text-align: center'>
             <a href=" . url('vehicle_summary_search',['0','3',$loc->id]).">".
                $on_hand_with_title=DB::table('vehicles')
                ->where('location_id',$loc->id)
                ->where('carstate_id',3)->count();
                "</a> 
            </td>";

            $AllData.="<td style='text-align: center'>
             <a href=" . url('vehicle_summary_search',['0','5',$loc->id]).">".
                $shipped=DB::table('vehicles')
                ->where('location_id',$loc->id)
                ->where('carstate_id',5)->count();
                "</a> 
            </td>";

            $AllData.="<td style='text-align: center'>
             <a href=" . url('vehicle_summary_search',['0','6',$loc->id]).">".
                $pending=DB::table('vehicles')
                ->where('location_id',$loc->id)
                ->where('carstate_id',6)->count();
                "</a> 
            </td>";

            $AllData.="<td style='text-align: center'>
             <a href=" . url('vehicle_summary_search',['0','10',$loc->id]).">".
                $total=(int)$on_the_way+(int)$on_hand_no_title+(int)$on_hand_with_title+(int)$pending+(int)$shipped;
              
                "</a> 
            </td>";

            $AllData.="</tr>";
                 $sum=$sum+$on_the_way; 
                 $sum1=$sum1+$on_hand_no_title;
                 $sum2=$sum2+$on_hand_with_title;
                 $sum4=$sum4+$shipped;
                 $sum5=$sum5+$pending;           
     }

     $AllData.= "<tr>";
      $AllData.= "<th> Total </th>";

      $AllData.="<td style='text-align: center'>
      <a href=" . route('on_theway_vehicle_admin').">". $sum; " </a>
      </td>";
      $AllData.="<td style='text-align: center'>
      <a href=" . route('onhand_notitle_vehicle_admin').">". $sum1; " </a>
      </td>";
      $AllData.="<td style='text-align: center'>
      <a href=" . route('onhand_withtitle_vehicle_admin').">". $sum2; " </a>
      </td>";
      $AllData.="<td style='text-align: center'>
      <a href=" . route('shipped_vehicle_admin').">". $sum4; " </a>
      </td>";
      $AllData.="<td style='text-align: center'>
      <a href=" . route('pending_vehicle_admin').">". $sum5; " </a>
      </td>";
      $AllData.="<td style='text-align: center'>
      <a href=" . route('all_vehicle_admin').">". $sumo=$sumo+$sum+$sum1+$sum2+$sum3+$sum4+$sum5; " </a>
      </td>";
      $AllData.= "<br></tr>";

      echo json_encode($AllData);
       }

    }

function shipment_summary(){

     $totalAtloading=0;
     $totalOntheway=0;
     $totalArrived=0;
     $allTotal=0;

    $AllData="<tr> 
    <th > Location </th>
    <th style='text-align: center'> At loading </th>
    <th style='text-align: center'> On the way </th>
    <th style='text-align: center'> Arrived </th>
    <th style='text-align: center'> Total</th> 
    </tr>";

    $location= DB::table('locations')->get();
      foreach ($location as $key => $loc) {
        if($loc->location=='Savannah, GA')
           $locations='Savannah';
        else 
           $locations=$loc->location;

            $loadingshipments = DB::table('containers')
            ->where('containers.status',0)
            ->where('port_loading','like', '%'.$locations.'%')
            ->count();

            $onthewayshipments = DB::table('containers')
                ->where('status',1)
                ->where('port_loading','like', '%'.$locations.'%')
                ->count();

            $arrivedshipments = DB::table('containers')
                ->where('status',2)
                ->where('port_loading','like', '%'.$locations.'%')
                ->count();

           $AllData.="<tr>";
            $AllData.="<th>".$loc->location. "</th>";
           $AllData.="<td style='text-align: center'>
             <a href=" . route('shipment_admin',['0',$loc->location]).">".
                $loadingshipment=$loadingshipments;
            "</a> 
            </td>";
            $AllData.="<td style='text-align: center'>
             <a href=" . route('shipment_admin',['1',$loc->location]).">".
                $onthewayshipment=$onthewayshipments;
             "</a> 
            </td>";
            $AllData.="<td style='text-align: center'>
             <a href=" .route('shipment_admin',['2',$loc->location]) .">".
                $arrivedshipment=$arrivedshipments;
             "</a> 
            </td>";
            $AllData.="<td style='text-align: center'>
             <a href=" . route('shipment_admin',['10',$loc->location]).">".
                $totlas=$loadingshipment+ $onthewayshipment + $arrivedshipment;
             "</a> 
            </td>";
            $AllData.="</tr>";     
            $totalAtloading=$totalAtloading+$loadingshipment;
            $totalOntheway=$totalOntheway+$onthewayshipment;
            $totalArrived=$totalArrived+$arrivedshipment;          
     }

         $AllData.= "<tr>";
          $AllData.= "<th> Total </th>";

          $AllData.="<td style='text-align: center'>
          <a href=" . route('shipment_admin',['0','10']).">". $totalAtloading; " </a>
          </td>";
          $AllData.="<td style='text-align: center'>
          <a href=" . route('shipment_admin',['1','10']).">". $totalOntheway; " </a>
          </td>";
           $AllData.="<td style='text-align: center'>
          <a href=" . route('shipment_admin',['2','10']).">". $totalArrived; " </a>
          </td>";
          $AllData.="<td style='text-align: center'>
          <a href=" . route('shipment_admin',['10','10']).">". $allTotal=$totalAtloading+$totalOntheway+$totalArrived; " </a>
          </td>";
          $AllData.= "<br></tr>";
          echo json_encode($AllData);
   }


   function veh_ship_inv_total()
   {
        $on_the_way=DB::table('vehicles')
        ->where('carstate_id',1)->count();
        
        $on_hand_no_title=DB::table('vehicles')
        ->where('carstate_id',2)->count();
        
        $on_hand_with_title=DB::table('vehicles')
        ->where('carstate_id',3)->count();
       
        $shipped=DB::table('vehicles')
        ->where('carstate_id',5)->count();
        
        $pending=DB::table('vehicles')
        ->where('carstate_id',6)->count();

        $all_vehicle = $on_the_way + $on_hand_no_title + $on_hand_with_title + $shipped + $pending;

        // shipment total section 
        $loadingshipment = DB::table('containers')
                ->where('status',0)
                ->count();
        $pendingshipment = DB::table('containers')
                ->where('status',3)
                ->count();
        $checkedshipment = DB::table('containers')
                ->where('status',4)
                ->count();
        $finalcheckedshipment = DB::table('containers')
                ->where('status',5)
                ->count();
        $submitsishipment = DB::table('containers')
                ->whereIn('status',[0,3,4,5])
                ->where('cut_off_date',date('Y-m-d'))
                ->count();    
        $onthewayshipment = DB::table('containers')
                ->where('status',1)
                ->count();
        $arrivedshipment= DB::table('containers')
                ->where('status',2)
                ->count();
        $all_shipment = DB::table('containers')->count();
              

        // invoice section total
        $allinvoice= $all_invoices=DB::table('pgl_invoices')->count(); 

        $openinvoice= $all_invoices=DB::table('pgl_invoices')
        ->where('status',0)
        ->count(); 

         $pastdueinvoice= $all_invoices=DB::table('pgl_invoices')
        ->where('status',2)
        ->count(); 

         $paidinvoice= $all_invoices=DB::table('pgl_invoices')
        ->where('status',3)
        ->count(); 

        $pendinginvoice= $all_invoices=DB::table('pgl_invoices')
        ->where('status',4)
        ->count(); 

        exit(json_encode([
            'allvehicle'=>$all_vehicle,
            'onthewayvehicle'=>$on_the_way,
            'onhandnotitlevehicle'=>$on_hand_no_title,
            'onhandwithtitlevehicle'=>$on_hand_with_title,
            'shippedvehicle'=>$shipped,
            'pendingvehicle'=>$pending,

            'allshipment'=>$all_shipment,
            'pendingshipment'=>$pendingshipment,
            'loadingshipment'=>$loadingshipment,
            'checkedshipment'=>$checkedshipment,
            'finalcheckedshipment'=>$finalcheckedshipment,
            'submitsishipment'=>$submitsishipment,
            'onthewayshipment'=>$onthewayshipment,
            'arrivedshipment'=>$arrivedshipment,

            'allinvoice'=>$allinvoice,
            'openinvoice'=>$openinvoice,
            'pastdueinvoice'=>$pastdueinvoice,
            'paidinvoice'=>$paidinvoice,
            'pendinginvoice'=>$pendinginvoice

        ]));
                
   }

   function message()
   {
        $message='';
        $messages=DB::table('notifications')
        ->where(['admin_id'=>session('id'),'type'=>0,'status'=>0])
        ->orderBy('id','desc')
        ->paginate(30);
        foreach ($messages as $key => $mes) {
        $message .= "<div class='m-item '> <div class='mi-icon bg-warning'><i class='ti-comment'></i></div>  <div class='mi-text'><a class='text-black' href=".url('message')."></a> <span class='text-muted'>".substr($mes->subject,0,30)."</span> <a class='text-black' href='".route('message_detail_customer',$mes->id)."'> <br>".substr($mes->content,0,80)."</a>
            </div> 
            <div class='mi-time'>". \Carbon\Carbon::parse($mes->created_at)->diffForHumans()."</div>
            </div>";
         }
         $message.="<a class='dropdown-more' href='".route('messages_customer')."'>
                      <strong>View all Messages</strong>
                    </a>";
        echo json_encode($message);
   }



}
