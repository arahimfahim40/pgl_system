<?php

namespace App\Http\Controllers\admin;

use App\CustomerModel;
use App\ClearLog;
use App\Http\Controllers\Controller;
use App\LogInvoices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ExcelExport;
use PDF;
use DB;
use Image;
use Carbon\Carbon;

//use Rap2hpoutre\FastExcel\FastExcel;
use Illuminate\Support\Facades\Validator;


class ClearLogController extends Controller
{
    protected $clearLog;

    public function __construct(ClearLog $clearLog)
    {
        $this->middleware('auth:admin');
        $this->clearLog = $clearLog;
    }

    // company section
    public function index()
    {
        if (!auth()->guard('admin')->user()->hasPermissions(['Admin', 'log-management']))
            return view('admin.error.403');

        $customers = DB::table('customers')->select('id', 'customer_name', 'consignee')->get();// in use
        $containers = DB::table('containers')->where('status', 2)->select('id', 'container_number', 'bolading_number', 'eta_port_discharge')->get(); // in use
        $companies = DB::table('companies')->get();
        $locations = DB::table('locations')->get();
        $users = DB::table('users')->get();
        // die($containers);
        $clearLog = ClearLog::with('getLogInvoice:id,log_id,custom_duty,port_handling,vcc,transporter_charges,e_token,local_service_charges,bill_of_entry,other_charges,vcc_charges,single_vcc_charges,wash_fine_charges,repairing_cost_charges,export_services_fees,detention_charges,demurrage_charges,inspection_charges,deliver_order_charges,delivery_order_fee,terminal_handling_charges', 'container:id,container_number,bolading_number,eta_port_discharge', 'getCompany:id,name', 'getCustomer:id,customer_name,consignee')
            ->orderBy('id', 'desc') //->get();
            ->paginate(20);
        return view('admin.operation.clear-log.index', ['clearLog' => $clearLog, 'users' => $users, 'paginate' => 20, 'containers' => $containers, 'companies' => $companies, 'customers' => $customers, 'locations' => $locations]);
    }

    public function paginate_clearLog(Request $request)
    {
        $paginate = 20;
        if ($request['paginate']) {
            $paginate = $request['paginate'];
        }
        if ($request->ajax()) {
            $clearLog = ClearLog::orderBy('id', 'desc')->paginate($paginate);
            return view('admin.operation.clear-log.index', compact('clearLog', 'paginate'))->render();
        }
    }

    public function delete_clear_log($id = '')
    {
        if (ClearLog::where('id', $id)->delete()) {
            return redirect()->back()->with('success', 'Deleted successfully');
        } else {
            return redirect()->back()->with('Error', 'Sorry,did not  delete');
        }
    }

    public function add_clear_log(Request $request)
    {
        if (!auth()->guard('admin')->user()->hasPermissions(['Admin', 'add-log']))
            return view('admin.error.403');

        $users = DB::table('users')->get();
        // $container_id=ClearLog::with('container')
        //                                 ->where('status',2)->get();
        // dd($container_id);
        $authid = Auth::user();

        $ClearLog = new ClearLog();
        $ClearLog->container_series_number = $request->container_series_number;
        $ClearLog->customer_id = $request->customer_id;
        $ClearLog->imp_code = $request->imp_code ?? "";
        $ClearLog->container_id = $request->container_id ?? "";
        $ClearLog->do_charges = $request->do_charges ?? "";
        $ClearLog->clearance_status = $request->clearance_status ?? "";
        $ClearLog->clearance_amount = $request->clearance_amount ?? "";
        $ClearLog->clear_date = Date("Y-m-d", strtotime($request->clear_date)) ?? "";
        $ClearLog->other_charges = $request->other_charges ?? "";
        $ClearLog->transporter_in_charge = $request->transporter_in_charge ?? "";
        $ClearLog->pull_out = $request->pull_out ?? "";
        $ClearLog->deposit = $request->deposit ?? "";
        $ClearLog->report_date = Carbon::now();
        $ClearLog->report_by = $authid->id;


        $ClearLog->save();
        return redirect()->back()->with('success', 'saved!');
    }

    public function edit_clear_log(Request $request)
    {

        if (!auth()->guard('admin')->user()->hasPermissions(['Admin', 'edit-log']))
            return view('admin.error.403');

        $users = DB::table('users')->get();
        //$customers =DB::table('customers')->select('customer_name','consignee')->get();// in use

        $authid = Auth::user();

        $ClearLog = ClearLog::where('id', $request->id)->first();
        $ClearLog->container_series_number = $request->container_series_number;
        $ClearLog->customer_id = $request->customer_id;
        $ClearLog->imp_code = $request->imp_code ?? "";
//        $ClearLog->container_id = $request->container_id  ?? "";
        $ClearLog->do_charges = $request->do_charges ?? "";
        $ClearLog->clearance_status = $request->clearance_status ?? "";
        $ClearLog->clearance_amount = $request->clearance_amount ?? "";
        $ClearLog->clear_date = Date("Y-m-d", strtotime($request->clear_date)) ?? "";
        $ClearLog->other_charges = $request->other_charges ?? "";
        $ClearLog->transporter_in_charge = $request->transporter_in_charge ?? "";
        $ClearLog->pull_out = $request->pull_out ?? "";
        $ClearLog->deposit = $request->deposit ?? "";
        $ClearLog->report_date = Carbon::now();
        $ClearLog->report_by = $authid->id;
        $ClearLog->save();
        return redirect()->back()->with('success', 'updated!');
    }

    public function search_clear_log(Request $request)
    {
        $pagination = 20;
        $searchQuery = trim($request['searchValue']);
        $requestData = ['consignee_name', 'customer_name', 'container_id'];
        if ($request->ajax()) {
            $clearLog = DB::table('clear_logs');
            if ($request['searchValue'] != '') {
                $pagination = 20000;
                $clearLog->where(function ($q) use ($requestData, $searchQuery) {
                    foreach ($requestData as $field)
                        $q->orWhere($field, 'like', "%{$searchQuery}%");
                });
            }
            $clearLog = $clearLog->orderBy('id', 'desc')->paginate($pagination);
            return view('admin.operation.clear-log.index', compact('clearLog'))->render();
        }
    }

    public function clearance_status(Request $request, $id)
    {
        $ClearLog = ClearLog::find($id);

        if ($ClearLog->clearance_status == "Cleared") {
            $ClearLog->where('id', $id)->update(['clearance_status' => 'Not_Cleared']);
            return response()->json(['success' => true]);

//            return redirect()->back()->with('success','Successfully Changed Status');
        } elseif ($ClearLog->clearance_status == "Not_Cleared") {
            $ClearLog->where('id', $id)->update(['clearance_status' => 'Cleared']);
            return response()->json(['success' => true]);
//            return redirect()->back()->with('success','Successfully Changed Status');
        }
    }

    public function clearLog_excel()
    {
        return Excel::download(new ExcelExport, 'clearLog.xlsx');
    }

}
