<?php

namespace App\Http\Controllers;

use App\RateModel;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RateControllerCustomer extends Controller
{
    
    protected $towing;
    public function __construct(RateModel $towing)
    {
        $this->middleware('auth');
        $this->towing=$towing;

    }

    public function view_towing_rate()
    {
        $towingrates = $this->towing::take(10000)->paginate(20);
        return view('customer.rate.towing_rate',['towingrates' => $towingrates,'paginate'=>20]);
    }

    public function search_towing_rate(Request $request)
    {
        $pagination=20;
        $searchQuery = trim($request['searchValue']);
        $requestData = ['city','branch','state'];
        if($request->ajax()){
       $towingrate=$this->towing::take(10000);
        if($searchQuery!=''){
         $pagination=20000;
        $towingrate->where(function($q) use($requestData, $searchQuery) {
                        foreach ($requestData as $field)
                           $q->orWhere($field, 'like', "%{$searchQuery}%");
                });
        }
       $towingrates=$towingrate->orderBy('id','desc')->paginate($pagination); 
        return view('customer.rate.towing_rate_data',compact('towingrates'))->render();
      }
    }

    public function paginate_towing_rate(Request $request)
    {
        $paginate=20;
        if($request['paginate']){
          $paginate= $request['paginate'];
        }
        if($request->ajax()){
        $towingrates=$this->towing::take(10000)
        ->paginate($paginate); 
        return view('customer.rate.towing_rate_data',compact('towingrates','paginate'))->render();
      }
    }

    // shipping rate section
    public function view_shipping_rate()
    {
        $shippingrates = DB::table('pgl_rates')->take(10000)->paginate(20);
        return view('customer.rate.shipping_rate',['shippingrates' => $shippingrates,'paginate'=>20]);
    }

    public function search_shipping_rate(Request $request)
    {
        $pagination=20;
        $searchQuery = trim($request['searchValue']);
        $requestData = ['to_port','from_port'];
        if($request->ajax()){
       $shippingrate=DB::table('pgl_rates')->take(10000);
        if($searchQuery!=''){
         $pagination=20000;
        $shippingrate->where(function($q) use($requestData, $searchQuery) {
                        foreach ($requestData as $field)
                           $q->orWhere($field, 'like', "%{$searchQuery}%");
                });
        }
       $shippingrates=$shippingrate->orderBy('id','desc')->paginate($pagination); 
        return view('customer.rate.shipping_rate_data',compact('shippingrates'))->render();
      }
    }

    public function paginate_shipping_rate(Request $request)
    {
        $paginate=20;
        if($request['paginate']){
          $paginate= $request['paginate'];
        }
        if($request->ajax()){
         $shippingrates=DB::table('pgl_rates')->take(10000)
        ->paginate($paginate); 
        return view('customer.rate.shipping_rate_data',compact('shippingrates','paginate'))->render();
      }
    }

}
