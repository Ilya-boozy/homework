@extends('layout')
@section("header")
    @include('header')
@endsection

@section('main_content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{$order->id}}</div>
                    <div class="card-body">
                        <form method="POST" action="{{route("save_order",["order"=>$order])}}">
                            @csrf
                            @if (true)
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
                                        <tr row_id="{{$product->id}}">
                                            <td>
                                                <select
                                                    class="custom-select mr-sm-2 product_id"
                                                    name="product_id[]">
                                                    @include('options_list_of_product',["current_product_id"=>$product->id])
                                                </select>
                                            </td>
                                            <td class="price">{{$product->pivot->price}}</td>
                                            <td>
                                                <input class="form-control product_quantity"
                                                       name="quantity[]"
                                                       type="number"
                                                       min="1"
                                                       value="{{$product->pivot->quantity}}">
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