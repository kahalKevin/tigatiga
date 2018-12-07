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
                    @foreach($order_detail_list_history as $odlh)
                        <div class="row">
                            <div class="col-md-4">
                                <div class="title">
                                    <p>Product Name</p>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <img src="{{ $cmsUrl . $odlh->product_image_url }}" alt="{{ $odlh->product_name }}" width="75px" height="75">
                                    </div>
                                    <div class="col-md-6">
                                        <div class="comment-desc">
                                            <p>{{ $odlh->product_name }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="quantity">
                                    <p>Quantity<br>{{ $odlh->_qty }}</p>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="title">
                                    <p>Order ID</p>
                                </div>
                                <p class="order-id">{{ $odlh->order_id }}</p>
                                <div class="order-date">
                                    Ordered On {{ $odlh->created_at->format('l') }}<br>
                                    {{ $odlh->created_at->format('d/m/Y H:i:s') }}
                                </div>
                                @if(!empty($odlh->order->payment_gateway_id))
                                <div class="title-payment">
                                    Payment Method<br>
                                    <span class="payment-method">{{ $odlh->order->typePaymentMethod->_name }}</span><br>
                                    @if(!empty($odlh->order->payment_gateway_va_number))
                                    <span class="payment-method">VA BCA({{ $odlh->order->payment_gateway_va_number }})</span>
                                    @endif
                                </div>                                
                                @endif
                            </div>
                            <div class="col-md-3">
                                <div class="title">
                                    <p>Product Price</p>
                                </div>
                                <p class="price">Rp. {{ number_format($odlh->product_price, 0, '.', '.') }}</p>
                                <div class="status">
                                    Status<br>
                                    <span class="payment-method">{{ $odlh->order->typeStatus->_name }}</span><br><br>
                                    <a href="history/detail/{{ $odlh->order_id }}" class="btn btn-info btn-lg">View Detail</a>
                                </div>
                            </div>
                        </div>
                        @if(!$loop->last)
                            <hr>
                        @endif
                    @endforeach
                    </div><br>
                    @include('layouts.pagination.default', ['paginator' => $order_detail_list_history->appends(Input::except('page'))]) 
                </div>                
            </div>
        </div>
    </div>
</div>

@endsection