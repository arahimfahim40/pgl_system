<?php 


Route::get('/admin_login', function () {
    // return view('welcome');
    return view('admin/auth/login');
});
Route::get('/dashboards','admin\HomeController@dashboard')->name('dashboard_admin');
Route::post('/admin_login','admin\LoginController@login')->name('admin_login');
Route::get('/admin_shipment_summary','admin\HomeController@shipment_summary')->name('shipment_summary_admin');
Route::get('/admin_vehicle_summary','admin\HomeController@vehicle_summary')->name('vehicle_summary_admin');
Route::get('/admin_veh_ship_inv_total', 'admin\HomeController@veh_ship_inv_total')->name('veh_ship_inv_total_admin');
Route::get('/admin_message','admin\HomeController@message')->name('message_admin');
Route::get('/delete_vehicle_admin/{id}','admin\VehicleController@delete_vehicle')->name('delete_vehicle_admin');

// company section 
Route::get('/company_admin','admin\CustomerController@company')->name('company_admin');
Route::get('/company_data_admin','admin\CustomerController@company_data')->name('all_vehicle_data_admin');
Route::get('/search_company','admin\CustomerController@search_company')->name('search_company_admin');
Route::get('/paginat_company_admin','admin\CustomerController@paginate_company')->name('paginate_company_admin');
Route::get('/delete_company_admin/{id}','admin\CustomerController@delete_company')->name('delete_company_admin');

// Route::get('delete_company_admin/{id}', ['as' => 'delete_company_admin',
//                               'uses' => 'admin\CustomerController@delete_company',
//                               'middleware' => 'check:delete-customer']
// );

Route::post('/add_company_admin','admin\CustomerController@add_company')->name('add_company_admin');
Route::post('/edit_company_admin','admin\CustomerController@edit_company')->name('edit_company_admin');

// Customer section 
Route::get('/customer_admin','admin\CustomerController@customer')->name('customer_admin');
Route::get('/customer_data_admin','admin\CustomerController@customer_data')->name('all_vehicle_data_admin');
Route::get('/search_customer','admin\CustomerController@search_customer')->name('search_customer_admin');
Route::get('/paginat_customer_admin','admin\CustomerController@paginate_customer')->name('paginate_customer_admin');
Route::get('/delete_customer_admin/{id}','admin\CustomerController@delete_customer')->name('delete_customer_admin');
Route::post('/add_customer_admin','admin\CustomerController@add_customer')->name('add_customer_admin');
Route::get('/edit_customer_admin/{id}','admin\CustomerController@edit_customer')->name('edit_customer_admin');
Route::post('/update_customer','admin\CustomerController@update_customer')->name('update_customer');
Route::get('/single_customer_admin','admin\CustomerController@singel_customer')->name('single_customer_admin');


// all vehicle section
Route::get('/all_vehicles_admin','admin\VehicleController@all_vehicles')->name('all_vehicle_admin');
Route::get('/all_vehicles_data_admin','admin\VehicleController@all_vehicles_data')->name('all_vehicle_data_admin');
Route::get('/search_all_vehicle_admin','admin\VehicleController@search_all_vehicle')->name('search_all_vehicle_admin');
Route::get('/paginate_all_vehicle_admin','admin\VehicleController@paginate_all_vehicle')->name('paginate_all_vehicle_admin');
Route::get('/paginate_entry_all_vehicle_admin','admin\VehicleController@paginate_entry_all_vehicle')->name('paginate_entry_all_vehicle_admin');

// on the way vehicle section
Route::get('/on_theway_vehicles_admin','admin\VehicleController@on_theway_vehicles')->name('on_theway_vehicle_admin');
Route::get('/on_theway_vehicles_data_admin','admin\VehicleController@on_theway_vehicles_data')->name('on_theway_vehicle_data_admin');
Route::get('/search_on_theway_vehicle_admin','admin\VehicleController@search_on_theway_vehicle')->name('search_on_theway_vehicle_admin');
Route::get('/paginate_on_theway_vehicle_admin','admin\VehicleController@paginate_on_theway_vehicle')->name('paginate_on_theway_vehicle_admin');
Route::get('/paginate_entry_on_theway_vehicle_admin','admin\VehicleController@paginate_entry_on_theway_vehicle')->name('paginate_entry_on_theway_vehicle_admin');

// Pending vehicle section
Route::get('/pending_vehicles_admin','admin\VehicleController@pending_vehicles')->name('pending_vehicle_admin');
Route::get('/pending_vehicles_data_admin','admin\VehicleController@pending_vehicles_data')->name('pending_vehicle_data_admin');
Route::get('/search_pending_vehicle_admin','admin\VehicleController@search_pending_vehicle')->name('search_pending_vehicle_admin');
Route::get('/paginate_pending_vehicle_admin','admin\VehicleController@paginate_pending_vehicle')->name('paginate_pending_vehicle_admin');
Route::get('/paginate_entry_pending_vehicle_admin','admin\VehicleController@paginate_entry_pending_vehicle')->name('paginate_entry_pending_vehicle_admin');

// on the way vehicle section
Route::get('/onhand_notitle_vehicles_admin','admin\VehicleController@onhand_notitle_vehicles')->name('onhand_notitle_vehicle_admin');
Route::get('/onhand_notitle_vehicles_data_admin','admin\VehicleController@onhand_notitle_vehicles_data')->name('onhand_notitle_vehicle_data_admin');
Route::get('/search_onhand_notitle_vehicle_admin','admin\VehicleController@search_onhand_notitle_vehicle')->name('search_onhand_notitle_vehicle_admin');
Route::get('/paginate_onhand_notitle_vehicle_admin','admin\VehicleController@paginate_onhand_notitle_vehicle')->name('paginate_onhand_notitle_vehicle_admin');
Route::get('/paginate_entry_onhand_notitle_vehicle_admin','admin\VehicleController@paginate_entry_onhand_notitle_vehicle')->name('paginate_entry_onhand_notitle_vehicle_admin');

// on the way vehicle section
Route::get('/onhand_withtitle_vehicles_admin','admin\VehicleController@onhand_withtitle_vehicles')->name('onhand_withtitle_vehicle_admin');
Route::get('/onhand_withtitle_vehicles_data_admin','admin\VehicleController@onhand_withtitle_vehicles_data')->name('onhand_withtitle_vehicle_data_admin');
Route::get('/search_onhand_withtitle_vehicle_admin','admin\VehicleController@search_onhand_withtitle_vehicle')->name('search_onhand_withtitle_vehicle_admin');
Route::get('/paginate_onhand_withtitle_vehicle_admin','admin\VehicleController@paginate_onhand_withtitle_vehicle')->name('paginate_onhand_withtitle_vehicle_admin');
Route::get('/paginate_entry_onhand_withtitle_vehicle_admin','admin\VehicleController@paginate_entry_onhand_withtitle_vehicle')->name('paginate_entry_onhand_withtitle_vehicle_admin');


// on the way vehicle section
Route::get('/onhand_withtitle_vehicles_admin','admin\VehicleController@onhand_withtitle_vehicles')->name('onhand_withtitle_vehicle_admin');
Route::get('/onhand_withtitle_vehicles_data_admin','admin\VehicleController@onhand_withtitle_vehicles_data')->name('onhand_withtitle_vehicle_data_admin');
Route::get('/search_onhand_withtitle_vehicle_admin','admin\VehicleController@search_onhand_withtitle_vehicle')->name('search_onhand_withtitle_vehicle_admin');
Route::get('/paginate_onhand_withtitle_vehicle_admin','admin\VehicleController@paginate_onhand_withtitle_vehicle')->name('paginate_onhand_withtitle_vehicle_admin');
Route::get('/paginate_entry_onhand_withtitle_vehicle_admin','admin\VehicleController@paginate_entry_onhand_withtitle_vehicle')->name('paginate_entry_onhand_withtitle_vehicle_admin');

// shipped vehicle section
Route::get('/shipped_vehicles_admin','admin\VehicleController@shipped_vehicles')->name('shipped_vehicle_admin');
Route::get('/shipped_vehicles_data_admin','admin\VehicleController@shipped_vehicles_data')->name('shipped_vehicle_data_admin');
Route::get('/search_shipped_vehicle_admin','admin\VehicleController@search_shipped_vehicle')->name('search_shipped_vehicle_admin');
Route::get('/paginate_shipped_vehicle_admin','admin\VehicleController@paginate_shipped_vehicle')->name('paginate_shipped_vehicle_admin');
Route::get('/paginate_entry_shipped_vehicle_admin','admin\VehicleController@paginate_entry_shipped_vehicle')->name('paginate_entry_shipped_vehicle_admin');

// cost analysis section 
Route::get('/vehicles_cost_anylysis_admin','admin\VehicleController@vehicle_cost_analysis')->name('vehicle_cost_analysis_admin');
Route::get('/vehicle_cost_analysis_data_admin','admin\VehicleController@vehicle_cost_analysis_data')->name('vehicle_cost_analysis_data_admin');
Route::get('/search_vehicle_cost_analysis_admin','admin\VehicleController@search_vehicle_cost_analysis')->name('search_vehicle_cost_analysis_admin');
Route::get('/paginate_vehicle_cost_analysis_admin','admin\VehicleController@paginate_vehicle_cost_analysis')->name('paginate_vehicle_cost_analysis_admin');

    // tow cost report section 
 Route::get('/tow_cost_report_admin','admin\VehicleController@tow_cost_report')->name('tow_cost_report_admin');
Route::get('/tow_cost_report_data_admin','admin\VehicleController@tow_cost_report_data')->name('tow_cost_report_data_admin');
Route::get('/search_tow_cost_report','admin\VehicleController@search_tow_cost_report')->name('search_tow_cost_report_admin');
Route::get('/paginate_tow_cost_report','admin\VehicleController@paginate_tow_cost_report')->name('paginate_tow_cost_report_admin');

//  vehicle dateline section
Route::get('/dateline_vehicles_admin','admin\VehicleController@dateline_vehicles')->name('dateline_vehicle_admin');
Route::get('/dateline_vehicles_data_admin','admin\VehicleController@dateline_vehicles_data')->name('dateline_vehicle_data_admin');
Route::get('/search_dateline_vehicle_admin','admin\VehicleController@search_dateline_vehicle')->name('search_dateline_vehicle_admin');
Route::get('/paginate_dateline_vehicle_admin','admin\VehicleController@paginate_dateline_vehicle')->name('paginate_dateline_vehicle_admin');
Route::get('/paginate_entry_dateline_vehicle_admin','admin\VehicleController@paginate_entry_dateline_vehicle')->name('paginate_entry_dateline_vehicle_admin');
//  view vehicle photo form google drive
 Route::get('/vehicle_photo_admin/{id}','admin\VehicleController@vehicle_photo')->name('vehicle_photo_admin');
// vehicle condational report
 Route::get('vehicle_condational_report_admin/{id}','admin\VehicleController@vehicle_condational_report')->name('vehicle_condational_report_admin');
 // route to vehicle auction invoice 
Route::get('/auction_inv_file_admin/{file}', [ function ($file) {
    $path = base_path('../pgl/public/assets/file/'.$file);
    if (file_exists($path)) {
        return response()->file($path, array('Content-Type' =>'application/pdf'));
    }
    abort(404);
}])->name('auction_ivn_file.admin');

// vehicle summary section 
Route::get('/vehicle_summary','admin\VehicleController@vehicle_summary')->name('vehicle_summary');
Route::get('/vehicle_summary_search/{company_id}/{status}/{location}','admin\VehicleController@vehicle_summary_search')->name('vehicle_summary_search');
// add and edit vehicle
Route::get('/add_vehicle','admin\VehicleController@add_vehicle')->name('add_vehicel');
Route::post('/add_new_vehicle','admin\VehicleController@add_new_vehicle')->name('add_vnew_ehicel');
Route::get('/edit_vehicle/{id}','admin\VehicleController@edit_vehicle')->name('edit_vehicel');
Route::post('/update_vehicle','admin\VehicleController@update_vehicle')->name('update_vehicel');
Route::get('/single_vehicle_vin','admin\VehicleController@singel_vehicle_vin')->name('single_vehicle_vin');

// change vehicle status section 
Route::get('/change_status_vehicle','admin\VehicleController@change_status_vehicle')->name('change_status_vehicle');
Route::get('/change_on_hand_with_title_vehicle_status','admin\VehicleController@change_on_hand_with_title_vehicle_status');
Route::get('/add_to_container','admin\VehicleController@add_to_container')->name('add_to_container');



// Shipment section 
Route::get('/shipment_admin/{id}/{location}','admin\ShipmentController@shipment')->name('shipment_admin');
Route::get('/shipment_data_admin','admin\ShipmentController@shipment_data')->name('shipment_data_admin');
Route::get('/search_shipment','admin\ShipmentController@search_shipment')->name('search_shipment_admin');
Route::get('/paginate_shipment','admin\ShipmentController@paginate_shipment')->name('paginate_shipment_admin');
Route::get('/add_shipment',function(){
    return view('admin.shipment.add_shipment');
});
Route::post('/add_new_shipment','admin\ShipmentController@add_new_shipment');
Route::get('/edit_shipment/{id}','admin\ShipmentController@edit_shipment')->name('edit_shipment');
Route::post('/update_shipment','admin\ShipmentController@update_shipment')->name('update_shipment');
Route::get('/duplicate_shipment/{id}','admin\ShipmentController@duplicate_shipment')->name('duplicate_shipment');
Route::get('delete_shipment/{id}','admin\ShipmentController@delete_shipment')->name('delete_shipment');
// shipment bol and doc
Route::get('/bol_admin/{id}','admin\ShipmentController@bol')->name('bol_admin');
Route::get('/bol_pdf_admin/{id}','admin\ShipmentController@bol_pdf')->name('bol_pdf_admin');
Route::get('/dock_recepit_admin/{id}','admin\ShipmentController@dock_recepit')->name('dock_recepit_admin');
Route::get('/custom_form_admin/{id}','admin\ShipmentController@custom_form')->name('custom_form_admin');
Route::get('/release_document_admin/{id}','admin\ShipmentController@release_document')->name('release_document_admin');
Route::get('/change_status_shipment','admin\ShipmentController@change_status_shipment')->name('change_status_shipment');
Route::get('/shipment_summary','admin\ShipmentController@shipment_summary')->name('shipment_summary');
Route::get('/shipment_summary_search/{company_id}/{status}','admin\ShipmentController@shipment_summary_search')->name('shipment_summary_search');
Route::get('/check_container_number','admin\ShipmentController@check_container_number')->name('check_container_number');
Route::get('update_etd_date','admin\ShipmentController@update_etd_date');
Route::get('update_eta_date','admin\ShipmentController@update_eta_date');

<<<<<<< HEAD
=======
// title archive shipment from savannah with status on loading 
Route::get('/archive_shipment_admin','admin\ShipmentController@archive_shipment')->name('archive_shipment_admin');
Route::get('/archive_shipment_data_admin','admin\ShipmentController@archive_shipment_data')->name('archive_shipment_data_admin');
Route::get('/search_archive_shipment','admin\ShipmentController@search_archive_shipment')->name('search_archive_shipment_admin');
Route::get('/paginate_archive_shipment','admin\ShipmentController@paginate_archive_shipment')->name('paginate_archive_shipment_admin');
Route::post('/add_archive_shipment','admin\ShipmentController@add_archive_shipment')->name('add_archive_shipment');

>>>>>>> parent of affd84d (Cleared the repo)
// Invoices section 
Route::get('/invoice_admin/{id}','admin\InvoiceController@view_invoice')->name('invoice_admin');
Route::get('/invoice_data_admin','admin\InvoiceController@invoice_data')->name('invoice_data_customer');
Route::get('/search_invoice_admin','admin\InvoiceController@search_invoice')->name('search_invoice_admin');
Route::get('/paginate_invoice_admin','admin\InvoiceController@paginate_invoice')->name('paginate_invoice_admin');
Route::get('/invoices_pdf_admin/{id}','admin\InvoiceController@invoice_pdf')->name('invoice_pdf_admin');
Route::get('/add_invoice','admin\InvoiceController@add_invoice')->name('add_invoice_admin');
Route::post('/add_new_invoice','admin\InvoiceController@add_new_invoice')->name('add_new_invoice_admin');
Route::get('/approve_invoice/{id}','admin\InvoiceController@approve_invoice')->name('approve_invoice');
Route::get('/edit_invoice/{id}','admin\InvoiceController@edit_invoice')->name('edit_invoice_admin');
Route::post('/update_invoice','admin\InvoiceController@update_invoice')->name('update_invoice_admin');
Route::get('/delete_invoice/{id}','admin\InvoiceController@delete_invoice')->name('delete_invoice_admin');
Route::get('/change_status_invoice','admin\InvoiceController@change_status_invoice')->name('change_status_invoice');
Route::get('/check_invoice_number','admin\InvoiceController@check_invoice_number')->name('check_invoice_number');

// Shipping rate section 
Route::get('/shipping_rate_admin','admin\RateController@view_shipping_rate')->name('shipping_rate_admin');
Route::get('/shipping_rate_data_admin','admin\RateController@shipping_rate_data')->name('shipping_rate_data_admin');
Route::get('/search_shipping_rate_admin','admin\RateController@search_shipping_rate')->name('search_shipping_rate_admin');
Route::get('/paginate_shipping_rate_admin','admin\RateController@paginate_shipping_rate')->name('paginate_shipping_rate_admin');
Route::post('/add_shipping_rate_admin','admin\RateController@add_shipping_rate')->name('add_shipping_rate_admin');
Route::post('/update_shipping_rate_admin','admin\RateController@update_shipping_rate')->name('update_shipping_rate_admin');
Route::get('/delete_shipping_rate_admin/{id}','admin\RateController@delete_shipping_rate')->name('delete_shipping_rate_admin');


// Twoing rate section 
Route::get('/towing_rate_admin','admin\RateController@view_towing_rate')->name('towing_rate_admin');
Route::get('/towing_rate_data_admin','admin\RateController@towing_rate_data')->name('towing_rate_data_admin');
Route::get('/search_towing_rate_admin','admin\RateController@search_towing_rate')->name('search_towing_rate_admin');
Route::get('/paginate_towing_rate_admin','admin\RateController@paginate_towing_rate')->name('paginate_towing_rate_admin');
Route::post('/add_towing_rate_admin','admin\RateController@add_update_towing_rate')->name('add_towing_rate_admin');
Route::post('/update_towing_rate_admin','admin\RateController@add_update_towing_rate')->name('update_towing_rate_admin');
Route::get('/delete_towing_rate_admin/{id}','admin\RateController@delete_towing_rate')->name('delete_towing_rate_admin');

// Pgl profile section 
Route::get('pgl_profile','admin\PglController@pgl_profile')->name('pgl_profile'); 
Route::post('update_pgl_profile','admin\PglController@update_pgl_profile')->name('update_pgl_profile'); 

// location section 
Route::get('/location_admin','admin\PglController@location')->name('location_admin');
Route::get('/location_data_admin','admin\PglController@location_data')->name('all_vehicle_data_admin');
Route::get('/search_location','admin\PglController@search_location')->name('search_location_admin');
Route::get('/paginat_location_admin','admin\PglController@paginate_location')->name('paginate_location_admin');
Route::get('/delete_location_admin/{id}','admin\PglController@delete_location')->name('delete_location_admin');
Route::post('/add_location_admin','admin\PglController@add_location')->name('add_location_admin');
Route::post('/edit_location_admin','admin\PglController@edit_location')->name('edit_location_admin');

// status section 
Route::get('/status_admin','admin\PglController@status')->name('status_admin');
Route::get('/status_data_admin','admin\PglController@status_data')->name('all_vehicle_data_admin');
Route::get('/search_status','admin\PglController@search_status')->name('search_status_admin');
Route::get('/paginat_status_admin','admin\PglController@paginate_status')->name('paginate_status_admin');
Route::get('/delete_status_admin/{id}','admin\PglController@delete_status')->name('delete_status_admin');
Route::post('/add_status_admin','admin\PglController@add_status')->name('add_status_admin');
Route::post('/edit_status_admin','admin\PglController@edit_status')->name('edit_status_admin');

// user section 
Route::get('/user_admin','admin\UserController@user')->name('user_admin');
Route::get('/user_data_admin','admin\UserController@user_data')->name('all_vehicle_data_admin');
Route::get('/search_user','admin\UserController@search_user')->name('search_user_admin');
Route::get('/paginat_user_admin','admin\UserController@paginate_user')->name('paginate_user_admin');
Route::get('/delete_user_admin/{id}','admin\UserController@delete_user')->name('delete_user_admin');
Route::post('/add_user_admin','admin\UserController@add_user')->name('add_user_admin');
Route::post('/edit_user_admin','admin\UserController@edit_user')->name('edit_user_admin');





Route::get('/admin_logout','admin\LoginController@logout')->name('admin_logout');

<<<<<<< HEAD


/****************/


//Operation Departmnet
//clear log
Route::get('/get_clear_log_list', 'admin\ClearLogController@index')->name('clear_log_list');
Route::get('/search_clear_log', 'admin\ClearLogController@search_clear_log')->name('search_clear_log');
Route::get('/paginat_clear_log_admin', 'admin\ClearLogController@paginate_clear_log')->name('paginate_clear_log_admin');
Route::get('/delete_clear_log_admin/{id}', 'admin\ClearLogController@delete_clear_log')->name('delete_clear_log_admin');
Route::post('/add_clear_log', 'admin\ClearLogController@add_clear_log')->name('add_clear_log');
Route::post('/edit_clear_log', 'admin\ClearLogController@edit_clear_log')->name('edit_clear_log');
Route::get('/clearlog_excel', 'admin\ClearLogController@clearlog_excel')->name('clearlog_excel.export');

//Create Invoice
Route::get('/create_invoice_list', 'admin\CreateInvoicesController@createInvoiceList')->name('create_invoice_list');
Route::post('/clear_log_invoice', 'admin\CreateInvoicesController@save_invoice')->name('clear_log_invoice');
Route::post('/delivery_invoice', 'admin\CreateInvoicesController@deliveryInvoice')->name('delivery_invoice');
Route::post('/clearance_status/{id}','admin\ClearLogController@clearance_status')->name('clearance_status');
Route::get('/create_invoice_list_excel','admin\CreateInvoicesController@create_invoice_excel')->name('create_invoice_excel.export');
Route::get('/invoice_export/{status}','admin\CreateInvoicesController@invoice_export')->name('invoices_list.export');
Route::get('/delivery_invoice_export/{status}','admin\CreateInvoicesController@delivery_invoice_export')->name('delivery_invoice_list.export');
//
Route::get('/invoice_pdf_admin/{id}','admin\CreateInvoicesController@invoice_pdf1')->name('invoice_pdf_admin'); // pdf 1
Route::get('/invoice_pdf1_admin/{id}','admin\CreateInvoicesController@invoice_pdf2')->name('invoice_pdf1_admin');
Route::get('/invoices_list_admin/{id}','admin\CreateInvoicesController@allInvoiceList')->name('invoices_list_admin');
Route::post('/invoices_list_admin/pendingStatus/{id}','admin\CreateInvoicesController@pendingStatus')->name('pendingStatus');
Route::post('/invoices_list_admin/deliveryPendingStatus/{id}','admin\CreateInvoicesController@deliveryPendingStatus')->name('deliveryPendingStatus');
Route::get('/change_status_logs','admin\CreateInvoicesController@change_status_logs')->name('change_status_logs');
Route::get('/change_status_delivery','admin\CreateInvoicesController@change_status_delivery')->name('change_status_delivery');

Route::post('/edit_invoice', 'admin\CreateInvoicesController@edit_invoice')->name('edit_invoice');
Route::get('/delete_invoicefile/{id}', 'admin\CreateInvoicesController@delete_invoice')->name('delete_invoicefile');

Route::post('/edit_delivery_invoice', 'admin\CreateInvoicesController@edit_delivery_invoice')->name('edit_delivery_invoice');
Route::get('/delete_delivery_invoice/{id}', 'admin\CreateInvoicesController@delete_delivery_invoice')->name('delete_delivery_invoice');

// Finance Department
Route::get('/finance_admin_invoice', 'admin\FinanceInvoiceController@finance_invoice')->name('finance_invoice');

// Get Customer
Route::get('/get_customer_admin', 'admin\CustomerController@get_customer')->name('get_customer_admin');
Route::get('/get_container_admin', 'admin\CustomerController@get_container')->name('get_container_admin');
Route::post('/save_invoice', 'admin\CreateInvoicesController@save_invoice')->name('save_invoice');
Route::post('/update_log_invoice', 'admin\CreateInvoicesController@update_log_invoice')->name('update_log_invoice');

Route::get('/edit_log_invoice/{id}', 'admin\CreateInvoicesController@edit_log_invoice')->name('edit_log_invoice');

?>
=======
?>
>>>>>>> parent of affd84d (Cleared the repo)
