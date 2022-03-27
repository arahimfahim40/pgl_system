<?php

namespace App\Http\Controllers;

use App\InvoiceModel;
use Illuminate\Http\Request;
use DB;
use PDF;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class InvoiceControllerCustomer extends Controller
{
    protected $invoice;
    public function __construct(InvoiceModel $invoice)
    {
        $this->middleware('auth');
        $this->invoice=$invoice;
    }
    
    public function view_invoice($status='')
    {
        if($status==5){
            $status='';
        }
        $invoice=DB::table('pgl_invoices')->select('pgl_invoices.*','pgl_invoices.id as id','containers.container_number as container_number')
        ->join('companies','pgl_invoices.company_id','companies.id')
        ->join('customers','companies.id','customers.company_id')
        ->join('containers','containers.id','pgl_invoices.container_id')
        ->where('customers.id',Auth::id())
        ->orderBy('pgl_invoices.id','desc');
           if($status !=''){
           $invoice->where('pgl_invoices.status',$status);
            } 
          $invoices=$invoice->paginate(20);
           return view('customer.invoice.invoice',['invoices'=>$invoices,'paginate'=>20,'status'=>$status]);
           
    }

    public function search_invoice(Request $request)
    {
       $pagination=20;
       $status = $request['status'];
        $searchQuery = trim($request['searchValue']);
        $requestData = ['containers.container_number','pgl_invoices.inv_number'];
        if($request->ajax()){
        $invoice=DB::table('pgl_invoices')
            ->select('pgl_invoices.*','pgl_invoices.id as id','containers.container_number as container_number')
            ->join('companies','pgl_invoices.company_id','companies.id')
            ->join('customers','companies.id','customers.company_id')
            ->join('containers','containers.id','pgl_invoices.container_id')
            ->where('customers.id',Auth::id())
            ->orderBy('pgl_invoices.id','desc');
            if($status !=''){
                $invoice->where('pgl_invoices.status',$status);
             } 
            if($searchQuery!=''){
                 $pagination=100;
                 $invoice->where(function($q) use($requestData, $searchQuery) {
                    foreach ($requestData as $field)
                    $q->orWhere($field, 'like', "%{$searchQuery}%");
                 });
            }
           $invoices=$invoice->paginate($pagination);
           return view('customer.invoice.invoice_data',['invoices'=>$invoices,'paginate'=>20,'status'=>$status]);
        } 
    }

    public function paginate_invoice(Request $request)
    {
        $pagination=20;
        $status='';
        if($request['paginate']){
          $pagination= $request['paginate'];
        }
        if($request['status']){
          $status= $request['status'];
        }
         if($request->ajax()){
            $invoice=DB::table('pgl_invoices')
            ->select('pgl_invoices.*','pgl_invoices.id as id','containers.container_number as container_number')
            ->join('companies','pgl_invoices.company_id','companies.id')
            ->join('customers','companies.id','customers.company_id')
            ->join('containers','containers.id','pgl_invoices.container_id')
            ->where('customers.id',Auth::id())
            ->orderBy('pgl_invoices.id','desc');
            if($status !=''){
               $invoice->where('pgl_invoices.status',$status);
             } 
            $invoices=$invoice->paginate($pagination);
            return view('customer.invoice.invoice_data',['invoices'=>$invoices,'paginate'=>20,'status'=>$status]);    
        } 
    }

    public function invoice_pdf($id='')
    {
         $pgl_invoice = DB::table('pgl_invoices')->find($id);

          // return PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('customer.invoice.invoice_pdf',['pgl_invoice'=>$pgl_invoice],['format' => ['A4',190,236]])->stream();

        $pdf = PDF::loadView('customer.invoice.invoice_pdf',['pgl_invoice'=>$pgl_invoice],['format' => ['A4',190,236]]);
        return $pdf->download('invoice.pdf');

      
    }


}
