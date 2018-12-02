@extends('layouts.app')

@section('content')

<div class="service-area ptb-80" id="order-detail">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="box">
                    <p class="mp-name">
                      Hi, {{ Auth::user()->full_name }}
                    </p>
                    <a href="{{ url('/') }}/profile"><span class="icon icon-User" style="padding-right: 13px;"></span>My Profile</a>
                    <hr>
                    <a href="{{ url('/') }}/profile/order/history"><span class="icon icon-FullShoppingCart" style="padding-right: 13px;"></span>Order History</a>
                    <hr>
                    <a href="{{ url('/') }}/logout"><span class="icon icon-ClosedLock" style="padding-right: 13px;"></span>Logout</a>
                </div>
            </div>
            <div class="col-md-9">
                <div class="box">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="order-title">
                                <p>Order ID : {{ $order->id }}</p>
                            </div>
                        </div>
                    </div><br>
                    @foreach($order_detail as $od)
                        <div class="row">
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-6">
                                        <img src="{{ $cmsUrl . $od->product_image_url }}" alt="$od->product_name" width="75px" height="75">
                                    </div>
                                    <div class="col-md-6">
                                        <div class="comment-desc">
                                            <p>{{ $od->product_name }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <!-- <div class="title">
                                    <p>Order ID</p>
                                </div><br> -->
                                <div class="quantity">
                                    <p>Quantity<br>{{ $od->_qty }}</p>
                                </div>

                            </div>
                            <div class="col-md-4">
                                <div class="title">
                                    <p>Total Price</p>
                                </div>
                                @php
                                    $total_product_price = $od->_qty * $od->product_price;
                                @endphp
                                <p class="price">Rp. {{ number_format($total_product_price, 0, '.', '.') }}</p>
                            </div>
                        </div>
                    @endforeach
                    <br><br>
                    @if($order->status_id == 'STATUSORDER0')
                    <div class="title-upload">
                        <form class="form-horizontal" action="/shop/checkout" method="get">
                            @csrf
                            <input class="form-control auth" type="hidden" name="order_id" value="{{ $order->id }}">
                            <button class="btn btn-info btn-lg" type="submit">GO TO CHECKOUT</button>
                        </form>
                    </div>                    
                    @endif
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="title-address">
                                Shipping Address<br>
                                <span class="address">{{ $order->_address }}</span>
                            </div><br><br>

                            <!-- Check every condition from order status -->
                            <div class="">
                                <div class="track-order-circle">
                                    <div class="{{ $last_status >= 1 ? 'active' : '' }}">
                                        <div class="circle-track {{ $last_status >= 1 ? 'active' : '' }}">
                                            <span>1</span>
                                            <p>Payment Confirmation</p>
                                        </div>
                                    </div>
                                    <div class="{{ $last_status >= 2 ? 'active' : '' }}">
                                        <div class="circle-track {{ $last_status >= 2 ? 'active' : '' }}">
                                            <span>2</span>
                                            <p>Payment Verification</p>
                                        </div>
                                    </div>
                                    <div class="{{ $last_status >= 3 ? 'active' : '' }}">
                                        <div class="circle-track {{ $last_status >= 3 ? 'active' : '' }}">
                                            <span>3</span>
                                            <p>In Process</p>
                                        </div>
                                    </div>
                                    <div class="{{ $last_status >= 4 ? 'active' : '' }}">
                                        <div class="circle-track {{ $last_status >= 4 ? 'active' : '' }}">
                                            <span>4</span>
                                            <p>In Delivery</p>
                                        </div>
                                    </div>
                                    <div class="{{ $last_status >= 5 ? 'active' : '' }}">
                                        <div class="circle-track {{ $last_status >= 5 ? 'active' : '' }}">
                                            <span>5</span>
                                            <p>Packet Received</p>
                                        </div>
                                    </div>
                                    <div class="{{ $last_status >= 6 ? 'active' : '' }}">
                                        <div class="circle-track {{ $last_status >= 6 ? 'active' : '' }}" style="border-left: none; border-top: none;">
                                            <span>6</span>
                                            <p>Transaction Complete</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
 
                <div class="box-total-price">
                    <div class="row">
                        <div class="col-lg-3">
                            <p>Price</p>
                            <p class="harga">Rp. {{ number_format($order->_total_amount, 0, '.', '.') }}</p>
                        </div>
                        <div class="col-lg-6">
                            <p>Shipping</p>
                            <p class="harga">Rp. {{ number_format($order->_freight_amount, 0, '.', '.') }}</p>
                        </div>
                        <div class="col-lg-3">
                            <p>Grand Price</p>
                            <p class="harga">Rp. {{ number_format($order->_grand_total, 0, '.', '.') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
