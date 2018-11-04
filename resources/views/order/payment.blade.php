@extends('layouts.app')

@section('content')

<div class="service-area ptb-80" id="payment">
            <div class="container">
                <div class="box" action="index.html" method="post">
                    <p class="ch-title">Payment</p>
                    <div class="row">
                        <!-- Sidebar Shopping Option Start -->
                        <div class="col-lg-9">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="mb-30">
                                        <p>Credit Card</p>
                                        <div class="content">
                                            <img src="/icon/mastercard_logo@1x.png" alt="master-card">
                                            <div class="caption-payment">
                                                Pay by credit card with visa, master card
                                            </div>
                                            <br>
                                            <button type="button" class="btn btn-info" name="button">CHOOSE</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4" style="margin-left: -50px">
                                    <div class="mb-30">
                                        <p>BCA Klik Pay</p>
                                        <div class="content">
                                            <img src="/icon/bca_logo@1x.png" alt="bca-logo">
                                            <div class="caption-payment">
                                                Lorem ipsum dolor sit amet BCA klikpay
                                            </div>
                                            <br>
                                            <button type="button" class="btn btn-info" name="button">CHOOSE</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4" style="margin-left: -50px">
                                    <div class="mb-30">
                                        <p>Bank Transfer</p>
                                        <div class="content">
                                            <img src="/icon/ATM_Bersama_2016@1x.png" alt="atm-bersama">
                                            <div class="caption-payment">
                                                Lorem ipsum dolor Bank Transfer
                                            </div>
                                            <br>
                                            <button type="button" class="btn btn-info" name="button">CHOOSE</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="box-price">
                                <p class="name">Dwi Putra</p>
                                <p class="address">Kantor Codigo. Graha Mitra Lantai 7 Jl. Jend. Gatot Subroto Kav.21</p>
                                <p class="phone">08382381908</p>
                            </div>
                            <div class="box-price">
                                <form class="price" action="index.html" method="post">
                                    <div class="form-group">
                                        <label for="total-price">Total Price (2 Product)</label>
                                        <input class="form-control" type="text" name="total-price" value="Rp. 1.000.000" disabled>
                                    </div>
                                    <hr>
                                    <div class="form-group">
                                        <label for="total-shipping">Total Shipping</label>
                                        <input class="form-control" type="text" name="total-shipping" value="Rp. 9.000" disabled>
                                    </div>
                                    <hr>
                                    <div class="form-group">
                                        <label for="grand-price">Grand Price</label>
                                        <input id="grand-price" class="form-control" type="text" name="grand-price" value="Rp. 1.009.000" disabled>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection