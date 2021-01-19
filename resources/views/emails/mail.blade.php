@component('mail::message')
    <table class="table" style="width: 100%">
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
@endcomponent
