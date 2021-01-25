@extends('layouts.layout')
@section("header")
    @include('layouts.header')
@endsection

@section('main_content')
    @php($key = array_key_first($orders))
    <div class="container">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <a
                    class="nav-link active"
                    id="{{$key}}-tab"
                    data-toggle="tab"
                    href="#{{$key}}"
                    role="tab"
                    aria-controls="{{$key}}"
                    aria-selected="true"
                >
                    {{$key}}
                </a>
            </li>
            @foreach(array_slice($orders,1) as $key => $order_group)
                <li class="nav-item" role="presentation">
                    <a
                        class="nav-link"
                        id="{{$key}}-tab"
                        data-toggle="tab"
                        href="#{{$key}}"
                        role="tab"
                        aria-controls="{{$key}}"
                        aria-selected="true"
                    >
                        {{$key}}
                    </a>
                </li>
            @endforeach
        </ul>
        @php($key = array_key_first($orders))
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="{{$key}}" role="tabpanel" aria-labelledby="home-tab">
                @include('orders.table', ['orders' => $orders[$key]])
            </div>
            @foreach($orders as $key => $order_group)
                <div class="tab-pane fade" id="{{$key}}" role="tabpanel" aria-labelledby="profile-tab">
                    @include('orders.table', ['orders' => $order_group,'key'=>$key])
                </div>
            @endforeach
        </div>
    </div>
@endsection