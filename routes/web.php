<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin;
use App\Http\Controllers\Product;
use App\Http\Controllers\Customer;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('admin/login');
});

Route::view('admin/dashboard','admin.dashboard');

// Admin Login
Route::view('/admin/login','admin.login');
Route::post('/admin/admin_login',[Admin::class,'adminLogin']);

// Admin Logout
Route::get('/admin/logout', function () {
    if(session('username')){
        session()->pull('username');
    }
    return redirect('admin/login');
});

// Add Products
Route::view('admin/add_products','admin.add_products');
Route::post('admin/productform',[Product::class,'addProducts']);

// View Products
Route::get('admin/view_products',[Product::class,'viewProducts']);

// Update Product Details
Route::get('admin/edit_products/{id}',[Product::class,'editProductForm']);
Route::post('admin/edit_products/editproductform',[Product::class,'editProducts']);

// Delete Products
Route::get('admin/delete_products/{id}',[Product::class,'deleteProducts']);

// Add Customers
Route::get('admin/add_customers',[Customer::class,'addCustomer']);
Route::post('admin/customerform',[Customer::class,'addCustomerForm']);

// View Customers
Route::get('admin/view_customers',[Customer::class,'viewCustomers']);

// Update Customer Details
Route::get('admin/edit_customers/{id}',[Customer::class,'editCustomerForm']);
Route::post('admin/edit_customers/editcustomerform',[Customer::class,'editCustomers']);

// Customer Invoice
Route::get('admin/download_invoice/{id}',[Customer::class,'customerInvoice']);

// Delete Customers
Route::get('admin/delete_customer/{id}',[Customer::class,'deleteCustomer']);