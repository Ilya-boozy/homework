<p>
<table class="table">
    <thead>
    <tr>
        <th scope="col">Order number</th>
        <th scope="col">Partner</th>
        <th scope="col">Amount</th>
        <th scope="col"></th>
        <th scope="col">Status</th>
    </tr>
    </thead>
    <tbody>
    @foreach($orders as $order)
        <tr>
            <th scope="row">
                <a href="{{route('orders.edit',['order'=>$order])}}">
                    {{$order->id}}
                </a>
            </th>
            <td>{{$order->partner->name}}</td>
            <td>{{$order->order_sum }}</td>
            <td class="products-container">
                <p>
                    <button class="btn btn-secondary visible-control-products" id="{{$key}}{{$order->id}}">Goods</button>
                </p>
                <table class="table table-child" id="table{{$key}}{{$order->id}}">
                    <thead>
                    <tr>
                        <th scope="col">Product</th>
                        <th scope="col">Price</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Amount</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($order->products as $product)
                        <tr>
                            <td>{{$product->name}}</td>
                            <td>{{$product->pivot->price}}</td>
                            <td>{{$product->pivot->quantity}}</td>
                            <td>{{$product->order_sum}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </td>
            <td>{{$order->status}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
<div id='paginate-{{$key}}'>
    {{$orders->links('orders.paginate')}}
</div>
</p>