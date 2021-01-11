@extends('layout')
@section("header")
    @include('header')
@endsection

@section('main_content')
    <div class="container">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Номер заказа</th>
                <th scope="col">Партнер</th>
                <th scope="col">Стоимость</th>
                <th scope="col">-</th>
                <th scope="col">Статус</th>
            </tr>
            </thead>
            <tbody>
            @foreach($orders as $order)
                    <tr>
                        <th scope="row">{{$order->id}}</th>
                        <td>{{$order->partner->name}}</td>
                        <td>{{$order->order_products->sum("price")}}</td>
                        <td>-</td>
                        <td>{{$order->status}}</td>
                    </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    {{$orders->links()}}
@endsection
