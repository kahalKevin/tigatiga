@extends('layouts.app')

@section('content')

<div class="service-area ptb-80" id="checkout">
    <div class="container">
        <div class="box" action="index.html" method="post">
            <p class="ch-title">Checkout</p>
            <div class="row">
                <!-- Sidebar Shopping Option Start -->
                <div class="col-md-9 mb-all-40">
                    <p class="title-shipping">Shipping Courier</p>
                    <div class="box-shipping-courier">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="shipping-courier-item">
                                    <div class="shipping-img">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <img src="/img/product/adidas-gazelle2.png" alt="blg11" width="75px"
                                                    height="75">
                                            </div>
                                            <div class="col-md-4">
                                                <div class="comment-desc">
                                                    <p>Adidas Gazelle II Orange</p>
                                                </div>
                                            </div>
                                        </div><br><br>
                                        <div class="row">
                                            <div class="col-md-12">
                                            <div class="d-block d-sm-none" style="color: white; margin-bottom: 10px;">Sort By:</div>
                                                <div class="toolbar-sorter d-md-flex align-items-center">
                                                    <label class="d-none d-sm-block">Shipping Courier</label>
                                                    <div class="nice-select sorter wide" tabindex="0">
                                                        <span class="current">JNE Regular ( 2 Day )</span>
                                                        <ul class="list">
                                                            <li data-value="Position" class="option">JNE Regular ( 2
                                                                Day )</li>
                                                            <li data-value="Product Name" class="option">TIKI</li>
                                                            <li data-value="Product Name" class="option">POS Indonesia</li>
                                                            <li data-value="Price" class="option">J&T Regular</li>
                                                            <li data-value="Price" class="option">Ninja Express</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="color d-md-flex clearfix" id="quantity">
                                    <label for="quantity">Quantity :</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <button class="btn btn-dark btn-sm" id="minus-btn">
                                                <img src="/icon/ico-min.svg" class="ico_minus">
                                            </button>
                                        </div>
                                        <input type="text" id="qty_input" name="quantity" value="1" min="1">
                                        <div class="input-group-prepend">
                                            <button class="btn btn-dark btn-sm" id="plus-btn">
                                                <img src="/icon/ico-plus.svg" class="ico_plus">
                                            </button>
                                        </div>
                                    </div>
                                    <div class="price" name="price">
                                        <p>Total Price</p>
                                        Rp. 500.0000
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <p class="title-shipping">Shipping Courier</p>
                    <div class="shopping-summary">
                        <form class="price" action="index.html" method="post">
                            <div class="form-group">
                                <label for="total-price">Total Price (2 Product)</label>
                                <input class="form-control" type="text" name="total-price" value="Rp. 1.000.000"
                                    disabled>
                            </div>
                            <hr>
                            <div class="form-group">
                                <label for="total-shipping">Total Shipping</label>
                                <input class="form-control" type="text" name="total-shipping" value="Rp. 9.000"
                                    disabled>
                            </div>
                            <hr>
                            <div class="form-group">
                                <label for="grand-price">Grand Price</label>
                                <input id="grand-price" class="form-control" type="text" name="grand-price" value="Rp. 1.009.000"
                                    disabled>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-12 form-btn">
                                        <input id="pay" class="btn btn-info btn-lg" type="submit" name="apply" value="Pay">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-9 mb-all-40 custom-checkout-class">
                    <p class="title-shipping">Shipping Address</p>
                    <div class="box-shipping-courier">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="shipping-courier-item">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <p class="cust-name">Dwi Putra Faturrahman</p>
                                            <p class="cust-address">Kantor Codigo. Graha Mitra Lantai 7 Jl. Jend. Gatot
                                                Subroto Kav.21<br>Jakarta Selatan, Jakarta Selatan, 12930</p>
                                            <p class="cust-phone">08382381908</p>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#modal-change-address">CHANGE
                                    ADDRESS</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Product Size End -->
                <!--END COLUMN -->
            </div>
        </div>
    </div>
</div>

@endsection
