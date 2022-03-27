<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class ClearLog extends Model {

    public function container () {
        return $this->belongsTo('App\ShipmentModel','container_id','id');
    }
    public function createInvoice () {
        return $this->hasOne('App\CreateInvoice','create_invoice_id','id');
    }
    public function getCustomer () {
        return $this->hasOne('App\Customer','id','customer_id');
    }
    public function getContainer () {
        return $this->hasOne('App\ShipmentModel','id','container_id');
    }
    public function getCompany () {
        return $this->hasOne('App\Companies','id','company_id');
    }
    public function getLogInvoice () {
        return $this->hasOne('App\LogInvoices','log_id','id')
        ;
    }
    public function getLogInvoiceAttributeA () {
        return $this->hasOne('App\LogInvoices','log_id','id');
    }
    public function reportedUser() {
        return $this->hasOne('App\User','id','report_by');
    }

    protected $fillable = [
        'container_series_number','customer_id','imp_code','container_id','do_charges','clearance_status','clearance_amount','clear_date','other_charges','transporter_in_charge','pull_out','deposit','report_date','report_by'
    ];
}