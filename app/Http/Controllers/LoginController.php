<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use DB;

// use Illuminate\Support\Facades\Redirect;


class LoginController extends Controller
{
    public function authenticate(Request $request)
    {
        if(Auth::check()){
        Auth::logout();
        return redirect()->intended('/customer_login');
        }
        $data=$request->all();
        $rules=array(        
        'email'=>'required|email',
        'password'=>'required|min:5',
        );
        
        $validation=Validator::make($data,$rules);
        if($validation->fails()){
            return redirect()->back()->withErrors($validation);
        }
        if(Auth::attempt(array('email'=>$data['email'],'password'=>$data['password']))){
             $vehicles=DB::table('vehicles')->where('customer_id',Auth::id())->count();
             $container = DB::table('containers')->select("containers.*","tbl_bases.*","containers.id as id")
                 ->leftJoin('tbl_bases','tbl_bases.container_id','=','containers.id')
                 ->where('customer_id',Auth::id())
                 ->groupBy('containers.id')
                 ->get();
                $containers= count($container);

                $invoice=DB::table('pgl_invoices')->join('companies','pgl_invoices.company_id','companies.id')->join('customers','companies.id','customers.company_id')->where('customers.id',Auth::id())->get();
                        $invoices=count($invoice);

                $messages=DB::table('notifications')
                ->where(['customer_id'=>Auth::id(),'type'=>1])
                ->orderBy('id','desc')
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
        else{
            return redirect()->back()->withErrors("Your Email or Password is Incorrect.");
        }
    }

    function logout()
    {
        if(Auth::check()){
            Auth::logout();
            return redirect()->intended('/customer_login');
        }
        return redirect()->back();
    }
}
