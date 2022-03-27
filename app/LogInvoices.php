<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;


class LogInvoices extends Model
{
    public $table='log_invoices';
    protected $fillable = [
        'id', 'log_id', 'custom_duty', 'port_handling', 'vcc', 'transporter_charges', 'e_token', 'local_service_charges', 'bill_of_entry', 'other_charges', 'vcc_charges', 'single_vcc_charges', 'wash_fine_charges', 'repairing_cost_charges', 'export_services_fees', 'detention_charges', 'demurrage_charges', 'inspection_charges', 'deliver_order_charges', 'delivery_order_fee', 'terminal_handling_charges', 'status', 'created_at', 'updated_at'
    ];
    public function clearLog () {
        return $this->hasOne(ClearLog::class,'id','log_id');
    }

}