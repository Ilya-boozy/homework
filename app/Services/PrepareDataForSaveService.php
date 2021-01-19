<?php


namespace App\Services;

use App\Product;
use Illuminate\Support\Arr;

class PrepareDataForSaveService
{
    public static function orderProductDataForSync(array $data): array
    {
        $result         = collect();
        $quantity_array = Arr::get($data, 'quantity');
        foreach (Arr::get($data, 'product_id') as $key => $id) {
            $record = $result->get($id);
            if ($record) {
                $record['quantity'] += $quantity_array[$key];
                $result->put($id, $record);
            } else {
                $price = Product::query()->findOrFail($id)->price;
                $result->put($id, ['quantity' => $quantity_array[$key], 'price' => $price]);
            }
        }

        return $result->toArray();
    }
}