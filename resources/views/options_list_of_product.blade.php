@foreach(\App\Product::all() as $product)
    @if ($product->id == $current_product_id)
        <option selected value="{{$product->id}}">{{$product->name}}</option>
    @else
        <option value="{{$product->id}}">{{$product->name}}</option>
    @endif
@endforeach