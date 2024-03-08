<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::get('/edit_profile', 'HomeController@edit_profile')->name('edit_profile');

Route::POST('/update_profile/{id}', 'HomeController@update_profile')->name('update_profile');

Route::get('/password_change/', 'HomeController@update_password')->name('update_password');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');

Route::post('/register', [RegisterController::class, 'register']);

Route::resource('customer', 'CustomerController');

Route::resource('invoice', 'InvoiceController');

Route::resource('category', 'CategoryController');

Route::get('changeStatus', 'CategoryController@changeStatus');

Route::resource('tax', 'TaxController');

Route::resource('product', 'ProductController');

Route::resource('supplier', 'SupplierController');



?>

