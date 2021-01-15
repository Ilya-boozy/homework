<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

    protected $appends = ['order_sum'];

    public function partner()
    {
        return $this->hasOne(Partner::class, "id", "partner_id");
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_products')->withPivot('quantity', 'price');
    }

    public function getOrderSumAttribute()
    {
        return $this->products->sum('order_sum');
    }

    //public function get_list_of_order()
    //{
    //    return $this->with("order_products.product","partner")->where('orders.id',2)->get();
    //}
}
