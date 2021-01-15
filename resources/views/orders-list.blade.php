@extends('layout')
@section("header")
    @include('header')
@endsection

@section('main_content')
    <div class="container">
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
                    <th scope="row"><a href="/orders-list/{{$order->id}}/edit">{{$order->id}}</a></th>
                    <td>{{$order->partner->name}}</td>
                    <td>{{$order->order_sum }}</td>
                    <td class="products-container">
                        <p>
                            <button class="btn btn-secondary visible-control-products"  id="{{$order->id}}">Товары</button>
                        </p>
                        <table class="table table-child" id="table{{$order->id}}">
                            <thead>
                            <tr>
                                <th scope="col">Product</th>
                                <th scope="col">Price</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Amount</th>
                            </tr>
                            @foreach($order->products as $product)
                                <tr>
                                    <td>{{$product->name}}</td>
                                    <td>{{$product->pivot->price}}</td>
                                    <td>{{$product->pivot->quantity}}</td>
                                    <td>{{$product->order_sum}}</td>
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