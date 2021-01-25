<?php


namespace App\Services;


use App\Mail\SendOrderMail;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class OrdersService
{
    const PREFIX_URL = '/api/pages/';

    public function updateOrder($request, Order $order)
    {
        $data = $request->validated();
        $products   = $this->orderProductDataForSync($data);
        DB::transaction(function () use ($order, $data, $products) {
            $order->products()->sync($products);
            $order->update($data);
        });
        if ($order->wasChanged('status') && $order->status == 20) {
            Mail::to('taylor@example.com')->send(new SendOrderMail($order));
        }
    }

    public function orderProductDataForSync(array $data): array
    {
        $result               = collect();
        $products_id          = Arr::get($data, 'product_id');
        $product_quantity     = Arr::get($data, 'quantity');
        $products             = Product::query()->find($products_id);

        foreach ($products_id as $key => $id) {
            $quantity = $product_quantity[$key];
            $record = $result->get($id);
            if ($record) {
                $record['quantity'] += $quantity;
                $result->put($id, $record);
            } else {
                $price = $products->find($id)->price;
                $result->put($id, compact('quantity','price'));
            }
        }
        return $result->toArray();
    }

    public function index()
    {

        $overdue   = $this->overdue();
        $current   = $this->current();
        $new       = $this->new();
        $completed = $this->completed();
        $all       = $this->all();

        return compact('overdue', 'current', 'completed', 'new', 'all');
    }

    public function overdue($page_number = 1)
    {
        return $this->ordersOfUser()
            ->where("delivery_dt", "<", date("Y-m-d H:i:s"))
            ->where("status", 10)
            ->orderBy("delivery_dt", "desc")
            ->paginate(50, ['*'], 'page', $page_number)
            ->withPath(Self::PREFIX_URL . 'overdue');
    }

    public function current()
    {
        return $this->ordersOfUser()
            ->where("delivery_dt", ">", date("Y-m-d") . " 00:00:00")
            ->where("status", 10)
            ->orderBy("delivery_dt", "asc")
            ->paginate();
    }

    public function new($page_number = 1)
    {
        return $this->ordersOfUser()
            ->where("delivery_dt", ">", date("Y-m-d H:i:s"))
            ->where("status", 0)
            ->orderBy("delivery_dt", "asc")
            ->paginate(50, ['*'], 'page', $page_number)
            ->withPath(Self::PREFIX_URL . 'new');
    }

    public function completed($page_number = 1)
    {
        return $this->ordersOfUser()
            ->where("delivery_dt", ">", date("Y-m-d H:i:s"))
            ->where("delivery_dt", "<", date("Y-m-d", strtotime("+24 hour")))
            ->where("status", 20)
            ->orderBy("delivery_dt", "desc")
            ->paginate(50, ['*'], 'page', $page_number)
            ->withPath(Self::PREFIX_URL . 'completed');
    }

    public function all($page_number = 1)
    {
        return $this->ordersOfUser()
            ->paginate(10, ['*'], 'page', $page_number)
            ->withPath(Self::PREFIX_URL . 'all');
    }

    protected function ordersOfUser()
    {
        return Order::query()
            ->where("client_email", Auth::user()->email)
            ->with("products");
    }
}
