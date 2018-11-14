@extends('layouts.app')

@section('content')

<div class="service-area ptb-80" id="order">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="box">
                    <p class="mp-name">
                        Hi, Dwi Putra Fath
                    </p>
                    <p class="mp-subname">
                        lorem ipsum dolar sit amet
                    </p>
                    <a href="#"><span class="icon icon-User" style="padding-right: 13px;"></span>My Profile</a>
                    <hr>
                    <a href="#"><span class="icon icon-FullShoppingCart" style="padding-right: 13px;"></span>Order History</a>
                    <hr>
                    <a href="#"><span class="icon icon-ClosedLock" style="padding-right: 13px;"></span>Logout</a>
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
                    <div class="row">
                        <div class="col-md-4">
                            <div class="title">
                                <p>Product Name</p>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <img src="/img/product/adidas-gazelle2.png" alt="blg11" width="75px" height="75">
                                </div>
                                <div class="col-md-6">
                                    <div class="comment-desc">
                                        <p>Adidas Gazelle II Orange</p>
                                    </div>
                                </div>
                            </div>
                            <div class="quantity">
                                <p>Quantity<br>1</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="title">
                                <p>Order ID</p>
                            </div>
                            <p class="order-id">094564234</p>
                            <div class="order-date">
                                Ordered On Saturday<br>
                                25/09/2018 02:35
                            </div>
                            <div class="title-payment">
                                Payment Method<br>
                                <span class="payment-method">ATM Bank Transfer</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="title">
                                <p>Product Price</p>
                            </div>
                            <p class="price">Rp. 500.000</p>
                            <div class="status">
                                Status<br>
                                <span class="payment-method">In Process</span><br><br>
                                <a href="#" class="btn btn-info btn-lg">View Detail</a>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="title">
                                <p>Product Name</p>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <img src="/img/product/arsenal-tshirt2.png" alt="blg11" width="75px" height="75">
                                </div>
                                <div class="col-md-6" style="padding-left: 0; margin-left: -30px">
                                    <div class="comment-desc">
                                        <p>Jersey Arsenal Puma</p>
                                    </div>
                                </div>
                            </div>
                            <div class="quantity">
                                <p>Quantity<br>1</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="title">
                                <p>Order ID</p>
                            </div>
                            <p class="order-id">453532165</p>
                            <div class="order-date">
                                Ordered On Saturday<br>
                                25/09/2018 02:35
                            </div>
                            <div class="title-payment">
                                Payment Method<br>
                                <span class="payment-method">ATM Bank Transfer</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="title">
                                <p>Product Price</p>
                            </div>
                            <p class="price">Rp. 800.000</p>
                            <div class="status">
                                Status<br>
                                <span class="payment-method">In Process</span><br><br>
                                <a href="#" class="btn btn-info btn-lg">View Detail</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection