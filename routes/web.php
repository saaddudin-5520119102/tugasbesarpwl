<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::get('profile', function(){

// })->middleware('auth');

Route::get('admin/home', [App\Http\Controllers\AdminController::class, 'index'])
    ->name('admin.home')
    ->middleware('is_admin');


    // brand
Route::get('admin/brands', [App\Http\Controllers\AdminController::class, 'brands'])
->name('admin.brands')
->middleware('is_admin');

Route::post('admin/brands', [App\Http\Controllers\AdminController::class, 'submit_brand'])
->name('admin.brand.submit')
->middleware('is_admin');

Route::patch('admin/brands/update', [App\Http\Controllers\AdminController::class, 'update_brand'])
->name('admin.brand.update')
->middleware('is_admin');

Route::get('admin/ajaxadmin/dataBrand/{id}', [App\Http\Controllers\AdminController::class, 'getDataBrand']);

Route::delete('admin/brands/delete', [App\Http\Controllers\AdminController::class, 'delete_brand'])
    ->name('admin.brand.delete')
    ->middleware('is_admin');


    // category

Route::get('admin/categories', [App\Http\Controllers\AdminController::class, 'categories'])
    ->name('admin.categories')
    ->middleware('is_admin');

Route::post('admin/categories', [App\Http\Controllers\AdminController::class, 'submit_category'])
    ->name('admin.category.submit')
    ->middleware('is_admin');

Route::patch('admin/categories/update', [App\Http\Controllers\AdminController::class, 'update_category'])
    ->name('admin.category.update')
    ->middleware('is_admin');

Route::get('admin/ajaxadmin/dataCategory/{id}', [App\Http\Controllers\AdminController::class, 'getDataCategory']);

Route::delete('admin/categories/delete', [App\Http\Controllers\AdminController::class, 'delete_category'])
    ->name('admin.category.delete')
    ->middleware('is_admin');


// user
Route::get('user/barang', [App\Http\Controllers\AdminController::class, 'barang'])
->name('user.barang');

Route::post('user/barang', [App\Http\Controllers\AdminController::class, 'submit_barang'])
->name('user.barang.submit');

Route::patch('user/barang/update', [App\Http\Controllers\AdminController::class, 'update_barang'])
    ->name('user.barang.update');

Route::get('user/ajaxadmin/dataBarang/{id}', [App\Http\Controllers\AdminController::class, 'getDataBarang']);