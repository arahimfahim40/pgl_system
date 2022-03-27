<?php 
Route::get('/customer_login', function () {
    // return view('welcome');
    return view('customer/Auth/login');
});
Route::get('/', function () {
    // return view('welcome');
    return view('welcome');
});
Route::post('/authenticate','LoginController@authenticate')->name('authenticate');
// Auth::routes(['register' => false]);
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/dashboard','HomeController@dashboard')->name('dashboard');
Route::get('/shipment_summary_customer','HomeController@shipment_summary')->name('shipment_summary_customer');
Route::get('/vehicle_summary_customer','HomeController@vehicle_summary')->name('vehicle_summary_customer');
Route::get('/veh_ship_inv_total', 'HomeController@veh_ship_inv_total')->name('veh_ship_inv_total_customer');
Route::get('/message','HomeController@message')->name('message_customer');

// all vehicle section
Route::get('/all_vehicles','VehicleControllerCustomer@all_vehicles')->name('all_vehicle_customer');
Route::get('/all_vehicles_data','VehicleControllerCustomer@all_vehicles_data')->name('all_vehicle_data_customer');
Route::get('/search_all_vehicle','VehicleControllerCustomer@search_all_vehicle')->name('search_all_vehicle_customer');
Route::get('/paginate_all_vehicle','VehicleControllerCustomer@paginate_all_vehicle')->name('paginate_all_vehicle_customer');
Route::get('/paginate_entry_all_vehicle','VehicleControllerCustomer@paginate_entry_all_vehicle')->name('paginate_entry_all_vehicle_customer');

// on the way vehicle section
Route::get('/on_theway_vehicles','VehicleControllerCustomer@on_theway_vehicles')->name('on_theway_vehicle_customer');
Route::get('/on_theway_vehicles_data','VehicleControllerCustomer@on_theway_vehicles_data')->name('on_theway_vehicle_data_customer');
Route::get('/search_on_theway_vehicle','VehicleControllerCustomer@search_on_theway_vehicle')->name('search_on_theway_vehicle_customer');
Route::get('/paginate_on_theway_vehicle','VehicleControllerCustomer@paginate_on_theway_vehicle')->name('paginate_on_theway_vehicle_customer');
Route::get('/paginate_entry_on_theway_vehicle','VehicleControllerCustomer@paginate_entry_on_theway_vehicle')->name('paginate_entry_on_theway_vehicle_customer');

// pending vehicle section
Route::get('/pending_vehicles','VehicleControllerCustomer@pending_vehicles')->name('pending_vehicle_customer');
Route::get('/pending_vehicles_data','VehicleControllerCustomer@pending_vehicles_data')->name('pending_vehicle_data_customer');
Route::get('/search_pending_vehicle','VehicleControllerCustomer@search_pending_vehicle')->name('search_pending_vehicle_customer');
Route::get('/paginate_pending_vehicle','VehicleControllerCustomer@paginate_pending_vehicle')->name('paginate_pending_vehicle_customer');
Route::get('/paginate_entry_pending_vehicle','VehicleControllerCustomer@paginate_entry_pending_vehicle')->name('paginate_entry_pending_vehicle_customer');

// on hand no title vehicle section
Route::get('/onhand_notitle_vehicles','VehicleControllerCustomer@onhand_notitle_vehicles')->name('onhand_notitle_vehicle_customer');
Route::get('/onhand_notitle_vehicles_data','VehicleControllerCustomer@onhand_notitle_vehicles_data')->name('onhand_notitle_vehicle_data_customer');
Route::get('/search_onhand_notitle_vehicle','VehicleControllerCustomer@search_onhand_notitle_vehicle')->name('search_onhand_notitle_vehicle_customer');
Route::get('/paginate_onhand_notitle_vehicle','VehicleControllerCustomer@paginate_onhand_notitle_vehicle')->name('paginate_onhand_notitle_vehicle_customer');
Route::get('/paginate_entry_onhand_notitle_vehicle','VehicleControllerCustomer@paginate_entry_onhand_notitle_vehicle')->name('paginate_entry_onhand_notitle_vehicle_customer');

// on hand with title vehicle section
Route::get('/onhand_withtitle_vehicles','VehicleControllerCustomer@onhand_withtitle_vehicles')->name('onhand_withtitle_vehicle_customer');
Route::get('/onhand_withtitle_vehicles_data','VehicleControllerCustomer@onhand_withtitle_vehicles_data')->name('onhand_withtitle_vehicle_data_customer');
Route::get('/search_onhand_withtitle_vehicle','VehicleControllerCustomer@search_onhand_withtitle_vehicle')->name('search_onhand_withtitle_vehicle_customer');
Route::get('/paginate_onhand_withtitle_vehicle','VehicleControllerCustomer@paginate_onhand_withtitle_vehicle')->name('paginate_onhand_withtitle_vehicle_customer');
Route::get('/paginate_entry_onhand_withtitle_vehicle','VehicleControllerCustomer@paginate_entry_onhand_withtitle_vehicle')->name('paginate_entry_onhand_withtitle_vehicle_customer');

// shipped vehicle section
Route::get('/shipped_vehicles','VehicleControllerCustomer@shipped_vehicles')->name('shipped_vehicle_customer');
Route::get('/shipped_vehicles_data','VehicleControllerCustomer@shipped_vehicles_data')->name('shipped_vehicle_data_customer');
Route::get('/search_shipped_vehicle','VehicleControllerCustomer@search_shipped_vehicle')->name('search_shipped_vehicle_customer');
Route::get('/paginate_shipped_vehicle','VehicleControllerCustomer@paginate_shipped_vehicle')->name('paginate_shipped_vehicle_customer');
Route::get('/paginate_entry_shipped_vehicle','VehicleControllerCustomer@paginate_entry_shipped_vehicle')->name('paginate_entry_shipped_vehicle_customer');

// find vehicle base on location and status
Route::get('/vehicle_base_location_and_status_customer/{location_id}/{status}','VehicleControllerCustomer@vehicle_base_location_and_status')->name('vehicle_base_location_and_status_customer');
Route::get('/vehicle_base_location_and_status_search','VehicleControllerCustomer@vehicle_base_location_and_status_search')->name('vehicle_base_location_and_status_search_customer');
Route::get('/paginate_entry_vehicle_base_location_and_status','VehicleControllerCustomer@paginate_entry_vehicle_base_location_and_status')->name('paginate_entry_vehicle_base_location_and_status_customer');

// cost analysis section 
Route::get('/vehicles_cost_anylysis','VehicleControllerCustomer@vehicle_cost_analysis')->name('vehicle_cost_analysis_customer');
Route::get('/vehicle_cost_analysis_data','VehicleControllerCustomer@vehicle_cost_analysis_data')->name('vehicle_cost_analysis_data_customer');
Route::get('/search_vehicle_cost_analysis','VehicleControllerCustomer@search_vehicle_cost_analysis')->name('search_vehicle_cost_analysis_customer');
Route::get('/paginate_vehicle_cost_analysis','VehicleControllerCustomer@paginate_vehicle_cost_analysis')->name('paginate_vehicle_cost_analysis_customer');


//  vehicle dateline section
Route::get('/dateline_vehicles','VehicleControllerCustomer@dateline_vehicles')->name('dateline_vehicle_customer');
Route::get('/dateline_vehicles_data','VehicleControllerCustomer@dateline_vehicles_data')->name('dateline_vehicle_data_customer');
Route::get('/search_dateline_vehicle','VehicleControllerCustomer@search_dateline_vehicle')->name('search_dateline_vehicle_customer');
Route::get('/paginate_dateline_vehicle','VehicleControllerCustomer@paginate_dateline_vehicle')->name('paginate_dateline_vehicle_customer');
Route::get('/paginate_entry_dateline_vehicle','VehicleControllerCustomer@paginate_entry_dateline_vehicle')->name('paginate_entry_dateline_vehicle_customer');

// add note for vehicle customer 
 Route::get('addnote_for_vehicle','VehicleControllerCustomer@addnote_for_vehicle')->name('addnote_for_vehicle_customer');
 //  view vehicle photo form google drive
 Route::get('/vehicle_photo/{id}','VehicleControllerCustomer@vehicle_photo')->name('vehicle_photo_customer');

 Route::get('/vehicle_pdf','VehicleControllerCustomer@vehicle_pdf')->name('vehicle_pdf_customer');
 Route::get('/vehicle_excel/','DataExportController@export')->name('vehicle_excel_customer');

 // vehicle condational report
 Route::get('vehicle_condational_report/{id}','VehicleControllerCustomer@vehicle_condational_report')->name('vehicle_condational_report_customer');


// Shipment section 
Route::get('/shipment/{id}','ShipmentControllerCustomer@view_shipment')->name('shipment_customer');
Route::get('/all_shipment_data','ShipmentControllerCustomer@all_shipment_data')->name('all_shipment_data_customer');
Route::get('/search_all_shipment','ShipmentControllerCustomer@search_all_shipment')->name('search_all_shipment_customer');
Route::get('/paginate_all_shipment','ShipmentControllerCustomer@paginate_all_shipment')->name('paginate_all_shipment_customer');

Route::get('/shipment_base_location_and_status_customer/{location}/{status}','ShipmentControllerCustomer@shipment_base_location_and_status')->name('shipment_base_location_and_status_customer');
Route::get('/shipment_base_location_and_status_search','ShipmentControllerCustomer@shipment_base_location_and_status_search')->name('shipment_base_location_and_status_search_customer');
Route::get('/paginate_shipment_base_location_and_status','ShipmentControllerCustomer@paginate_shipment_base_location_and_status')->name('paginate_shipment_base_location_and_status_customer');

// Invoices section 
Route::get('/invoice/{id}','InvoiceControllerCustomer@view_invoice')->name('invoice_customer');
Route::get('/invoice_data','InvoiceControllerCustomer@invoice_data')->name('invoice_data_customer');
Route::get('/search_invoice','InvoiceControllerCustomer@search_invoice')->name('search_invoice_customer');
Route::get('/paginate_invoice','InvoiceControllerCustomer@paginate_invoice')->name('paginate_invoice_customer');
Route::get('/invoices_pdf/{id}','InvoiceControllerCustomer@invoice_pdf')->name('invoice_pdf_customer');


 // Twoing rate section 
Route::get('/towing_rate','RateControllerCustomer@view_towing_rate')->name('towing_rate_customer');
Route::get('/towing_rate_data','RateControllerCustomer@towing_rate_data')->name('towing_rate_data_customer');
Route::get('/search_towing_rate','RateControllerCustomer@search_towing_rate')->name('search_towing_rate_customer');
Route::get('/paginate_towing_rate','RateControllerCustomer@paginate_towing_rate')->name('paginate_towing_rate_customer');

// Shipping rate section 
Route::get('/shipping_rate','RateControllerCustomer@view_shipping_rate')->name('shipping_rate_customer');
Route::get('/shipping_rate_data','RateControllerCustomer@shipping_rate_data')->name('shipping_rate_data_customer');
Route::get('/search_shipping_rate','RateControllerCustomer@search_shipping_rate')->name('search_shipping_rate_customer');
Route::get('/paginate_shipping_rate','RateControllerCustomer@paginate_shipping_rate')->name('paginate_shipping_rate_customer');

// shipment bol
Route::get('/bol/{id}','ShipmentControllerCustomer@bol')->name('bol_customer');
Route::get('/bol_pdf/{id}','ShipmentControllerCustomer@bol_pdf')->name('bol_pdf_customer');
Route::get('/dock_recepit/{id}','ShipmentControllerCustomer@dock_recepit')->name('dock_recepit_customer');



// message section 
Route::get('/messages','MessageControllerCustomer@view_message')->name('messages_customer');
Route::get('/compose_message','MessageControllerCustomer@compose_message')->name('compose_message_customer');
Route::get('/message_detail/{id}','MessageControllerCustomer@message_detail')->name('message_detail_customer');


Route::get('/logout','LoginController@logout')->name('logout');


// route to link an image outside the root folder
Route::get('/images/{file}', [ function ($file) {
    $path = base_path('../pgl/public/assets/images/customer/'.$file);
    if (file_exists($path)) {
        return response()->file($path, array('Content-Type' =>'image/jpeg'));
    }
    abort(404);
}])->name('profile.customer');


// route to vehicle auction invoice 
Route::get('/auction_inv_file/{file}', [ function ($file) {
    $path = base_path('../pgl/public/assets/file/'.$file);
    if (file_exists($path)) {
        return response()->file($path, array('Content-Type' =>'application/pdf'));
    }
    abort(404);
}])->name('auction_ivn_file.customer');

 ?>