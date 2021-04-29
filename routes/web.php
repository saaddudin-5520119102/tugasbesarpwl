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

Route::get('admin/brands', [App\Http\Controllers\AdminController::class, 'brands'])
->name('admin.brands')
->middleware('is_admin');

Route::post('admin/brands', [App\Http\Controllers\AdminController::class, 'submit_brand'])
->name('admin.brand.submit')
->middleware('is_admin');

Route::post('admin/brands/update', [App\Http\Controllers\AdminController::class, 'update_brand'])
->name('admin.brand.update')
->middleware('is_admin');

Route::get('admin/ajaxadmin/dataBrand/{id}', [App\Http\Controllers\AdminController::class, 'getDataBrand']);
