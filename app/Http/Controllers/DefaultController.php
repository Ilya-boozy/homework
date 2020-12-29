<?php

namespace App\Http\Controllers;

use App\Order;
use App\Services\WorkWithDBService;

class DefaultController extends Controller
{
    public function index()
    {

        $orders  = WorkWithDBService::get_list_of_order();
        return view("index", compact('orders'));
    }
}