<?php


namespace App\Services;


use App\Order;
use Illuminate\Support\Facades\Auth;

class GetOrdersService
{
    public static function ordersForList($status)
    {
        $orders = Order::query()
            ->where("client_email", Auth::user()->email)
            ->with("products");
        if ($status == "overdue") {
            $orders = $orders
                ->where("delivery_dt", "<", date("Y-m-d H:i:s"))
                ->where("status", 10)
                ->orderBy("delivery_dt", "desc")
                ->paginate(50);
        } elseif ($status == "current") {
            $orders = $orders
                ->where("delivery_dt", ">", date("Y-m-d") . " 00:00:00")
                ->where("status", 10)
                ->orderBy("delivery_dt", "asc")
                ->get();
        } elseif ($status == "new") {
            $orders = $orders
                ->where("delivery_dt", ">", date("Y-m-d H:i:s"))
                ->where("status", 0)
                ->orderBy("delivery_dt", "asc")
                ->paginate(50);
        } elseif ($status == "completed") {
            $orders = $orders
                ->where("delivery_dt", ">", date("Y-m-d H:i:s"))
                ->where("delivery_dt", "<", date("Y-m-d", strtotime("+24 hour")))
                ->where("status", 20)
                ->orderBy("delivery_dt", "desc")
                ->paginate(50);
        } elseif ($status == "all" || is_null($status)) {
            $orders = $orders->paginate(10);
        }

        return $orders;
    }
}