<?php


use App\Http\Controllers\ApiController;

Route::middleware('auth:web')->group(function (){
    Route::get('/pages/overdue', [ApiController::class, 'overdue']);
    Route::get('/pages/current', [ApiController::class, 'current']);
    Route::get('/pages/new', [ApiController::class, 'new']);
    Route::get('/pages/completed', [ApiController::class, 'completed']);
    Route::get('/pages/all', [ApiController::class, 'all']);
    Route::post('/products/info',[ApiController::class,'getInfo']);
});
