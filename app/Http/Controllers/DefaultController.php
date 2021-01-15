<?php

namespace App\Http\Controllers;

use App\Http\Requests\Orders\UpdateProductsRequest;
use App\Order;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class DefaultController extends Controller
{
    public function index()
    {
        return view("index");
    }

    public function orders_list()
    {
        $orders = Order::query()
            ->where("client_email", Auth::user()->email)
            ->with("products")
            ->paginate(10);

        return view("orders-list", compact("orders"));
    }

    public function edit_order(Order $order)
    {
        return view("edit-order", compact("order"));
    }

    public function edit_orders_row(Order $order, Request $request)
    {

        return response()->json([
            "price" => Product::query()->find($request->product_id)->price,
        ], 200);

    }

    public function update_order(Order $order, UpdateProductsRequest $request)
    {
        $order->products()->sync([]);
        $order->products()->sync($this->prepareDataForSync($request->validated()));

        return redirect(route("edit_order", ["order" => $order]), 302);
    }

    /**
     * @param array $data
     *
     * @return array
     */
    private function prepareDataForSync(array $data): array
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
