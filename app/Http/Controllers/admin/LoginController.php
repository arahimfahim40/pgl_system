<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use DB;
use Auth;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');  
    }

    public function login(Request $request) {
        $data = $request->All();
        $rules = array(
            'email' => 'required|email',
            'password' => 'required|min:5'
        );
        $validation = Validator::make($data, $rules);
        if ($validation->fails()) {
            return back()->withErrors($validation);
        }

        // if ($row = DB::table('users')->where('email', $data['email'])->first()) {
        //     if(password_verify($data['password'],$row->password)){
        //         session(['access'=>$row->id,'id'=>$row->id,'username'=>$row->username,'photo'=>$row->photo]);

                if(Auth::guard('admin')->attempt(['email'=>$request['email'],'password'=>$request['password']])) {

                $locations=DB::table('locations')->get();
                $vehicles=DB::table('vehicles')->count();
                $containers = DB::table('containers')->count();
                // $containers= count($container);
                $invoices=DB::table('pgl_invoices')->count();
                 $customers=DB::table('customers')->count();

                $messages=DB::table('notifications')
                ->where(['admin_id'=>session('id'),'type'=>0])
                ->orderBy('id','desc')
                ->paginate(30);

                return view('admin.dashboard.dashboard')->with(['locations',$locations,'vehicles'=>$vehicles,'containers'=>$containers,'invoices'=>$invoices,'customers'=>$customers,'messages'=>$messages]);
            }
            else{
                return redirect()->back()->withErrors("Your Email or Password is Incorrect.");
            }
        
       return redirect()->back()->withErrors("Your Email or Password is Incorrect.");
    }
 
    function logout()
    {
        if(Auth::guard('admin')->check()){
            Auth::guard('admin')->logout();
            return redirect()->intended('/admin_login');
        }
        return redirect()->back();
    }
}
