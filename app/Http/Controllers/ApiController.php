<?php

namespace App\Http\Controllers;


use App\Models\Product;
use App\Services\OrdersService;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function overdue(Request $request, OrdersService $order_service)
    {
        $orders = $order_service->overdue($request->get('page'));
        $key    = 'overdue';

        return view('orders.table', compact('orders', 'key'));
    }

    public function current(OrdersService $order_service)
    {
        $orders = $order_service->current();
        $key    = 'current';

        return view('orders.table', compact('orders', 'key'));
    }

    public function new(Request $request, OrdersService $order_service)
    {
        $orders = $order_service->new($request->get('page'));
        $key    = 'new';

        return view('orders.table', compact('orders', 'key'));
    }

    public function completed(Request $request, OrdersService $order_service)
    {
        $orders = $order_service->completed($request->get('page'));
        $key    = 'completed';

        return view('orders.table', compact('orders', 'key'));
    }

    public function all(Request $request, OrdersService $order_service)
    {
        $orders = $order_service->all($request->get('page'));
        $key    = 'all';

        return view('orders.table', compact('orders', 'key'));
    }

    public function getInfo(Request $request)
    {
        return response()->json([
            "price" => Product::query()->find($request->product_id)->price,
        ], 200);
    }
}