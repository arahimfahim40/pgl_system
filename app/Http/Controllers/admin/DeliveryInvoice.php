<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeliveryInvoice extends Model
{
    protected $table='delivery_charge_invoice';
    protected $fillable = [
        'id','container_id','customer_id','delivery_charges','status'
    ];
    public function container () {
        return $this->belongsTo('App\ShipmentModel','container_id','id');
    }
    public function getCustomer () {
        return $this->hasOne('App\Customer','id','customer_id');
    }
//    public function getCustomers () {
//        return $this->hasMany('App\Customer','id','customer_id');
//    }
}
