@extends('layouts.app')

@section('content')

<div class="service-area ptb-80" id="order-detail">
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
                                <p>Order ID 094564234</p>
                            </div>
                        </div>
                    </div><br>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="row">
                                <div class="col-md-6">
                                    <img src="/img/product/adidas-gazelle2.png" alt="blg11" width="75px" height="75">
                                </div>
                                <div class="col-md-6" style="padding-left: 0; margin-left: -30px">
                                    <div class="comment-desc">
                                        <p>Adidas Gazelle II Orange</p>
                                    </div>
                                </div>
                            </div><br>
                            <div class="title-upload">
                                Upload bukti pembayaran<br><br>
                                <a href="#" class="btn btn-info btn-lg">UPLOAD IMAGE</a>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <!-- <div class="title">
                                <p>Order ID</p>
                            </div><br> -->
                            <div class="quantity">
                                <p>Quantity<br>1</p>
                            </div>

                        </div>
                        <div class="col-md-4">
                            <div class="title">
                                <p>Total Price</p>
                            </div>
                            <p class="price">Rp. 500.000</p>
                        </div>
                    </div>
                    <br><br>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="title-address">
                                Shipping Address<br>
                                <span class="address">Kantor Codigo. Graha Mitra Lantai 7 Jl. Jend. Gatot Subroto Kav.21</span>
                            </div><br><br>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="process-line"></div>
                                    <div class="circle-first-number">
                                        <p>Payment Confirmation</p>
                                    </div>
                                    <div class="circle-second-number">
                                        <p>Payment Verification</p>
                                    </div>
                                    <div class="circle-third-number">
                                        <p>In Process</p>
                                    </div>
                                    <div class="circle-fourth-number">
                                        <p>In Delivery</p>
                                    </div>
                                    <div class="circle-fifth-number">
                                        <p>Packet Received</p>
                                    </div>
                                    <div class="circle-sixth-number">
                                        <p>Transaction Complete</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="row">
                    <div class="col-lg-12">

                    </div>
                </div> -->
                <div class="box-total-price">
                    <div class="row">
                        <div class="col-lg-3">
                            <p>Price</p>
                            <p class="harga">Rp. 500.000</p>
                        </div>
                        <div class="col-lg-6">
                            <p>Shipping</p>
                            <p class="harga">Rp. 9.000</p>
                        </div>
                        <div class="col-lg-3">
                            <p>Grand Price</p>
                            <p class="harga">Rp. 509.000</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection