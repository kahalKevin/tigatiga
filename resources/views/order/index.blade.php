@extends('layouts.app')

@section('content')

<div class="service-area ptb-80" id="order">
    <div class="container">
        <div class="row">
        <div class="col-md-3">
          <div class="box">
            <p class="mp-name">
              Hi, {{ Auth::user()->full_name }}
            </p>
            <a href="{{ url('/') }}/profile"><span class="icon icon-User" style="padding-right: 13px;"></span>My Profile</a>
            <hr>
            <a href="{{ url('/') }}/profile/order/history" class="text-red"><span class="icon icon-FullShoppingCart" style="padding-right: 13px;"></span>Order History</a>
            <hr>
            <a href="{{ url('/') }}/logout"><span class="icon icon-ClosedLock" style="padding-right: 13px;"></span>Logout</a>
          </div>
        </div>
            <div class="col-md-9">
                <div class="box">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="order-title">
                                <p>Order History</p>
                            </div>
                        </div>
                    </div><br>
                    @foreach($orders as $order)
                        <div class="row row-order">
                            <div class="col-md-4">
                                <div class="title">
                                    <p>Order ID</p>
                                </div>
                                <p class="order-id">{{ $order->id }}</p>
                                <div class="order-date">
                                    Ordered On {{ $order->created_at->format('l') }}<br>
                                    {{ $order->created_at->format('d/m/Y H:i:s') }}
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="title">
                                    <p>Product Price</p>
                                </div>
                                <p class="price">Rp. {{ number_format($order->_total_amount, 0, '.', '.') }}</p>
                            </div>
                            <div class="col-md-2">
                                <div class="title">
                                    <p>Status</p>
                                </div>
                                <p class="price">{{ $order->typeStatus->_name }}</p>
                            </div>
                            <div class="col-md-2">
                                @if(!empty($order->payment_gateway_id))
                                    <div class="title">
                                        Payment Method
                                    </div>
                                    <span class="payment-method">{{ $order->typePaymentMethod->_name }}
                                        @if(!empty($order->payment_gateway_va_number))
                                            {{ $order->payment_gateway_va_number }}
                                        @endif
                                    </span>
                                @else
                                    <div class="title">
                                        Payment Method
                                    </div>
                                    <p class="text-white"><b>-</b></p>                                  
                                @endif
                            </div>
                            <div class="col-md-2">
                                <a href="history/detail/{{ $order->id }}" class="btn btn-info btn-lg">View Detail</a>
                            </div>
                        </div>
                        @if(!$loop->last)
                            <hr>
                        @endif
                    @endforeach
                    </div><br>
                    @include('layouts.pagination.default', ['paginator' => $orders->appends(Input::except('page'))]) 
                </div>                
            </div>
        </div>
    </div>
</div>

@endsection