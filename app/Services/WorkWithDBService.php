<?php


namespace App\Services;


use App\Order;

class WorkWithDBService
{
    public static function get_list_of_order($email = false)
    {
        if ($email != false) {
            return Order::query()->where("client_email", $email)->with("order_products.product", "partner")->Paginate(10);
        } else {
            return Order::query()->with("order_products.product", "partner")->Paginate(10);
        }
    }
}