<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class CreateInvoice extends Model {
	protected $table = 'create_invoices';

	public function clearLog () {
		return $this->belongsTo('App\ClearLog','log_clear_id');
	}
}