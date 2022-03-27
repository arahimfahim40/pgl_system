<?php

namespace App\Http\Controllers\admin;
use App\InvoiceModel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PDF;
use DB;
use Image;

class InvoiceController extends Controller
{
    protected $invoice;
    public function __construct(InvoiceModel $invoice)
    {
        $this->middleware('auth:admin');  
        $this->invoice=$invoice;
    }
    
    public function view_invoice($status='')
    {
         if(!auth()->guard('admin')->user()->hasPermissions(['Admin','invoices-management']))
            return view('admin.error.403');

        if($status==5){
            $status='';
        }
        $invoice=DB::table('pgl_invoices')->select('pgl_invoices.*','pgl_invoices.id as id','containers.container_number as container_number','companies.name as company_name')
        ->join('companies','pgl_invoices.company_id','companies.id')
        ->join('containers','containers.id','pgl_invoices.container_id')
        ->orderBy('pgl_invoices.id','desc');
           if($status !=''){
           $invoice->where('pgl_invoices.status',$status);
            } 
          $invoices=$invoice->paginate(20);
           return view('admin.invoice.invoice',['invoices'=>$invoices,'paginate'=>20,'status'=>$status]);       
    }

    public function search_invoice(Request $request)
    {
       $pagination=20;
       $status = $request['status'];
        $searchQuery = trim($request['searchValue']);
        $requestData = ['containers.container_number','pgl_invoices.inv_number','companies.name'];
        if($request->ajax()){
        $invoice=DB::table('pgl_invoices')
            ->select('pgl_invoices.*','pgl_invoices.id as id','containers.container_number as container_number','companies.name as company_name')
            ->join('companies','pgl_invoices.company_id','companies.id')
            ->join('containers','containers.id','pgl_invoices.container_id')
            ->orderBy('pgl_invoices.id','desc');
            if($status !=''){
                $invoice->where('pgl_invoices.status',$status);
             } 
            if($searchQuery!=''){
                 $pagination=20000;
                 $invoice->where(function($q) use($requestData, $searchQuery) {
                    foreach ($requestData as $field)
                    $q->orWhere($field, 'like', "%{$searchQuery}%");
                 });
            }
           $invoices=$invoice->paginate($pagination);
           return view('admin.invoice.invoice_data',['invoices'=>$invoices,'paginate'=>20,'status'=>$status]);
        } 
    }

    public function paginate_invoice(Request $request)
    {
        $pagination=20;
        $status='';
        if($request['paginate']){
          $pagination= $request['paginate'];
        }
        if($request['status'] !=''){
          $status= $request['status'];
        }
         if($request->ajax()){
            $invoice=DB::table('pgl_invoices')
            ->select('pgl_invoices.*','pgl_invoices.id as id','containers.container_number as container_number','companies.name as company_name')
            ->join('companies','pgl_invoices.company_id','companies.id')
            ->join('containers','containers.id','pgl_invoices.container_id')
            ->orderBy('pgl_invoices.id','desc');
            if($status !=''){
               $invoice->where('pgl_invoices.status',$status);
             } 
            $invoices=$invoice->paginate($pagination);
            return view('admin.invoice.invoice_data',['invoices'=>$invoices,'paginate'=>20,'status'=>$status]);    
        } 
    }
    // the function approve pending invoice
    public function approve_invoice($id='')
    {
        $invoice=InvoiceModel::find($id);
        $invoice->status=0;
        $invoice->update();
        return redirect()->back()->with('success','Successfully Approved Invoice');
    }

    public function add_invoice(Request $request)
    {
         if(!auth()->guard('admin')->user()->hasPermissions(['Admin','add-invoice']))
            return view('admin.error.403');

        $company=DB::table('companies')->get();
        $container=DB::table('containers')->orderBy('id','DESC')->get();
        return view('admin.invoice.add_invoice',['companies'=>$company,'containers'=>$container]);
    }

    public function add_new_invoice(Request $request)
    {
        $add_invoice = new InvoiceModel();
          $find_invoice=DB::table('pgl_invoices')->where('inv_number','=',$request['inv_number'])->first();
         
        if(!empty($find_invoice)){
           return redirect()->back()->with('failed', 'Duplicate Invoice Number');  
        }
        $add_invoice->inv_number = $request['inv_number'];
        $add_invoice->inv_date = $request['inv_date'];
        $add_invoice->purpose = $request['purpose'];
        $add_invoice->inv_due_date = $request['inv_due_date'];
        $add_invoice->company_id = $request['comp'];
        $add_invoice->container_id = $request['cont'];
        $add_invoice->inv_amount = $request['inv_amount'];
        $add_invoice->payment_rece = $request['payment_rece'];
        $add_invoice->rece_date = $request['rece_date'];
        $add_invoice->payment_method = $request['payment_method'];
        $add_invoice->description = $request['description'];
        $add_invoice->status = 4;

        $add_invoice->save();
        // flog('Invoice','Add New Invoice ' ,$request['inv_number']);
        return redirect()->route('invoice_admin','5')->with('success', 'saved');
    }

    public function edit_invoice($id='')
    {
        if(!auth()->guard('admin')->user()->hasPermissions(['Admin','edit-invoice']))
            return view('admin.error.403');

        $invoice=InvoiceModel::find($id);
        $company=DB::table('companies')->get();
        $container=DB::table('containers')->orderBy('id','DESC')->get();
        return view('admin.invoice.edit_invoice')->with(['invoice'=>$invoice,'company'=>$company,'container'=>$container]);
    }

    public function update_invoice(Request $request)
    {
        if(!auth()->guard('admin')->user()->hasPermissions(['Admin','edit-invoice']))
            return view('admin.error.403');

        $invoice_data =['invoice_no'=>$request['inv_number']];
        $update_invoice=InvoiceModel::find($request['id']);

        if(strcmp($request['inv_number'],$update_invoice->inv_number))
        {
            $invoice_data['f_inv_number']=$update_invoice->inv_number;
        }
        if(strcmp($request['inv_date'],$update_invoice->inv_date))
        {
            $invoice_data['f_inv_date']=$update_invoice->inv_date;
        }
        if(strcmp($request['purpose'],$update_invoice->purpose))
        {
            $invoice_data['f_purpose']=$update_invoice->purpose;
        }
        if(strcmp($request['inv_due_date'],$update_invoice->inv_due_date))
        {
            $invoice_data['f_inv_due_date']=$update_invoice->inv_due_date;
        }
        if(strcmp($request['com'],$update_invoice->company_id))
        {
            $invoice_data['f_company_id']=$update_invoice->company_id;
        }
        if(strcmp($request['inv_amount'],$update_invoice->inv_amount))
        {
            $invoice_data['f_inv_amount']=$update_invoice->inv_amount;
        }
        if(strcmp($request['description'],$update_invoice->description))
        {
            $invoice_data['f_description']=$update_invoice->description;
        }
        if(strcmp($request['payment_rece'],$update_invoice->payment_rece))
        {
            $invoice_data['f_payment_rece']=$update_invoice->payment_rece;
        }
        if(strcmp($request['rece_date'],$update_invoice->rece_date))
        {
            $invoice_data['f_rece_date']=$update_invoice->rece_date;
        }
        if(strcmp($request['payment_method'],$update_invoice->payment_method))
        {
            $invoice_data['f_payment_method']=$update_invoice->payment_method;
        }
        if(strcmp($request['cont'],$update_invoice->container_id))
        {
            $invoice_data['f_container_id']=$update_invoice->container_id;
        }
        $update_invoice->inv_number = $request['inv_number'];
        $update_invoice->inv_date = $request['inv_date'];
        $update_invoice->purpose = $request['purpose'];
        $update_invoice->inv_due_date = $request['inv_due_date'];
        $update_invoice->company_id = $request['comp'];
        $update_invoice->container_id = $request['cont'];
        $update_invoice->inv_amount = $request['inv_amount'];
        $update_invoice->description = $request['description'];
        $update_invoice->payment_rece = $request['payment_rece'];
        $update_invoice->rece_date = $request['rece_date'];
        $update_invoice->payment_method = $request['payment_method'];
        if($update_invoice->save()){
            // flog('Invoice','Update Invoice ' ,$request['inv_number']);
        // flog1($invoice_data);
        return redirect()->route('invoice_admin','5')->with('success', 'saved');
        }
        else{
            return redirect()->back()->with('error','Did not updated the invoice');
        }
        
    }

    public function invoice_pdf($id='')
    {
        $pgl_invoice = DB::table('pgl_invoices')->find($id);
        $pdf = PDF::loadView('admin.invoice.invoice_pdf',['pgl_invoice'=>$pgl_invoice],['format' => ['A4',190,236]]);
        return $pdf->download('invoice.pdf'); 
    }

    public function delete_invoice($id='')
    {
        if(!auth()->guard('admin')->user()->hasPermissions(['Admin','delete-invoice']))
            return view('admin.error.403');

        $delete_inovice=InvoiceModel::find($id);
        // flog('Invoice','Delete  Invoice ' ,$delete_pgl_inovice->inv_number);
        if($delete_inovice->delete()){
            return redirect()->back()->with('success','Successfully Deleted');
        }
        else{
             return redirect()->back()->with('error','Not Deleted');
        }
    }

    public function change_status_invoice(Request $request)
    {
        if(!auth()->guard('admin')->user()->hasPermissions(['Admin','add-status']))
            return view('admin.error.403');

        $ids = $request->ids;
         DB::table('pgl_invoices')->whereIn('id',explode(",",$ids))
         ->update(['status' =>$request->status]);
        return response()->json(['status'=>true,'message'=>'Status changed Successfully !']);
    }

    // find an invoice 
   public function check_invoice_number(Request $request)
    {
      $invoice_no=DB::table('pgl_invoices')->where('inv_number',$request['invoice_no'])->exists();
        if($invoice_no) echo true;
        else echo false;
    }

}
