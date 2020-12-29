<?php


namespace App\Services;


use App\Order;

class WorkWithDBService
{
    public static function __callStatic($name, $arguments)
    {
        return (new static())->$name(...$arguments);
    }

    public static function get_list_of_order()
    {
        return app()[Order::class]->with("order_products.product","partner")->Paginate(10);
    }
}