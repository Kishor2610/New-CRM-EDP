<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CustomerQueryController;


Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::get('/edit_profile', 'HomeController@edit_profile')->name('edit_profile');

Route::POST('/update_profile/{id}', 'HomeController@update_profile')->name('update_profile');

Route::get('/password_change/', 'HomeController@update_password')->name('update_password');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');

Route::post('/register', [RegisterController::class, 'register']);


// Customer Route

Route::resource('customer', 'CustomerController');

Route::post('customer', [CustomerController::class, 'store_data'])->name('customer.store_data');



Route::resource('invoice', 'InvoiceController');

Route::get('/findPrice', 'InvoiceController@findPrice')->name('findPrice');

Route::get('/invoices/sales', 'InvoiceController@sales')->name('invoice.sales');

Route::get('/invoices/available_Product', 'InvoiceController@availableProduct')->name('invoice.available_Product');


// Mail

Route::get('/invoices/{id}/mail', 'InvoiceController@mailInvoice')->name('invoice.mailInvoice');


// Route::get('/invoices/mail', 'InvoiceController@mail')->name('invoice.mail');



Route::resource('category', 'CategoryController');

Route::get('changeStatus', 'CategoryController@changeStatus');

Route::resource('tax', 'TaxController');

Route::resource('product', 'ProductController');

Route::resource('supplier', 'SupplierController');

Route::resource('raw_material', 'RawMaterialController');

Route::get('changeStatus', 'RawMaterialController@changeStatus');




Route::resource('quotation', 'QuotationController');

Route::get('/findPrice', 'QuotationController@findPrice')->name('findPrice');

Route::get('/quotations/quotation_sales', 'QuotationController@quotation_sales')->name('quotation.quotation_sales');



// Payment Route

Route::get('/customer/payments/{customerId}', 'PaymentController@getCustomerPayments');

Route::get('/customer/payment/{id}', 'PaymentController@payment')->name('customer.payment');

Route::post('/customer/payment/', 'PaymentController@store')->name('customer.store');


Route::get('/forgot-password', 'Auth\ForgotPasswordController@showlinkrequestform')->name('forgot.password');
Route::post('/forgot-password', 'Auth\ForgotpasswordController@sendresetlinkemail')->name('password.email');

Route::get('/new-password/{token}', 'Auth\RegisterController@showresetform')->name('password.reset');
Route::post('/new-password', 'Auth\RegisterController@reset')->name('password.update');





Route::get('/queryform', 'CustomerQueryController@create')->name('customer.queryform');
Route::post('/queryform', [CustomerQueryController::class, 'submitQuery'])->name('customer.submitquery');

Route::get('/fetch_notifications', [CustomerQueryController::class, 'fetchNotifications'])->name('fetch_notifications');

Route::get('/viewqueries', 'CustomerQueryController@viewQueries')->name('viewqueries');
Route::get('/fetch-notifications', 'CustomerQueryController@fetchNotifications')->name('fetchNotifications');

Route::get('/fetch-notifications-count', [CustomerQueryController::class, 'fetchNotificationsCount'])
    ->name('fetch_notifications_count');


?>

