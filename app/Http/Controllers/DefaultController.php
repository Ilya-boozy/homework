<?php

namespace App\Http\Controllers;

use App\Services\WorkWithDBService;
use Illuminate\Support\Facades\Auth;

class DefaultController extends Controller
{
    public function index()
    {
        return view("index");
    }

    public function orders_list()
    {
        $orders = WorkWithDBService::get_list_of_order(Auth::user()->email);
        return view("orders-list", compact('orders'));
    }
}