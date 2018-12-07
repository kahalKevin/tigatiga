@extends('layouts.app')

@section('content')

<div class="service-area ptb-80" id="checkout">
    <div class="container">
        <div class="box" action="index.html" method="post">
            <p class="ch-title">Add To Cart</p>
            <div class="row">
                <!-- Sidebar Shopping Option Start -->
                <div class="col-md-9 mb-all-40">
                    <p class="title-shipping">Products In Cart</p>
                    @if ($message = Session::get('error'))
                    <div class="alert alert-danger alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button> 
                            <strong>{{ $message }}</strong>
                    </div>
                    @endif
                    @php
                        $total_price_all_item = 0
                    @endphp
                    @if(isset($cart))
                    @foreach($cart as $cart_item)
                    @php
                        $total_price_per_item = $cart_item->_qty * $cart_item->products()->get()[0]->_price                        
                    @endphp
                    <div class="box-shipping-courier">
                        <div class="row mb-20">
                            <div class="col-sm-12 col-md-4 d-inline-block">
                                <img class="product-image" src="{{ env('IMG_URL_PREFIX') . $cart_item->products()->get()[0]->_image_url }}" width="61" height="63"/>
                                <div class="comment-desc">
                                    <p>{{ $cart_item->products()->get()[0]->_name }}</p>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-5 d-inline-block">
                                <div class="input-group justify-content-center mb-3">
                                    <label for="quantity" class="mr-20 align-self-center">Quantity :</label>
                                    <span class="input-group-prepend">
                                        <button class="btn btn-dark btn-sm" id="minus-btn" onclick="window.location='{{ url("shop/cart/decrease-stock/".$cart_item->id) }}'">
                                            <img src="{{ asset('/icon/ico-min.svg') }}" class="ico_minus">
                                        </button>
                                    </span>
                                    <input type="text" id="qty_input" name="quantity" value="{{ $cart_item->_qty }}" min="1">
                                    <span class="input-group-prepend">
                                        <button class="btn btn-dark btn-sm" id="plus-btn" onclick="window.location='{{ url("shop/cart/increase-stock/".$cart_item->id) }}'">
                                            <img src="{{ asset('/icon/ico-plus.svg') }}" class="ico_plus">
                                        </button>
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-3 d-inline-block">
                                <div class="price" name="price">
                                    <p>Total Price</p>
                                    <p><b>Rp. {{ number_format($total_price_per_item, 2) }}</b></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    @php
                        $total_price_all_item = $total_price_all_item + $total_price_per_item
                    @endphp
                    @endforeach
                    @endif
                </div>
                <div class="col-md-3">
                    <p class="title-shipping">Shopping Summary</p>
                    <div class="shopping-summary">
                        @if (Auth::check()) 
                        <form class="price" action="{{ url('/') }}/shop/checkout" method="get">
                        @else 
                        <form class="price" action="{{ url('/') }}/shop/checkoutGuest" method="get">
                        @endif
                            <div class="form-group">
                                <label for="total-price">Total Price</label>
                                <input class="form-control" id="total-price" type="text" name="total-price" value="Rp. {{ number_format($total_price_all_item, 2) }}"
                                    disabled>
                            </div>
                            <hr>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-12 form-btn">
                                        <input id="pay" class="btn btn-info btn-lg" type="submit" name="apply" value="CHECKOUT">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
