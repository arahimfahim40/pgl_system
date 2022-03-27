<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\PglModel;
use Illuminate\Http\Request;
use DB;

class PglController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth:admin');  
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PglModel  $pglModel
     * @return \Illuminate\Http\Response
     */
    public function pgl_profile(PglModel $pglModel)
    {
        if(!auth()->guard('admin')->user()->hasPermissions(['Admin','company-management']))
            return view('admin.error.403');

        $pgl_profile=$pglModel->take(1)->first();
        return view('admin.pgl.pgl_profile')->with('comp_profile',$pgl_profile);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PglModel  $pglModel
     * @return \Illuminate\Http\Response
     */
    public function edit(PglModel $pglModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PglModel  $pglModel
     * @return \Illuminate\Http\Response
     */
    public function update_pgl_profile(Request $request, PglModel $pglModel)
    {
         if(!auth()->guard('admin')->user()->hasPermissions(['Admin','edit-company']))
            return view('admin.error.403');

        $update_profile_com = $pglModel->find($request['id']);
        $update_profile_com->name = $request['name'];
        $update_profile_com->street = $request['street'];
        $update_profile_com->city = $request['city'];
        $update_profile_com->state = $request['state'];
        $update_profile_com->zip_code = $request['zip'];
        $update_profile_com->email = $request['email'];
        $update_profile_com->phone = $request['phone'];
        $update_profile_com->fax = $request['fax'];
        $update_profile_com->website = $request['website'];
        $update_profile_com->facebook = $request['facebook'];
        $update_profile_com->bank_name = $request['bname'];
        $update_profile_com->account_name = $request['a_name'];
        $update_profile_com->account_number = $request['a_number'];
        $update_profile_com->aba = $request['aba'];
        $update_profile_com->swift = $request['swift'];
        $update_profile_com->b_street = $request['b_street'];
        $update_profile_com->b_city = $request['b_city'];
        $update_profile_com->b_state = $request['b_state'];
        $update_profile_com->b_zip = $request['b_zip'];
        $update_profile_com->b_country = $request['b_country'];
        $update_profile_com->save();
        // flog('PGL','Edit PGL Profile','Peace Global Logistics');
        return redirect()->back()->with('success', 'save');
    }

    
      // location section 
    public function location()
    {
        $locations=DB::table('locations')
        ->orderBy('id','desc')
        ->paginate(20);
         return view('admin.setting.location',['locations'=>$locations,'paginate'=>20]);
    }

    public function search_location(Request $request)
    {
        $pagination=20;
        $searchQuery = trim($request['searchValue']);
        $requestData = ['locations.location'];
        if($request->ajax()){
       $location=DB::table('locations');  
        if($request['searchValue']!=''){
         $pagination=20000;
        $location->where(function($q) use($requestData, $searchQuery) {
                    foreach ($requestData as $field)
                       $q->orWhere($field, 'like', "%{$searchQuery}%");
            });
        }
       $locations=$location->orderBy('id','desc')->paginate($pagination); 
        return view('admin.setting.location_data',compact('locations'))->render();
      }
    }

    public function paginate_location(Request $request)
    {
        $paginate=20;
        if($request['paginate']){
          $paginate= $request['paginate'];
        }
        if($request->ajax()){
       $locations=DB::table('locations')
       ->orderBy('id','desc')
       ->paginate($paginate); 
        return view('admin.setting.location_data',compact('locations','paginate'))->render();
      }

    }

    function delete_location($id='')
    {
        return redirect()->back()->with('Error','Not delete able');
       if(DB::table('locations')->where('id',$id)->delete()){
        return redirect()->back()->with('success','Deleted successfully');
        }
        else{
            return redirect()->back()->with('Error','Sorry,did not  delete');
        }
    }

    function add_location(Request $request)
    {
        DB::table('locations')->insert(['location'=>$request['location_name']]);
        return redirect()->back()->with('success','Added successfully');
    }

    function edit_location(Request $request)
    {
        DB::table('locations')->where('id',$request['location_id'])->update(['location'=>$request['location_name']]);
        return redirect()->back()->with('success','Updated successfully');
    }

    // Status section 
    public function status()
    {
        $status=DB::table('carstates')
        ->orderBy('id','desc')
        ->paginate(20);
         return view('admin.setting.status',['statuss'=>$status,'paginate'=>20]);
    }

    public function search_status(Request $request)
    {
        $pagination=20;
        $searchQuery = trim($request['searchValue']);
        $requestData = ['carstates.type'];
        if($request->ajax()){
       $status=DB::table('carstates');  
        if($request['searchValue']!=''){
         $pagination=20000;
        $status->where(function($q) use($requestData, $searchQuery) {
                    foreach ($requestData as $field)
                       $q->orWhere($field, 'like', "%{$searchQuery}%");
            });
        }
       $statuss=$status->orderBy('id','desc')->paginate($pagination); 
        return view('admin.setting.status_data',compact('statuss'))->render();
      }
    }

    public function paginate_status(Request $request)
    {
        $paginate=20;
        if($request['paginate']){
          $paginate= $request['paginate'];
        }
        if($request->ajax()){
       $statuss=DB::table('carstates')
       ->orderBy('id','desc')
       ->paginate($paginate); 
        return view('admin.setting.status_data',compact('statuss','paginate'))->render();
      }

    }

    function delete_status($id='')
    {
        return redirect()->back()->with('Error','Not delete able');
       if(DB::table('carstates')->where('id',$id)->delete()){
        return redirect()->back()->with('success','Deleted successfully');
        }
        else{
            return redirect()->back()->with('Error','Sorry,did not  delete');
        }
    }

    function add_status(Request $request)
    {
        DB::table('carstates')->insert(['type'=>$request['status_name']]);
        return redirect()->back()->with('success','Added successfully');
    }

    function edit_status(Request $request)
    {
        DB::table('carstates')->where('id',$request['status_id'])->update(['type'=>$request['status_name']]);
        return redirect()->back()->with('success','Updated successfully');
    }
}
