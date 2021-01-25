<?php

namespace App\Http\Controllers;

use App\Http\Requests\Orders\UpdateProductsRequest;
use App\Models\Order;
use App\Models\Partner;
use App\Models\Product;
use App\Services\OrdersService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrdersController extends Controller
{
    protected $orders_service;

    public function __construct(OrdersService $orders_service)
    {
        $this->orders_service = $orders_service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = $this->orders_service->index();

        return view('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        $all_product = Product::all();
        $all_partner = Partner::all();
        $status_list = Order::STATUSES;

        return view('orders.edit', compact('order', 'all_partner', 'all_product', 'status_list'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductsRequest $request, Order $order)
    {
        if ($order->client_email != Auth::user()->email) {
            return redirect(route("index"));
        }

        $this->orders_service->updateOrder($request, $order);

        return redirect()->route("orders.edit", ["order" => $order])->with('order_saved', true);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}