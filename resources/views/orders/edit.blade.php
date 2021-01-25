@extends('layouts.layout')
@section("header")
    @include('layouts.header')
@endsection

@section('main_content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{$order->id}}</div>
                    <div class="card-body">
                        <form method="POST" action="{{route("orders.update",["order"=>$order])}}">
                            @csrf
                            @if (isset($order))
                                @method('PUT')
                            @endif
                            @if (session()->get("order_saved"))
                                <div class="form-group row" id="text-about-save">
                                    <div class="col-md-8 ">
                                        <p class="text-muted">Order saved</p>
                                    </div>
                                </div>
                                <script>
                                    setTimeout(function () {
                                        $('#text-about-save').hide(1000);
                                    }, 1000);
                                </script>
                            @endif
                            <div class="form-group row">
                                <label class="col-sm-2">E-mail</label>
                                <div class="col-sm-10">
                                    <label class="col-form-label">{{$order->client_email}}</label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Partner</label>
                                <div class="col-sm-10">
                                    <select class="custom-select mr-sm-2 product_id" name="partner_id">
                                        @include('layouts.select-option',["current_id"=>$order->partner->id,"records"=>$all_partner])
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Status</label>
                                <div class="col-sm-10">
                                    <select class="custom-select mr-sm-2 product_id" name="status">
                                        @foreach($status_list as $status)
                                            @if ($status == $order->status)
                                                <option selected="true" value="{{$status}}">{{$status}}</option>
                                            @else
                                                <option value="{{$status}}">{{$status}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <table class="table" id="{{$order->id}}" order_id="{{$order->id}}">
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
                                        <tr row_id="{{$product->id}}" class="product_row">
                                            <td>
                                                <select
                                                    class="custom-select mr-sm-2 product_id"
                                                    name="product_id[]"
                                                >
                                                    @include('layouts.select-option',["current_id"=>$product->id,"records"=>$all_product])
                                                </select>
                                            </td>
                                            <td class="price">{{$product->pivot->price}}</td>
                                            <td>
                                                <input
                                                    class="form-control quantity"
                                                    name="quantity[]"
                                                    type="number"
                                                    min="1"
                                                    value="{{$product->pivot->quantity}}"
                                                >
                                            </td>
                                            <td class="amount">{{$product->pivot->order_sum}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-8">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Save') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection