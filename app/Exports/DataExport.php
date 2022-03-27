<?php

namespace App\Exports;
use App\User;
use DB;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class DataExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{
    public $pagination=20;

    function __construct($pagination){
        $this->pagination=$pagination;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
         return DB::table('tbl_bases')
             ->select(
                "vehicles.id",
                 "vehicles.vin",
                  "vehicles.lot_number",
                   "vehicles.title_status",
                    "vehicles.c_remark",
                     "vehicles.purchase_date",
                      "vehicles.deliver_date",
                      "vehicles.year",
                      "vehicles.make",
                      "vehicles.model",
                      "vehicles.color",
                      "vehicles.customer_note",
                "containers.container_number","containers.booking_number","containers.eta_port_discharge","containers.etd_port_loading","locations.location","carstates.type")
            ->join('vehicles','vehicles.id','=','tbl_bases.vehicle_id')
            ->join('containers','containers.id','=','tbl_bases.container_id')
            ->join('locations','locations.id','=','vehicles.ploading')
            ->join('carstates','carstates.id','=','vehicles.carstate_id')
            ->where('vehicles.customer_id',Auth::id())
            ->orderBy('vehicles.id','desc')
            ->paginate($this->pagination);
    }

    public function headings(): array
    {
        return [
            '#',
            'VIN',
            'LOT NUMBER',
            'TITLE STATUS',
            'CUSTOMER REMARK',
            'PURCHASE DATE',
            'DELIVER DATE',
            'YEAR',
            'MAKE',
            'MODEL',
            'COLOR',
            'CUSTOMER NOTE',
            'CONTAINER NO',
            'BOOKING NO',
            'ETA',
            'ETD',
            'LOCATION',
            'CURRENT STATUS'
        ];
    }

    /**
     * @return array
     */
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
