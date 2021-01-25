<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

    const STATUSES = [0, 10, 20];

    protected $fillable = [
        'status','partner_id','client_email','delivery_dt'
    ];

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

    public function setStatusAttribute($value)
    {
        if (in_array(intval($value),self::STATUSES)) {
            $this->attributes['status'] = $value;
        }else{
            throw new \Exception('fuck u');
        }
    }
}
