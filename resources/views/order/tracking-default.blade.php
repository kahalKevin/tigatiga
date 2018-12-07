@extends('layouts.app')

@section('content')

<div class="service-area ptb-80" id="order-tracking">
    <div class="container">
        <div class="row">
            <div class="col-lg-10">
                <div class="header">
                    <p class="title">Order Tracking</p>
                    <p class="sub-title">Track your order history here</p><br>
                    <form class="form-horizontal" action="/shop/tracking-order" method="get">
                        <input type="text" name="order_id" value="{{ $order_id != null ? $order_id : '' }}" class="form-control auth" placeholder="Order Id">
                        <button type="submit" class="btn btn-info">VIEW DETAIL</button>
                    </form>
                    <hr>
                </div>
                    <p class="title">{{ $message }}</p>      
            </div>
        </div>
    </div>
</div>

@endsection