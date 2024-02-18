<?php

use App\Permission;
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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::group(['middleware' => ['auth']], function () {
    Route::resource('users', 'UserController');
    Route::get('users/status/{status}/{id}', 'UserController@status')->name('users.status');
    Route::get('users/profile/{id}', 'UserController@edit_profile')->name('users.edit_profile');
    Route::post('users/update_profile', 'UserController@update_profile')->name('users.update_profile');
    Route::resource('roles', 'RoleController');
    Route::resource('permissions', 'PermissionController');
    Route::get('permissions/status/{status}/{id}', 'PermissionController@status')->name('permissions.status');
    Route::resource('company', 'CompanyController');
    Route::resource('customer', 'CustomerController');
    Route::resource('manufacturer', 'ManufacturerController');
    Route::resource('commoncode', 'Common_CodeController');
    Route::resource('product_categories', 'Product_CategoryController');
    Route::resource('product', 'ProductController');
    Route::get('product/status/{status}/{id}', 'ProductController@status')->name('product.status');
    Route::resource('purchase', 'PurchaseController');
    Route::post('purchase/manufacturer', 'PurchaseController@manufacturer')->name('purchase.manufacturer');
    Route::resource('purchase_return', 'Purchases_ReturnController');
    Route::post('purchase_return/manufacturer', 'Purchases_ReturnController@manufacturer')->name('purchase_return.manufacturer');
    Route::resource('sale', 'SaleController');
    Route::resource('sale_return', 'Sale_ReturnController');



});

