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

Route::get('/', [DefaultController::class, "index"])->name("index");
Route::get('/orders-list/{group}', [DefaultController::class, "ordersList"])->name("orders_list")->middleware("auth");
Route::get('/orders-list/{order}/edit', [DefaultController::class, "editOrder"])->name("edit_order")->middleware("auth");
Route::post('/orders-list/{order}/edit', [DefaultController::class, "editOrdersRow"])->middleware("auth");
Route::post('/orders-list/{order}/save', [DefaultController::class, "updateOrder"])->name("save_order")->middleware("auth");

Auth::routes(['verify' => true]);

