<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\RateModel;
use App\Pgl_rates;
use DB;

class RateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');  
    }

    public function view_towing_rate()
    {
        if(!auth()->guard('admin')->user()->hasPermissions(['Admin','rates-management']))
            return view('admin.error.403');

        $towingrates = RateModel::take(10000)->paginate(20);
        return view('admin.rate.towing_rate',['towingrates' => $towingrates,'paginate'=>20]);
    }

    public function search_towing_rate(Request $request)
    {
        $pagination=20;
        $searchQuery = trim($request['searchValue']);
        $requestData = ['city','branch','state'];
        if($request->ajax()){
       $towingrate=RateModel::take(10000);
        if($searchQuery!=''){
         $pagination=20000;
        $towingrate->where(function($q) use($requestData, $searchQuery) {
                        foreach ($requestData as $field)
                           $q->orWhere($field, 'like', "%{$searchQuery}%");
                });
        }
       $towingrates=$towingrate->orderBy('id','desc')->paginate($pagination); 
        return view('admin.rate.towing_rate_data',compact('towingrates'))->render();
      }
    }

    public function paginate_towing_rate(Request $request)
    {
        $paginate=20;
        if($request['paginate']){
          $paginate= $request['paginate'];
        }
        if($request->ajax()){
        $towingrates=RateModel::take(10000)
        ->paginate($paginate); 
        return view('admin.rate.towing_rate_data',compact('towingrates','paginate'))->render();
      }
    }

    public function add_update_towing_rate(Request $request)
    {
        if(!auth()->guard('admin')->user()->hasPermissions(['Admin','add-tow-rate']))
            return view('admin.error.403');

        if($request['id']){
        $towing_rate = RateModel::find($request['id']);
        }
        else{
            $towing_rate = new RateModel();
        }
        $towing_rate->state = $request['state'];
        $towing_rate->branch = $request['branch'];
        $towing_rate->city = $request['city'];
        $towing_rate->towing_cost = $request['towing_cost'];
        $towing_rate->change_date = $request['change_date'];
        $towing_rate->new_cost = $request['new_price'];
        $towing_rate->note = $request['note'];
        $towing_rate->save();
        return redirect()->back()->with('success', 'Updates successfully !');
    }

    public function delete_towing_rate($id='')
    {
        $delete_tow_rate=RateModel::find($id);
        $delete_tow_rate->delete();
        return redirect()->back()->with('success','Tow rate successfully deleted !');
        
    }

    // shipping rate section
    public function view_shipping_rate()
    {
        $shippingrates = DB::table('pgl_rates')->take(10000)->paginate(20);
        return view('admin.rate.shipping_rate',['shippingrates' => $shippingrates,'paginate'=>20]);
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
        return view('admin.rate.shipping_rate_data',compact('shippingrates'))->render();
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
        return view('admin.rate.shipping_rate_data',compact('shippingrates','paginate'))->render();
      }
    }

    public function add_shipping_rate(Request $request)
    {
        if(!auth()->guard('admin')->user()->hasPermissions(['Admin','add-ship-rate']))
            return view('admin.error.403');

        $add_pgl_ship_rate = new Pgl_rates();
        $add_pgl_ship_rate->from_port = $request['from_port'];
        $add_pgl_ship_rate->to_port = $request['to_port'];
        $add_pgl_ship_rate->cargo = $request['cargo'];
        $add_pgl_ship_rate->old_price = $request['old_price'];
        $add_pgl_ship_rate->change_date = $request['change_date'];
        $add_pgl_ship_rate->new_price = $request['new_price'];
        $add_pgl_ship_rate->note = $request['note'];
        $add_pgl_ship_rate->save();

        return redirect()->back()->with('success', 'Rate successfully added');
    }

    public function update_shipping_rate(Request $request)
    {
        $edit_pgl_ship_rate = Pgl_rates::find($request['id']);
        $edit_pgl_ship_rate->from_port = $request['from_port'];
        $edit_pgl_ship_rate->to_port = $request['to_port'];
        $edit_pgl_ship_rate->cargo = $request['cargo'];
        $edit_pgl_ship_rate->old_price = $request['old_price'];
        $edit_pgl_ship_rate->change_date = $request['change_date'];
        $edit_pgl_ship_rate->new_price = $request['new_price'];
        $edit_pgl_ship_rate->note = $request['note'];
        $edit_pgl_ship_rate->save();

        return redirect()->back()->with('success', 'Updated successfully ! ');
    }
    public function delete_shipping_rate($id='')
    {
        $delete_ship_rate=Pgl_rates::find($id);
        $delete_ship_rate->delete();
        return redirect()->back()->with('success','Ship rate successfully deleted !');
        
    }

}
