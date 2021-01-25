<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $appends = ['order_sum'];

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_products');
    }

    public function getOrderSumAttribute()
    {
        return $this->pivot->quantity * $this->pivot->price;
    }
}
