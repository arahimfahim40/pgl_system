<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\ClearLog;
use DB;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExcelExport implements FromCollection,WithHeadings
{
    public function headings():array{
        return[
            'Customer Name',
            'Container Series Number',
            'Consignee Name',
            'IMP Code',
            'BL NO',
            'ContainerNo',
            'ETA',
            'DO Charges',
            'Clearance Status',
            'Clearance Amount',
            'Clear Date',
            'Report Date To PGL',
            'Report By'

        ];
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $ClearLog = ClearLog::select('customers.customer_name as customer_name','container_series_number','customers.consignee','imp_code','containers.bolading_number','containers.container_number','containers.eta_port_discharge','do_charges','clearance_status'
            ,'clearance_amount','clear_date','report_date','users.username as username')
            ->join('customers', 'clear_logs.customer_id', 'customers.id')
            ->join('containers', 'clear_logs.container_id', 'containers.id')
            ->join('users', 'clear_logs.report_by', 'users.id')
            ->get();

        foreach($ClearLog as $ClearLogs){
//            dd($ClearLogs->clearance_status);
            if ($ClearLogs->clearance_status == "Cleared") {
                $ClearLogs->clearance_status = 'cleared';
            }
            elseif ($ClearLogs->clearance_status == "Not_Cleared") {
                //dd('666');
                $ClearLogs->clearance_status = 'Not Cleared';
            }
        }
        $ClearLog->clearance_status = $ClearLogs->clearance_status;
//        dd($ClearLog['clearance_status']);
        return $ClearLog;

    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A1:W1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14);
            },
        ];
    }

}
