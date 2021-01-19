<?php

namespace App\Http\Controllers;

use App\Http\Requests\Orders\UpdateProductsRequest;
use App\Mail\SendOrderMail;
use App\Order;
use App\Partner;
use App\Product;
use App\Services\GetOrdersService;
use App\Services\PrepareDataForSaveService;
use App\Services\StatusService;
use App\Services\WeatherService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class DefaultController extends Controller
{
    public function index()
    {
        $weather = WeatherService::get_weather();

        return view("index", compact("weather"));
    }

    public function ordersList($group)
    {

        $orders     = GetOrdersService::ordersForList($group);
        $group_list = ["all", "overdue", "current", "new", "completed"];

        return view("orders-list", compact("orders", "group_list", "group"));
    }

    public function editOrder(Order $order)
    {
        $status_list = StatusService::getStatusList();
        $all_product = Product::all();
        $all_partner = Partner::all();

        return view("edit-order", compact("order", "status_list", "all_product", "all_partner"));
    }

    public function editOrdersRow(Order $order, Request $request)
    {
        return response()->json([
            "price" => Product::query()->find($request->product_id)->price,
        ], 200);
    }

    public function updateOrder(Order $order, UpdateProductsRequest $request)
    {
        if ($order->client_email != Auth::user()->email) {
            return redirect(route("index"));
        }
        $old_status = $this->updateDBOrder($request, $order);
        if ($order->status == 20 && $old_status != 20) {
            $this->sendEmail($order);
        }

        return redirect()->route("edit_order", ["order" => $order])->with('status', 'ok');
    }

    private function updateDBOrder($request, $order)
    {
        $data_for_update          = $request->validated();
        $products_data_for_update = PrepareDataForSaveService::orderProductDataForSync($data_for_update);
        $old_status               = $order->partner_id;
        DB::transaction(function () use ($order, $data_for_update, $products_data_for_update) {
            $order->products()->sync($products_data_for_update);
            $order->partner_id = $data_for_update["partner"];
            $order->status     = $data_for_update["status"];
            $order->save();
        });

        return $old_status;
    }

    private function sendEmail($order)
    {
        Mail::to('taylor@example.com')->send(new SendOrderMail($order));
    }
}