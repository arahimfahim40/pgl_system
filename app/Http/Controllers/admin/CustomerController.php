<?php

namespace App\Http\Controllers\admin;

use App\CustomerModel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PDF;
use DB;
use Image;
// use Dompdf\FrameDecorator\Image;

class CustomerController extends Controller
{
    protected $customer;
    public function __construct(CustomerModel $customer)
    {
        $this->middleware('auth:admin');
        $this->customer=$customer;
    }
    // company section 
    public function company()
    {
        if(!auth()->guard('admin')->user()->hasPermissions(['Admin','customer-management']))
            return view('admin.error.403');
        $companies=DB::table('companies')
            ->orderBy('id','desc')
            ->paginate(20);
        return view('admin.customer.company',['companies'=>$companies,'paginate'=>20]);
    }

    public function search_company(Request $request)
    {
        $pagination=20;
        $searchQuery = trim($request['searchValue']);
        $requestData = ['companies.name'];
        if($request->ajax()){
            $company=DB::table('companies');
            if($request['searchValue']!=''){
                $pagination=20000;
                $company->where(function($q) use($requestData, $searchQuery) {
                    foreach ($requestData as $field)
                        $q->orWhere($field, 'like', "%{$searchQuery}%");
                });
            }
            $companies=$company->orderBy('id','desc')->paginate($pagination);
            return view('admin.customer.company_data',compact('companies'))->render();
        }
    }

    public function paginate_company(Request $request)
    {
        $paginate=20;
        if($request['paginate']){
            $paginate= $request['paginate'];
        }
        if($request->ajax()){
            $companies=DB::table('companies')
                ->orderBy('id','desc')
                ->paginate($paginate);
            return view('admin.customer.company_data',compact('companies','paginate'))->render();
        }

    }

    function delete_company($id='')
    {
        if(!auth()->guard('admin')->user()->hasPermissions(['Admin','delete-customer']))
            return view('admin.error.403');

        if( ! auth()->guard('admin')->user()->hasPermissions(['Admin','company-management']))
            return redirect()->back();
        if(DB::table('companies')->where('id',$id)->delete()){
            return redirect()->back()->with('success','Deleted successfully');
        }
        else{
            return redirect()->back()->with('Error','Sorry,did not  delete');
        }
    }

    function add_company(Request $request)
    {
        if(!auth()->guard('admin')->user()->hasPermissions(['Admin','add-customer']))
            return view('admin.error.403');

        DB::table('companies')->insert(['name'=>$request['company_name']]);
        return redirect()->back()->with('success','Added successfully');
    }

    function edit_company(Request $request)
    {
        if(!auth()->guard('admin')->user()->hasPermissions(['Admin','edit-customer']))
            return view('admin.error.403');

        DB::table('companies')->where('id',$request['company_id'])->update(['name'=>$request['company_name']]);
        return redirect()->back()->with('success','Updated successfully');
    }

// Customer section 

    public function customer()
    {
        if(!auth()->guard('admin')->user()->hasPermissions(['Admin','customer-management']))
            return view('admin.error.403');

        $customers=DB::table('customers')
            ->select('customers.*','companies.name')
            ->join('companies','companies.id','=','customers.company_id')
            ->paginate(20);
        return view('admin.customer.customer',['customers'=>$customers,'paginate'=>20]);
    }

    public function search_customer(Request $request)
    {
        $pagination=20;
        $searchQuery = trim($request['searchValue']);
        $requestData = ['customers.customer_name','customers.customer_uniqe_id','companies.name'];
        if($request->ajax()){
            $customer=DB::table('customers')
                ->select('customers.*','companies.name')
                ->join('companies','companies.id','=','customers.company_id');
            if($request['searchValue']!=''){
                $pagination=20000;
                $customer->where(function($q) use($requestData, $searchQuery) {
                    foreach ($requestData as $field)
                        $q->orWhere($field, 'like', "%{$searchQuery}%");
                });
            }
            $customers=$customer->orderBy('id','desc')->paginate($pagination);
            return view('admin.customer.customer_data',compact('customers'))->render();
        }
    }

    public function paginate_customer(Request $request)
    {
        $paginate=20;
        if($request['paginate']){
            $paginate= $request['paginate'];
        }
        if($request->ajax()){
            $customers=DB::table('customers')
                ->select('customers.*','companies.name')
                ->join('companies','companies.id','=','customers.company_id')
                ->paginate($paginate);
            return view('admin.customer.customer_data',compact('customers','paginate'))->render();
        }

    }

    function add_customer(Request $request)
    {
        if(!auth()->guard('admin')->user()->hasPermissions(['Admin','add-customer']))
            return view('admin.error.403');

        if (DB::table('customers')
                ->where('email', $request['email'])
                ->first() || DB::table('customers')
                ->where('customer_uniqe_id', $request['uid'])
                ->first()) {
            return redirect()->back()->with('errors1', 'Email Duplicate')->with('errors2', 'Unique ID Duplicate');
        } else {
            $add_customer = new CustomerModel();
            $add_customer->customer_name = $request['name'];
            $add_customer->company_id = $request['company'];
            $add_customer->customer_address = $request['address'];
            $add_customer->customer_phone = $request['phone'];
            $add_customer->customer_gender = $request['gender'];
            $add_customer->customer_uniqe_id = $request['uid'];
            $add_customer->sec_email = $request['semail'];
            $add_customer->secondry_phone = $request['sphone'];
            $add_customer->note = $request['note'];
            if (!empty($request['sdate'])) {
                $add_customer->customer_since_date = $request['sdate'];
            } else {
                $add_customer->customer_since_date = date('Y-m-d');
            }
            $add_customer->status = $request['status'];
            $add_customer->prefered = $request['pref'];
            $add_customer->email = $request['email'];
            $add_customer->password = bcrypt($request['password']);
            $add_customer->about = $request['description'];
            $add_customer->comp_city = $request['city'];
            $add_customer->zip_code = $request['zip'];
            $add_customer->country = $request['country'];
            $add_customer->consignee = $request['cons'];
            $add_customer->cons_street = $request['cons_street'];
            $add_customer->cons_box = $request['cons_box'];
            $add_customer->cons_city = $request['cons_city'];
            $add_customer->cons_zip_code = $request['cons_zip'];
            $add_customer->cons_country = $request['cons_country'];
            $add_customer->cons_phone = $request['cons_phone'];
            $add_customer->cons_email = $request['cons_email'];
            $add_customer->cons_fax = $request['cons_fax'];
            $add_customer->cons_poc = $request['cons_poc'];
            $add_customer->notify_party = $request['notify_party'];
            $add_customer->notify_street = $request['notify_street'];
            $add_customer->notify_box = $request['notify_box'];
            $add_customer->notify_city = $request['notify_city'];
            $add_customer->notify_state = $request['notify_state'];
            $add_customer->notify_zip = $request['notify_zip'];
            $add_customer->notify_country = $request['notify_country'];
            $add_customer->notify_phone = $request['notify_phone'];
            $add_customer->notify_email = $request['notify_email'];
            $add_customer->notify_fax = $request['notify_fax'];
            $add_customer->notify_poc = $request['notify_poc'];
            if (!empty($request->hasFile('photo'))) {
                if ($request->hasFile('photo')) {
                    $photo = $request->file('photo');
                    $imagename = time() . '.' . $photo->getClientOriginalExtension();
                    $destinationPath = public_path('images/customer');
                    $thumb_img = Image::make($photo->getRealPath())->resize(267, 286);
                    $thumb_img->save($destinationPath . '/' . $imagename, 80);
                    $photo->move($destinationPath, $imagename);
                    $data['photo'] = $imagename;
                }
                $add_customer->photo = $imagename;
            } else {
                $add_customer->photo = '';
            }

            $add_customer->save();
            // flog('Customer','Add New Customer ',$request['name']);
            return redirect()->back()->with('success', 'saved!');
        }

    }

    public function edit_customer($id='')
    {
        if(!auth()->guard('admin')->user()->hasPermissions(['Admin','edit-customer']))
            return view('admin.error.403');

        $customer_find = CustomerModel::find($id);
        return view('admin.customer.edit_customer', ['customer_find' => $customer_find]);
    }

    public function update_customer(Request $request)
    {
        if(!auth()->guard('admin')->user()->hasPermissions(['Admin','edit-customer']))
            return view('admin.error.403');

        $update_customer = CustomerModel::find($request['id']);
        $update_customer->customer_name = $request['name'];
        $update_customer->company_id = $request['company'];
        $update_customer->customer_address = $request['address'];
        $update_customer->customer_phone = $request['phone'];
        $update_customer->customer_gender = $request['gender'];
        $update_customer->customer_uniqe_id = $request['uid'];
        $update_customer->sec_email = $request['semail'];
        $update_customer->secondry_phone = $request['sphone'];
        $update_customer->note = $request['note'];
        $update_customer->customer_since_date = $request['sdate'];
        $update_customer->status = $request['status'];
        $update_customer->prefered = $request['pref'];
        $update_customer->email = $request['email'];
        $update_customer->comp_city = $request['city'];
        $update_customer->zip_code = $request['zip'];
        $update_customer->country = $request['country'];
        $update_customer->consignee = $request['cons'];
        $update_customer->cons_street = $request['cons_street'];
        $update_customer->cons_box = $request['cons_box'];
        $update_customer->cons_city = $request['cons_city'];
        $update_customer->cons_zip_code = $request['cons_zip'];
        $update_customer->cons_country = $request['cons_country'];
        $update_customer->cons_phone = $request['cons_phone'];
        $update_customer->cons_email = $request['cons_email'];
        $update_customer->cons_fax = $request['cons_fax'];
        $update_customer->cons_poc = $request['cons_poc'];
        $update_customer->notify_party = $request['notify_party'];
        $update_customer->notify_street = $request['notify_street'];
        $update_customer->notify_box = $request['notify_box'];
        $update_customer->notify_city = $request['notify_city'];
        $update_customer->notify_state = $request['notify_state'];
        $update_customer->notify_zip = $request['notify_zip'];
        $update_customer->notify_country = $request['notify_country'];
        $update_customer->notify_phone = $request['notify_phone'];
        $update_customer->notify_email = $request['notify_email'];
        $update_customer->notify_fax = $request['notify_fax'];
        $update_customer->notify_poc = $request['notify_poc'];
        if ($request['password']) {
            $update_customer->password = bcrypt($request['password']);
        } else {
            $update_customer->password = $request['old_password'];
        }
        $update_customer->about = $request['description'];
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $imagename = time() . '.' . $photo->getClientOriginalExtension();
            $destinationPath = public_path('images/customer');
            $thumb_img = Image::make($photo->getRealPath())->resize(267, 286);
            $thumb_img->save($destinationPath . '/' . $imagename, 80);
            $photo->move($destinationPath, $imagename);
            $data['photo'] = $imagename;
        }
        if ($request->hasFile('photo')) {
            $update_customer->photo = $imagename;
        } else {
            $update_customer->photo = $request['pname'];
        }
        $oldPhoto = $update_customer->photo;
        if ($oldPhoto !== $update_customer->photo) {
            $this->removecustomersphoto($oldPhoto);
        }
        $update_customer->update();
        // flog('Customer','Update Customer ',$request['name']);
        return redirect()->route('customer_admin')->with('success', 'Successfully Updated!');

    }

    private function removecustomersphoto($photo)
    {
        if (!empty($photo)) {
            $file_path = public_path('/images/customer') . '/' . $photo;

            if (file_exists($file_path)) unlink($file_path);
        }
    }
    // find a customer 
    public function singel_customer(Request $request)
    {
        $customers=DB::table('customers')->select('id','customer_name')->where('company_id',$request['company_id'])->first();

        $data="<option value='$customers->id'>".$customers->customer_name.="</option>";
        echo ($data);
    }

    function delete_customer($id='')
    {
        if(!auth()->guard('admin')->user()->hasPermissions(['Admin','delete-customer']))
            return view('admin.error.403');

        if(DB::table('customers')->where('id',$id)->delete()){
            return redirect()->back()->with('success','Deleted successfully');
        }
        else{
            return redirect()->back()->with('Error','Sorry,did not  delete');
        }
    }
    public function get_customer(Request $request)
    {
        $customers = DB::table('customers')->select('id', 'customer_name', 'consignee')->where('id', $request['customer_id'])->first();
        return response()->json($customers);
        echo $data = $customers->consignee;
        //  echo ($data);
//        $data="<option value='$customers->id'>".$customers->customer_name.="</option>";
//       echo ($data);
    }
    public function get_container(Request $request)
    {
        $customers = DB::table('containers')->select('id', 'bolading_number', 'eta_port_discharge','container_number')->where('id', $request['container_id'])->first();
        return response()->json($customers);

    }

}
