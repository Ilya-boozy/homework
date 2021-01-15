<?php

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

use App\Http\Controllers\DefaultController;

Route::get('/', [DefaultController::class, "index"]);
Route::get('/orders-list', [DefaultController::class, "orders_list"])->middleware("auth");
Route::get('/orders-list/{order}/edit', [DefaultController::class, "edit_order"])->name("edit_order")->middleware("auth");
Route::post('/orders-list/{order}/edit', [DefaultController::class, "edit_orders_row"])->middleware("auth");
Route::post('/orders-list/{order}/save', [DefaultController::class, "update_order"])->name("save_order")->middleware("auth");

Auth::routes(['verify' => true]);

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
