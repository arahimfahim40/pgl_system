<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('welcome');
    }
    public function dashboard()
    {
        $vehicles=DB::table('vehicles')->where('customer_id',Auth::id())->count();
              $container = DB::table('containers')->select("containers.*","tbl_bases.*","containers.id as cid")
                   ->leftJoin('tbl_bases','tbl_bases.container_id','=','containers.id')
                   ->where('customer_id','=',Auth::id())
                   ->groupBy('containers.id')
                   ->get();
                $containers= count($container);

                $invoice=DB::table('pgl_invoices')->join('companies','pgl_invoices.company_id','companies.id')->join('customers','companies.id','customers.company_id')->where('customers.id',Auth::id())->get();
                        $invoices=count($invoice);

                $messages=DB::table('notifications')
                ->where(['customer_id'=>Auth::id(),'type'=>1])
                ->orderBy('id','desc')
                ->orderBy('status','desc')
                ->paginate(30);

                // invoice balance
                $openInvoice=DB::table('pgl_invoices')->select('pgl_invoices.id as id')
                ->join('companies','pgl_invoices.company_id','companies.id')->join('customers','companies.id','customers.company_id')->where('customers.id',Auth::id())
                ->where('pgl_invoices.status',0)
                ->sum('pgl_invoices.inv_amount');

                 $paidInvoice=DB::table('pgl_invoices')->select('pgl_invoices.id as id')
                ->join('companies','pgl_invoices.company_id','companies.id')->join('customers','companies.id','customers.company_id')->where('customers.id',Auth::id())
                ->where('pgl_invoices.status',3)
                ->sum('pgl_invoices.inv_amount');

                // $balance= $paidInvoice - $openInvoice;
                $allInvoice=DB::table('pgl_invoices')->select('pgl_invoices.id as id')
                ->join('companies','pgl_invoices.company_id','companies.id')->join('customers','companies.id','customers.company_id')->where('customers.id',Auth::id())
                ->sum('pgl_invoices.inv_amount');

             return view('customer.dashboard.dashboard')->with(['vehicles'=>$vehicles,'containers'=>$containers,'invoices'=>$invoices,'messages'=>$messages,'allInvoice'=>$allInvoice,'paidInvoice'=>$paidInvoice,'openInvoice'=>$openInvoice]);
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
             <a href=" . url('vehicle_base_location_and_status_customer',['loc'=>$loc->id,'car'=>1]).">".
                $on_the_way=DB::table('vehicles')
                ->where('location_id',$loc->id)
                ->where('customer_id',Auth::id())
                ->where('carstate_id',1)->count();
                "</a> 
            </td>";
            $AllData.="<td style='text-align: center'>
             <a href=" . url('vehicle_base_location_and_status_customer',['loc'=>$loc->id,'car'=>2]).">".
                $on_hand_no_title=DB::table('vehicles')
                ->where('location_id',$loc->id)
                ->where('customer_id',Auth::id())
                ->where('carstate_id',2)->count();
                "</a> 
            </td>";

            $AllData.="<td style='text-align: center'>
             <a href=" . url('vehicle_base_location_and_status_customer',['loc'=>$loc->id,'car'=>3]).">".
                $on_hand_with_title=DB::table('vehicles')
                ->where('location_id',$loc->id)
                ->where('customer_id',Auth::id())
                ->where('carstate_id',3)->count();
                "</a> 
            </td>";

            $AllData.="<td style='text-align: center'>
             <a href=" . url('vehicle_base_location_and_status_customer',['loc'=>$loc->id,'car'=>5]).">".
                $shipped=DB::table('vehicles')
                ->where('location_id',$loc->id)
                ->where('customer_id',Auth::id())
                ->where('carstate_id',5)->count();
                "</a> 
            </td>";

            $AllData.="<td style='text-align: center'>
             <a href=" . url('vehicle_base_location_and_status_customer',['loc'=>$loc->id,'car'=>6]).">".
                $pending=DB::table('vehicles')
                ->where('location_id',$loc->id)
                ->where('customer_id',Auth::id())
                ->where('carstate_id',6)->count();
                "</a> 
            </td>";

            $AllData.="<td style='text-align: center'>
             <a href=" . url('vehicle_base_location_and_status_customer',['loc'=>$loc->id,'car'=>'10']).">".
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
      <a href=" . route('on_theway_vehicle_customer').">". $sum; " </a>
      </td>";
      $AllData.="<td style='text-align: center'>
      <a href=" . route('pending_vehicle_customer').">". $sum1; " </a>
      </td>";
      $AllData.="<td style='text-align: center'>
      <a href=" . route('onhand_notitle_vehicle_customer').">". $sum2; " </a>
      </td>";
      $AllData.="<td style='text-align: center'>
      <a href=" . route('onhand_withtitle_vehicle_customer').">". $sum4; " </a>
      </td>";
      $AllData.="<td style='text-align: center'>
      <a href=" . route('shipped_vehicle_customer').">". $sum5; " </a>
      </td>";
      $AllData.="<td style='text-align: center'>
      <a href=" . route('all_vehicle_customer').">". $sumo=$sumo+$sum+$sum1+$sum2+$sum3+$sum4+$sum5; " </a>
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
            ->select("containers.id","tbl_bases.container_id","containers.id as id")
            ->leftJoin('tbl_bases','tbl_bases.container_id','=','containers.id')
            ->whereIn('containers.status',[0,3])
            ->where('customer_id',Auth::id())
            ->where('port_loading','like', '%'.$locations.'%')
            ->groupBy('containers.id')
            ->get();

                 $onthewayshipments = DB::table('containers')
                ->select("containers.id","tbl_bases.container_id","containers.id as id")
                ->leftJoin('tbl_bases','tbl_bases.container_id','=','containers.id')
                ->whereIn('containers.status',[1,4,5])
                ->where('customer_id',Auth::id())
                ->where('port_loading','like', '%'.$locations.'%')
                ->groupBy('containers.id')
                ->get();

            $arrivedshipments = DB::table('containers')
                ->select("containers.id","tbl_bases.container_id","containers.id as id")
                ->leftJoin('tbl_bases','tbl_bases.container_id','=','containers.id')
                ->where('containers.status',2)
                ->where('customer_id',Auth::id())
                ->where('port_loading','like', '%'.$locations.'%')
                ->groupBy('containers.id')
                ->get();

           $AllData.="<tr>";
            $AllData.="<th>".$loc->location. "</th>";
           $AllData.="<td style='text-align: center'>
             <a href=" . url('shipment_base_location_and_status_customer',['loc'=>$loc->location,'status'=>0]).">".
                $loadingshipment=count($loadingshipments);
            "</a> 
            </td>";
            $AllData.="<td style='text-align: center'>
             <a href=" . url('shipment_base_location_and_status_customer',['loc'=>$loc->location,'status'=>1]).">".
                $onthewayshipment=count($onthewayshipments);
             "</a> 
            </td>";
            $AllData.="<td style='text-align: center'>
             <a href=" . url('shipment_base_location_and_status_customer',['loc'=>$loc->location,'status'=>2]).">".
                $arrivedshipment=count($arrivedshipments);
             "</a> 
            </td>";
            $AllData.="<td style='text-align: center'>
             <a href=" . url('shipment_base_location_and_status_customer',['loc'=>$loc->location,'status'=>3]).">".
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
          <a href=" . route('shipment_customer','0').">". $totalAtloading; " </a>
          </td>";
          $AllData.="<td style='text-align: center'>
          <a href=" . route('shipment_customer','1').">". $totalOntheway; " </a>
          </td>";
           $AllData.="<td style='text-align: center'>
          <a href=" . route('shipment_customer','2').">". $totalArrived; " </a>
          </td>";
          $AllData.="<td style='text-align: center'>
          <a href=" . route('shipment_customer','5').">". $allTotal=$totalAtloading+$totalOntheway+$totalArrived; " </a>
          </td>";
          $AllData.= "<br></tr>";
          echo json_encode($AllData);
   }


   function veh_ship_inv_total()
   {
        $on_the_way=DB::table('vehicles')
        ->where('customer_id',Auth::id())
        ->where('carstate_id',1)->count();
        
        $on_hand_no_title=DB::table('vehicles')
        ->where('customer_id',Auth::id())
        ->where('carstate_id',2)->count();
        
        $on_hand_with_title=DB::table('vehicles')
        ->where('customer_id',Auth::id())
        ->where('carstate_id',3)->count();
       
        $shipped=DB::table('vehicles')
        ->where('customer_id',Auth::id())
        ->where('carstate_id',5)->count();
        
        $pending=DB::table('vehicles')
        ->where('customer_id',Auth::id())
        ->where('carstate_id',6)->count();

        $all_vehicle = $on_the_way + $on_hand_no_title + $on_hand_with_title + $shipped + $pending;

        // shipment total section 
        $loadingshipments = DB::table('containers')
            ->select("containers.id","tbl_bases.container_id","containers.id as id")
            ->leftJoin('tbl_bases','tbl_bases.container_id','=','containers.id')
            ->whereIn('containers.status',[0,3])
            ->where('customer_id',Auth::id())
            ->groupBy('containers.id')
            ->get();

         $onthewayshipments = DB::table('containers')
                ->select("containers.id","tbl_bases.container_id","containers.id as id")
                ->leftJoin('tbl_bases','tbl_bases.container_id','=','containers.id')
                ->whereIn('containers.status',[1,4,5])
                ->where('customer_id',Auth::id())
                ->groupBy('containers.id')
                ->get();

            $arrivedshipments = DB::table('containers')
                ->select("containers.id","tbl_bases.container_id","containers.id as id")
                ->leftJoin('tbl_bases','tbl_bases.container_id','=','containers.id')
                ->where('containers.status',2)
                ->where('customer_id',Auth::id())
                ->groupBy('containers.id')
                ->get();

            $allSshipment = DB::table('containers')->select("containers.*","tbl_bases.*","containers.id as id")
                 ->leftJoin('tbl_bases','tbl_bases.container_id','=','containers.id')
                 ->where('customer_id',Auth::id())
                 ->groupBy('containers.id')
                 ->get();
              
                $loadingshipment=count($loadingshipments);
            
                $onthewayshipment=count($onthewayshipments);
             
                $arrivedshipment=count($arrivedshipments);
            
                $all_shipment= count($allSshipment);

                // invoice section total
                $allinvoice= $all_invoices=DB::table('pgl_invoices')
                ->join('companies','pgl_invoices.company_id','companies.id')
                ->join('customers','companies.id','customers.company_id')
                ->where('customers.id',Auth::id())
                ->count(); 

                $openinvoice= $all_invoices=DB::table('pgl_invoices')
                ->join('companies','pgl_invoices.company_id','companies.id')
                ->join('customers','companies.id','customers.company_id')
                ->where('customers.id',Auth::id())
                ->where('pgl_invoices.status',0)
                ->count(); 

                 $pastdueinvoice= $all_invoices=DB::table('pgl_invoices')
                ->join('companies','pgl_invoices.company_id','companies.id')
                ->join('customers','companies.id','customers.company_id')
                ->where('customers.id',Auth::id())
                ->where('pgl_invoices.status',2)
                ->count(); 

                 $paidinvoice= $all_invoices=DB::table('pgl_invoices')
                ->join('companies','pgl_invoices.company_id','companies.id')
                ->join('customers','companies.id','customers.company_id')
                ->where('customers.id',Auth::id())
                ->where('pgl_invoices.status',3)
                ->count(); 

                exit(json_encode([
                    'allvehicle'=>$all_vehicle,
                    'onthewayvehicle'=>$on_the_way,
                    'onhandnotitlevehicle'=>$on_hand_no_title,
                    'onhandwithtitlevehicle'=>$on_hand_with_title,
                    'shippedvehicle'=>$shipped,
                    'pendingvehicle'=>$pending,

                    'allshipment'=>$all_shipment,
                    'loadingshipment'=>$loadingshipment,
                    'onthewayshipment'=>$onthewayshipment,
                    'arrivedshipment'=>$arrivedshipment,

                    'allinvoice'=>$allinvoice,
                    'openinvoice'=>$openinvoice,
                    'pastdueinvoice'=>$pastdueinvoice,
                    'paidinvoice'=>$paidinvoice

                ]));
                
   }

   function message()
   {
        $message='';
        $messages=DB::table('notifications')
        ->where(['customer_id'=>Auth::id(),'type'=>1,'status'=>0])
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
