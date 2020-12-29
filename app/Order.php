<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

    public function partner()
    {
        return $this->hasOne(Partner::class,"id","partner_id");
    }

    public function order_products()
    {
        return $this->hasMany(OrderProduct::class);
    }

    //public function get_list_of_order()
    //{
    //    return $this->with("order_products.product","partner")->where('orders.id',2)->get();
    //}
}
