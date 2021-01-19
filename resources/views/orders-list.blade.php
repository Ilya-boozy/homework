@extends('layout')
@section("header")
    @include('header')
@endsection

@section('main_content')
    <div class="container">
        <p>
        <div class="btn-group" role="group" aria-label="Basic example">
            @foreach($group_list as $group_)
                <a
                    @if ($group_ == $group)
                    class="btn btn-primary"
                    @else
                    class="btn btn-secondary"
                    @endif btn-danger
                    href="{{route('orders_list',['group'=>$group_])}}"
                >
                    {{$group_}}
                </a>
            @endforeach
        </div>
        </p>
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
                            <button class="btn btn-secondary visible-control-products" id="{{$order->id}}">Goods</button>
                        </p>
                        <table class="table table-child" id="table{{$order->id}}">
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
                    <td order_type="{{$order->order_complex_status}}"></td>
                </tr>
            @endforeach
            </tbody>
        </table>
        @if (!($group=="current"))
            {{$orders->links()}}
        @endif
    </div>
@endsection