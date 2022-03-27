<?php

namespace App\Http\Controllers\admin;


use App\ClearLog;
use App\DeliveryInvoice;
use App\Http\Controllers\Controller;
use App\LogInvoices;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Image;
use PDF;
use URL;
use Yajra\DataTables\DataTables;

//use Rap2hpoutre\FastExcel\FastExcel;

class CreateInvoicesController extends Controller
{
    protected $LogInvoicess;

    public function __construct(LogInvoices $LogInvoicess)
    {
        $this->middleware('auth:admin');
        $this->LogInvoices = $LogInvoicess;
    }

    public function save_invoice(Request $request)
    {

        if (isset($request->id)) {
            $logInvoice = LogInvoices::updateOrCreate(
                [
                    'log_id' => $request->log_id
                ],
                [
                    'custom_duty' => $request->custom_duty,
                    'port_handling' => $request->port_handling,
                    'vcc' => $request->vcc,
                    'transporter_charges' => $request->transporter_charges,
                    'e_token' => $request->e_token,
                    'local_service_charges' => $request->local_service_charges,
                    'bill_of_entry' => $request->bill_of_entry,
                    'other_charges' => $request->other_charges,
                    'vcc_charges' => $request->vcc_charges,
                    'single_vcc_charges' => $request->single_vcc_charges,
                    'wash_fine_charges' => $request->wash_fine_charges,
                    'repairing_cost_charges' => $request->repairing_cost_charges,
                    'export_services_fees' => $request->export_services_fees,
                    'detention_charges' => $request->detention_charges,
                    'demurrage_charges' => $request->demurrage_charges,
                    'inspection_charges' => $request->inspection_charges,
                    'deliver_order_charges' => $request->deliver_order_charges,
                    'delivery_order_fee' => $request->delivery_order_fee,
                    'terminal_handling_charges' => $request->terminal_handling_charges,
                    'status' => '2',
                ]);
            $clearLogdata = ClearLog::where('id', $request->log_id)->first();
            if ($request->deliver_order_charges > 0) {
                $delivery = DeliveryInvoice::updateOrCreate(
                    [
                        'container_id' => $clearLogdata->container_id,
                        'customer_id' => $clearLogdata->customer_id,
                    ],
                    [
                        'delivery_charges' => $request->deliver_order_charges,
                    ]);
            }
            if ($logInvoice) {
                return redirect()->back()->with('success', 'saved!');
            } else {
                return redirect()->back()->with('error', 'Failed!');
            }

        } else {
            $logInvoice = LogInvoices::Create(

                [
                    'log_id' => $request->log_id,
                    'custom_duty' => $request->custom_duty,
                    'port_handling' => $request->port_handling,
                    'vcc' => $request->vcc,
                    'transporter_charges' => $request->transporter_charges,
                    'e_token' => $request->e_token,
                    'local_service_charges' => $request->local_service_charges,
                    'bill_of_entry' => $request->bill_of_entry,
                    'other_charges' => $request->other_charges,
                    'vcc_charges' => $request->vcc_charges,
                    'single_vcc_charges' => $request->single_vcc_charges,
                    'wash_fine_charges' => $request->wash_fine_charges,
                    'repairing_cost_charges' => $request->repairing_cost_charges,
                    'export_services_fees' => $request->export_services_fees,
                    'detention_charges' => $request->detention_charges,
                    'demurrage_charges' => $request->demurrage_charges,
                    'inspection_charges' => $request->inspection_charges,
                    'deliver_order_charges' => $request->deliver_order_charges,
                    'delivery_order_fee' => $request->delivery_order_fee,
                    'terminal_handling_charges' => $request->terminal_handling_charges,
                    'status' => '2',
                ]);
            $clearLogdata = ClearLog::where('id', $request->log_id)->first();
            if ($request->deliver_order_charges > 0) {
                $delivery = DeliveryInvoice::updateOrCreate(
                    [
                        'container_id' => $clearLogdata->container_id,
                        'customer_id' => $clearLogdata->customer_id,
                    ],
                    [
                        'delivery_charges' => $request->deliver_order_charges,
                    ]);
            }
            if ($logInvoice) {
                return redirect('/create_invoice_list')->with('success', 'saved!');
            } else {
                return redirect()->back()->with('error', 'Failed!');
            }

        }

    }

    public function deliveryInvoice(Request $request)
    {

        $delivery = new DeliveryInvoice();

        $delivery->container_id = $request->container_id;
        $delivery->customer_id = $request->customer_id;
        $delivery->delivery_charges = $request->delivery_charges;
        $delivery->status = 2;

        $delivery->save();

        if ($delivery) {
            return redirect('/create_invoice_list')->with('success', 'saved!');
        } else {
            return redirect()->back()->with('error', 'Failed!');
        }


    }

    public function edit_invoice(Request $request)
    {

        if (!auth()->guard('admin')->user()->hasPermissions(['Admin', 'edit-invoice']))
            return view('admin.error.403');

        $users = DB::table('users')->get();
        //$customers =DB::table('customers')->select('customer_name','consignee')->get();// in use

        $authid = Auth::user();

        $createInvoices = LogInvoices::where('id', $request->id)->first();
        // dd($createInvoices);
        $createInvoices->log_id = $request->log_id;
        $createInvoices->custom_duty = $request->custom_duty;
        $createInvoices->port_handling = $request->port_handling ?? "";
        $createInvoices->vcc = $request->vcc ?? "";
        $createInvoices->transporter_charges = $request->transporter_charges ?? "";
        $createInvoices->e_token = $request->e_token ?? "";
        $createInvoices->local_service_charges = $request->local_service_charges ?? "";
        $createInvoices->bill_of_entry = $request->bill_of_entry ?? "";
        $createInvoices->other_charges = $request->other_charges ?? "";
        $createInvoices->vcc_charges = $request->vcc_charges ?? "";
        $createInvoices->single_vcc_charges = $request->single_vcc_charges ?? "";
        $createInvoices->wash_fine_charges = $request->wash_fine_charges ?? "";
        $createInvoices->repairing_cost_charges = $request->repairing_cost_charges ?? "";
        $createInvoices->export_services_fees = $request->export_services_fees ?? "";
        $createInvoices->detention_charges = $request->detention_charges ?? "";
        $createInvoices->demurrage_charges = $request->demurrage_charges ?? "";
        $createInvoices->inspection_charges = $request->inspection_charges ?? "";
        $createInvoices->deliver_order_charges = $request->deliver_order_charges ?? "";

        $createInvoices->save();
        return redirect()->back()->with('success', 'updated!');
    }

    public function delete_invoice($id = '')
    {
        if (LogInvoices::where('id', $id)->delete()) {
            return redirect()->back()->with('success', 'Deleted successfully');
        } else {
            return redirect()->back()->with('Error', 'Sorry,did not  delete');
        }
    }


    public function createInvoiceList()
    {
        if (!auth()->guard('admin')->user()->hasPermissions(['Admin', 'create-invoice-log']))
            return view('admin.error.403');
        $customers = DB::table('customers')->get(); // in use
        $containers = DB::table('containers')->get(); // in use
        $companies = DB::table('companies')->get();
        $locations = DB::table('locations')->get();
        $users = DB::table('users')->get();

        $clearLog = ClearLog::with('container:id,container_number', 'getCompany:id,name', 'getCustomer:id,customer_name,consignee', 'getLogInvoice:id,log_id,custom_duty,port_handling,vcc,transporter_charges,e_token,local_service_charges,bill_of_entry,other_charges,vcc_charges,single_vcc_charges,wash_fine_charges,repairing_cost_charges,export_services_fees,detention_charges,demurrage_charges,inspection_charges,deliver_order_charges,delivery_order_fee,terminal_handling_charges')
            ->orderBy('id', 'desc') //->get();
            ->paginate(20);

        return view('admin.operation.create-invoice.create_invoice_form', ['clearLog' => $clearLog, 'users' => $users, 'paginate' => 20, 'containers' => $containers, 'companies' => $companies, 'customers' => $customers, 'locations' => $locations]);
    }

    // invoice status section
    public function allInvoiceList($status = '', Request $request)
    {
        $delivery = DeliveryInvoice::with('container:id,container_number,bolading_number,eta_port_discharge', 'getCustomer:id,customer_name,consignee')
            ->when($status == 2, function ($q) use ($status) {
                $q->where('status', 2);
            })
            ->when($status == 3, function ($q) use ($status) {
                $q->where('status', 1);
            })
            ->when($status == 4, function ($q) use ($status) {
                $q->where('status', 3);
            })
            ->when($status == 5, function ($q) use ($status) {
                $q->where('status', 4);
            })->get();
        if (!auth()->guard('admin')->user()->hasPermissions(['Admin', 'finance-management']))
            return view('admin.error.403');
        if ($request->ajax()) {
            if (Str::contains($status, '-delivery')) {
                $status = Str::before($status, '-');

                $delivery = DeliveryInvoice::with('container:id,container_number,bolading_number,eta_port_discharge', 'getCustomer:id,customer_name,consignee')
                    ->when($status == 2, function ($q) use ($status) {
                        $q->where('status', 2);
                    })
                    ->when($status == 3, function ($q) use ($status) {
                        $q->where('status', 1);
                    })
                    ->when($status == 4, function ($q) use ($status) {
                        $q->where('status', 3);
                    })
                    ->when($status == 5, function ($q) use ($status) {
                        $q->where('status', 4);
                    });
                return Datatables::of($delivery)
//                    ->editColumn('name', function ($row) {
//                        return $row->clearLog->getCustomer->customer_name ?? '';
//                    })
                   ->addColumn('pgl_id', function ($row) {
                        return "PGL".str_pad($row->id,4,"0",STR_PAD_LEFT);
                    })
                    ->editColumn('created_at', function ($row) {
                        return $row->getCustomer->customer_name ?? "";
                    })
                    ->editColumn('pdf', function ($row) {
                        return '<a href=' . URL::to('/invoice_pdf1_admin/' . $row->id) . '
                        target="_blank">
                        <i class="fa fa-file-pdf-o fa-2x" style="margin-top: 18px;"
                         aria-hidden="true"></i></a>';
                    })
                    ->editColumn('action', function ($row) {
                        $btn = "";
                        if (Auth::guard('admin')->user()->hasPermissions(['Admin', 'edit-create-invoice'])) {
                            $btn = '<div class="btn-group"><a href="#edit_company/' . $row->id . '" class="btn btn-primary btn-sm btn-circle mt-1"
                               data-toggle="modal">
                               <span class="fa fa-pencil"></span>
                            </a></div>';
                        }
                        if (Auth::guard('admin')->user()->hasPermissions(['Admin', 'delete-create-invoice'])) {
                            $btn .= '<div class="btn-group"><a class="btn btn-warning btn-sm btn-circle mt-1 ml-1"
                               onclick="javascript:return confirm(`Are you sure you want to delete ?`)"
                               href="' . route('delete_invoicefile', $row->id) . '">
                               <span class="fa fa-trash"></span>
                            </a></div>';
                        }
                        return $btn;
                    })
                    ->addColumn('status', function ($row) {
                        if ($row->status == 1) {
                            return "<span style='color:#006400;'>Open Invoice</span>";
                        } else if ($row->status == 2) {
                            return "<span style='color:#FF8C00;'>Pending Invoice</span>";
                        } else if ($row->status == 3) {
                            return "<span style='color:#006400;'>Past Due Invoice</span>";
                        } else if ($row->status == 4) {
                            return "<span style='color:#006400;'>Paid Invoice</span>";
                        }
                    })

                    ->rawColumns(['created_at', 'status', 'pdf', 'action','pgl_id'])
                    ->make(true);
            } else {
                $data = LogInvoices::with('clearLog', 'clearLog.getCustomer')
                    ->when($status == 2, function ($q) use ($status) {
                        $q->where('status', 2);
                    })
                    ->when($status == 3, function ($q) use ($status) {
                        $q->where('status', 1);
                    })
                    ->when($status == 4, function ($q) use ($status) {
                        $q->where('status', 3);
                    })
                    ->when($status == 5, function ($q) use ($status) {
                        $q->where('status', 4);
                    });
                return Datatables::of($data)
                    ->addColumn('pgl_id', function ($row) {
                        return "PGL".str_pad($row->id,4,"0",STR_PAD_LEFT);
                    })
                    ->editColumn('pdf', function ($row) {
                        return '<a href=' . URL::to('/invoice_pdf_admin/' . $row->id) . '
                        target="_blank">
                        <i class="fa fa-file-pdf-o fa-2x" style="margin-top: 18px;"
                         aria-hidden="true"></i></a>';
                    })
                    ->editColumn('action', function ($row) {
                        $btn = "";
                        if (Auth::guard('admin')->user()->hasPermissions(['Admin', 'edit-create-invoice'])) {
                            $btn = '<a href="' . URL::to('/edit_log_invoice/' . $row->id) . '" class="btn invoiceBtn btn-primary btn-sm btn-circle mt-1"
                              >
                               <span class="fa fa-pencil"></span>
                            </a>';
                        }
                        if (Auth::guard('admin')->user()->hasPermissions(['Admin', 'delete-create-invoice'])) {
                            $btn .= '<a class="btn btn-warning btn-sm invoiceBtn btn-sm btn-circle mt-1 ml-1"
                               onclick="javascript:return confirm(`Are you sure you want to delete ?`)"
                               href="' . route('delete_invoicefile', $row->id) . '">
                               <span class="fa fa-trash"></span>
                            </a>';
                        }
                        return $btn;
                    })
                    ->addColumn('status', function ($row) {
                        if ($row->status == 1) {
                            return "<span style='color:#006400;'>Open Invoice</span>";
                        } else if ($row->status == 2) {
                            return "<span style='color:#FF8C00;'>Pending Invoice</span>";
                        } else if ($row->status == 3) {
                            return "<span style='color:#006400;'>Past Due Invoice</span>";
                        } else if ($row->status == 4) {
                            return "<span style='color:#006400;'>Paid Invoice</span>";
                        }
                    })
                  ->editColumn('updated_at', function ($row) {
                            return $row->clearLog->getCustomer->customer_name;
                    })
                    ->rawColumns(['customer_name', 'status', 'pdf', 'action', 'pgl_id'])
                    ->make(true);
            }
        }

        return view('admin.operation.create-invoice.index', ['status' => $status]);
    }


    public function pendingStatus(Request $request, $id)
    {
        $logInvoiceStatus = LogInvoices::find($id);

        if ($logInvoiceStatus->status == 2) {
            $logInvoiceStatus->where('id', $id)->update(['status' => 1]);
            return response()->json(['success' => true]);

        }
    }

    public function deliveryPendingStatus(Request $request, $id)
    {

        $deliveryStatus = DeliveryInvoice::find($id);


        if ($deliveryStatus->status == 2) {
            $deliveryStatus->where('id', $id)->update(['status' => 1]);
            return response()->json(['success' => true]);
        }
    }

    public function change_status_logs(Request $request)
    {
        $ids = $request->ids;
        $delimiters = [',', '"', ','];
        $ids = str_replace($delimiters, $delimiters[0], $ids);
//        dd($ids);
        LogInvoices::whereIn('id', explode(",", $ids))
            ->update(['status' => $request->status]);
        return response()->json(['status' => true, 'message' => 'Status changed Successfully !']);
    }

    public function change_status_delivery(Request $request)
    {
        $ids = $request->ids;
        $delimiters = [',', '"', ','];
        $ids = str_replace($delimiters, $delimiters[0], $ids);
//        dd($ids);
        DeliveryInvoice::whereIn('id', explode(",", $ids))
            ->update(['status' => $request->status]);
        return response()->json(['status' => true, 'message' => 'Status changed Successfully !']);
    }

    public function invoice_list_by_status($status = '')
    {
        if ($status == 1) {
            $createInvoice = LogInvoices::where('status', 1)->orderBy('id', 'desc')->paginate(20);
        } elseif ($status == 2) {
            $createInvoice = LogInvoices::where('status', 2)->orderBy('id', 'desc')->paginate(20);
        }
//        dd($createInvoice);
        return response()->json(['status' => true]);

//        return view('admin.operation.create-invoice.index', ['status'=>$status,'createInvoice' => $createInvoice,'paginate' => 20]);
    }

    public function invoice_Export($status)
    {
        return Excel::download(new InvoiceExport($status), 'invoice.xlsx');
    }

    public function delivery_invoice_export($status)
    {
        return Excel::download(new DeliveryExport($status), 'delivery_invoice.xlsx');
    }


    public function invoice_pdf($id = '')
    {
        $createInvoices = DB::table('log_invoices')->find($id);
        $pdf = PDF::loadView('admin.operation.create-invoice.invoice_pdf_table', ['createInvoices' => $createInvoices], ['format' => ['A4', 190, 236]]);
        return $pdf->download('log_invoices.pdf');

    }

    public function invoice_pdf1($id = '')
    {
        $createInvoices = LogInvoices::with('clearLog.getCustomer', 'clearLog.getContainer')->where('id', $id)->first();
//        dd($createInvoices);
        $pdf = PDF::loadView('admin.operation.create-invoice.invoice_pdf1_table', ['createInvoices' => $createInvoices], ['format' => ['A4', 190, 236]]);
        return $pdf->download('log_invoices.pdf');
    }

    public function invoice_pdf2($id = '')
    {
        $delivery = DeliveryInvoice::with('container:id,container_number,bolading_number,eta_port_discharge,shipper_exporter,place_receipt,port_discharge,vessel_name,voyage_number,poc_cargo_release', 'getCustomer:id,customer_name,consignee,cons_city')->where('id', $id)->first();
//        $createInvoices = DB::table('log_invoices')->find(3);
//        dd($delivery);
        $pdf = PDF::loadView('admin.operation.create-invoice.invoice_pdf_table', ['delivery' => $delivery], ['format' => ['A4', 190, 236]]);
        return $pdf->download('log_invoices.pdf');
    }

    public function customer_due_balance($status = '')
    {
        if ($status == 1) {

            $invoice = DB::table('pgl_invoices')->select('pgl_invoices.*', 'pgl_invoices.id as id', 'containers.container_number as container_number', 'companies.name as company_name', 'customers.customer_name as customer_name')
                ->join('companies', 'pgl_invoices.company_id', 'companies.id')
                ->join('customers', 'pgl_invoices.company_id', 'customers.company_id')
                ->join('containers', 'containers.id', 'pgl_invoices.container_id')
                ->orderBy('pgl_invoices.id', 'desc');
//            $invoice->tosql();
//            dd($invoice);
        }
//        if($status !=''){
//            $invoice->where('pgl_invoices.status',$status);
//        }
        $invoices = $invoice->paginate(20);
        return view('admin.operation.create-invoice.customer_balance_report', ['invoices' => $invoices, 'paginate' => 20, 'status' => $status]);
    }


    public function paginat_clearance_invoices_admin(Request $request)
    {
        $paginate = 20;
        if ($request['paginate']) {
            $paginate = $request['paginate'];
        }
        if ($request->ajax()) {
            $LogInvoices = LogInvoices::orderBy('id', 'desc')->paginate($paginate);
            return view('admin.operation.create-invoice.index', compact('LogInvoices', 'paginate'))->render();
        }
    }

    public function delete_clearance_invoices_admin($id = '')
    {
        if (LogInvoices::where('id', $id)->delete()) {
            return redirect()->back()->with('success', 'Deleted successfully');
        } else {
            return redirect()->back()->with('Error', 'Sorry,did not  delete');
        }
    }

    public function add_clearance_invoices_admin(Request $request)
    {
        // dd($request->all());
        $LogInvoices = new LogInvoices();
        $LogInvoices->clearance_charges = $request->clearance_charges;
        $LogInvoices->clearance_charges = $request->clearance_charges;
        $LogInvoices->log_clear_id = $request->clear_log_id;
        $LogInvoices->transporter_charges = $request->transporter_charges;
        $LogInvoices->other_charges = $request->other_charges;
        $LogInvoices->detention_charges = $request->detention_charges;
        $LogInvoices->demurrage_charges = $request->demurrage_charges;
        $LogInvoices->save();
        return redirect()->back()->with('success', 'saved!');
    }

    public function edit_clearance_invoices_admin(Request $request)
    {
        // dd($request->all());
        $LogInvoices = LogInvoices::where('id', $request->id)->first();
        $LogInvoices->clearance_charges = $request->clearance_charges;
        $LogInvoices->delivery_order_charges = $request->delivery_order_charges;
        $LogInvoices->transporter_charges = $request->transporter_charges;
        $LogInvoices->log_clear_id = $request->clear_log_id;
        $LogInvoices->other_charges = $request->other_charges;
        $LogInvoices->detention_charges = $request->detention_charges;
        $LogInvoices->demurrage_charges = $request->demurrage_charges;
        $LogInvoices->save();
        return redirect()->back()->with('success', 'updated!');
    }

    public function search_clearance_invoices_admin(Request $request)
    {
        $pagination = 20;
        $searchQuery = trim($request['searchValue']);
        $requestData = ['clearance_charges', 'delivery_order_charges', 'transporter_charges', 'detention_charges', 'demurrage_charges'];
        if ($request->ajax()) {
            $LogInvoices = DB::table('clear_invoices');
            if ($request['searchValue'] != '') {
                $pagination = 20000;
                $LogInvoices->where(function ($q) use ($requestData, $searchQuery) {
                    foreach ($requestData as $field)
                        $q->orWhere($field, 'like', "%{$searchQuery}%");
                });
            }
            $LogInvoices = $LogInvoices->orderBy('id', 'desc')->paginate($pagination);
            return view('admin.operation.create-invoice.index', compact('LogInvoices'))->render();
        }
    }


    public function edit_log_invoice(Request $request, $id)
    {

        if (!auth()->guard('admin')->user()->hasPermissions(['Admin', 'edit-invoice']))
            return view('admin.error.403');

        $users = DB::table('users')->get();
        //$customers =DB::table('customers')->select('customer_name','consignee')->get();// in use
        $customers = DB::table('customers')->get(); // in use
        $containers = DB::table('containers')->get(); // in use

        $clearLogs = LogInvoices::with('clearLog.getCustomer', 'clearLog.getContainer')->where('id', $id)->first();

        return view('admin.operation.create-invoice.edit_log_invoice', compact('clearLogs','customers','containers'));
    }

    public function update_log_invoice(Request $request)
    {

        if (isset($request->id)) {
            $logInvoice = LogInvoices::updateOrCreate(
                [
                    'id' => $request->id
                ],
                [
                    'custom_duty' => $request->custom_duty,
                    'port_handling' => $request->port_handling,
                    'vcc' => $request->vcc,
                    'transporter_charges' => $request->transporter_charges,
                    'e_token' => $request->e_token,
                    'local_service_charges' => $request->local_service_charges,
                    'bill_of_entry' => $request->bill_of_entry,
                    'other_charges' => $request->other_charges,
                    'vcc_charges' => $request->vcc_charges,
                    'single_vcc_charges' => $request->single_vcc_charges,
                    'wash_fine_charges' => $request->wash_fine_charges,
                    'repairing_cost_charges' => $request->repairing_cost_charges,
                    'export_services_fees' => $request->export_services_fees,
                    'detention_charges' => $request->detention_charges,
                    'demurrage_charges' => $request->demurrage_charges,
                    'inspection_charges' => $request->inspection_charges,
                    'deliver_order_charges' => $request->deliver_order_charges,
                    'delivery_order_fee' => $request->delivery_order_fee,
                    'terminal_handling_charges' => $request->terminal_handling_charges,
                ]);
            $clearLogdata = ClearLog::where('id', $request->log_id)->first();
            if ($request->deliver_order_charges > 0) {
                $delivery = DeliveryInvoice::updateOrCreate(
                    [
                        'container_id' => $clearLogdata->container_id,
                        'customer_id' => $clearLogdata->customer_id,
                    ],
                    [
                        'delivery_charges' => $request->deliver_order_charges,
                    ]);
            }

            if ($logInvoice) {
                return redirect('/invoices_list_admin/1')->with('success', 'saved!');

            } else {
                return redirect()->back()->with('error', 'Failed!');
            }

        } else {

                return redirect()->back()->with('error', 'Failed!');


        }

    }

}
