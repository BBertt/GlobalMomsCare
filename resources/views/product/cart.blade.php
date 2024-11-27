This is cart
@foreach ($carts as $cart)
    {{ $cart->product->name }}
@endforeach
