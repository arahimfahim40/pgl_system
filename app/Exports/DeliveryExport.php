<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\LogInvoices;
use App\ClearLog;
use App\DeliveryInvoice;
use DB;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class DeliveryExport  implements FromCollection, WithHeadings
{

    public function __construct($status)
    {
        $this->status = $status;
    }

    public function headings(): array
    {
        return [
            'container',
            'Customer Name	',
            'Delivery Charges',
            'Consignee Name	',
            'Bolading No.',
            'ETA',
        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $delivery = DeliveryInvoice::select('containers.container_number','customers.customer_name','delivery_charges','containers.bolading_number','containers.eta_port_discharge'
        )
            ->join('containers', 'delivery_charge_invoice.container_id', 'containers.id')
            ->join('customers', 'delivery_charge_invoice.customer_id', 'customers.id')
            ->get();

        return  $delivery;
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $cellRange = 'A1:W1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14);
            },
        ];
    }
}
