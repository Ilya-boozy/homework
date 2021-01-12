@extends('layout')
@section("header")
    @include('header')
@endsection

@section('main_content')
    <div class="container">
        <script>
            function show_or_hide_items_table(table_id) {
                $('#' + table_id).toggle();
            }
        </script>
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
                    <th scope="row">{{$order->id}}</th>
                    <td>{{$order->partner->name}}</td>
                    <td>{{$order->order_products->sum("RowsSum")}}</td>
                    <td class="items_table">
                        <p>
                            <button class="btn btn-secondary" onclick="show_or_hide_items_table('Table{{$order->id}}')">Товары</button>
                        </p>
                        <table class="table table_child" id="Table{{$order->id}}">
                            <thead>
                            <tr>
                                <th scope="col">Product</th>
                                <th scope="col">Price</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Amount</th>
                            </tr>
                            @foreach($order->order_products as $product_line)
                                <tr>
                                    <td>{{$product_line->product->name}}</td>
                                    <td>{{$product_line->price}}</td>
                                    <td>{{$product_line->quantity}}</td>
                                    <td>{{$product_line->price * $product_line->quantity}}</td>
                                </tr>
                            @endforeach
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </td>
                    <td>{{$order->status}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    {{$orders->links()}}
@endsection