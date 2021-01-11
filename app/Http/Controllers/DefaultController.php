<?php

namespace App\Http\Controllers;

use App\Services\WorkWithDBService;

class DefaultController extends Controller
{
    protected $service;

    public function __construct(WorkWithDBService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return view("index");
    }

    public function orders_list()
    {
        $orders = $this->service->get_list_of_order();

        return view("orders-list", compact('orders'));
    }
}