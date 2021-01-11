<?php


namespace App\Services;


use App\Order;

class WorkWithDBService
{
    public function get_list_of_order()
    {
        return Order::with("order_products.product","partner")->paginate(10);
    }
}